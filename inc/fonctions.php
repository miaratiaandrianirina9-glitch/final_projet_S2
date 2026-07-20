<?php 
    include("connexion.php");

    function get_all_lines($sql){
        $req = mysqli_query(dbconnect(),$sql);
        $result = array();

        while ($line = mysqli_fetch_assoc($req)) {
            $result[] = $line;
        }
        mysqli_free_result($req);
        echo $sql;
        return $result;
    }

    function get_one_line($sql){
        $req = mysqli_query(dbconnect(), $sql);
        if (!$req) return null; // Retourne null si la requête échoue
    
        $result = mysqli_fetch_assoc($req);
        mysqli_free_result($req);
        return $result;
    }
    function get_all_member(){
        $sql="SELECT * FROM membre";
        return get_all_lines($sql);
    }

    function est_dans_la_base($numero_etu)
    {
        $retour=-1;
        $all_membre=get_all_member();
        foreach($all_membre as $membre){
            if($membre['numero_etu'] == $numero_etu){
                $retour=$membre['id_membre'];
            }
        }
        return $retour;
    }
    
    function get_all_produit_by_member($id_membre){
        $sql = "SELECT * FROM produit_membre pm
        LEFT JOIN membre m ON pm.id_membre=m.id_membre 
        LEFT JOIN produit p ON p.id_produit=pm.id_produit
        WHERE m.id_membre!=$id_membre";
        return get_all_lines($sql);
    }

    function achat_produit($quantite, $id_produit){
        $sql = "SELECT * FROM produit_membre
        WHERE id_produit=$id_produit";
        $produit=get_one_line($sql);
        $quantiteRenouvel=$produit['quantite_dispo']-$quantite;
        $sql2="UPDATE produit_membre 
        SET quantite_dispo=$quantiteRenouvel 
        WHERE id_produit=$id_produit";
        mysqli_query(dbconnect(),$sql2);
    }
    function get_all_produit(){
        $sql="SELECT * FROM produit";
        return get_all_lines($sql);
    }

    function vendre_produit($id_produit, $quantite, $id_membre){
        $sql1="SELECT * FROM produit WHERE id_produit=$id_produit";
        $produit=get_one_line($sql1);

        $sql2="INSERT INTO produit_membre (quantite_dispo,id_produit,id_membre,prix_vente,date_dispo)
        VALUES ($quantite,$id_produit,$id_membre,".$produit['prix_reference'].", NOW())";
        mysqli_query(dbconnect(),$sql2);

        $sql4 = "SELECT MAX(id_produit_membre) FROM produit_membre";
        $proMembre=get_one_line($sql4);

        $sql3="INSERT INTO vente (date , heure , id_produit_membre, quantite)
        VALUES (NOW(),CURTIME(),$id_membre,". $proMembre['id_produit_membre'].", $quantite)";
        mysqli_query(dbconnect(),$sql3);
    }
    function get_produit_vendu($id_membre){
        $sql = "SELECT * FROM produit_membre pm
        LEFT JOIN membre m ON pm.id_membre=m.id_membre 
        LEFT JOIN produit p ON p.id_produit=pm.id_produit
        WHERE m.id_membre=$id_membre";

        return get_all_lines($sql);
    }

    function get_montant_total_vente($id_membre){
        $sql="SELECT membre.nom as nom_membre, sum(produit_membre.prix_vente * vente.quantite) as montant_total from vente 
        join produit_membre on vente.id_produit_membre=produit_membre.id_produit_membre join produit on produit_membre.id_produit=produit.id_produit
        join membre on produit_membre.id_membre=membre.id_membre where produit_membre.id_membre=$id_membre";

        return get_one_line($sql);
    }
?>
