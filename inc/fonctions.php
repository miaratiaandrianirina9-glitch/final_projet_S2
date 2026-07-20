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
        $retour=1;
        $all_membre=get_all_member();
        foreach($all_membre as $membre){
            if($membre['numero_etu'] == $numero_etu){
                $retour=0;
            }
        }
        return $retour;
    }
    
    function get_all_produit_by_member($etu){
        $sql = "SELECT * FROM produit_membre pm JOIN membre m ON pm.id_membre=m.id_membre WHERE m.numero_etu!=$etu";
        return get_all_lines($sql);
        $sql = "SELECT * FROM produit_membre pm 
        JOIN membre m ON pm.id_membre=m.id_membre 
        JOIN produit p ON p.id_produit=pm.id_produit
        WHERE m.numero_etu!=$etu";
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

    function get_montant_total_membre($id_membre){
        $sql="SELECT sum(produit_membre.prix_vente * vente.quantite) as montant_total from vente 
        join produit_membre on vente.id_produit_membre=produit_membre.id_produit_membre join produit on produit_membre.id_produit=produit.id_produit
        join membre on produit_membre.id_membre=membre.id_membre where produit_membre.id_membre=$id_membre";

        return get_one_line($sql);
    }
?>
