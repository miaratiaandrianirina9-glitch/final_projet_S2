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
    function upload($file, $nomproduit){
        $uploadDir = __DIR__ . '/../assets/uploads/';
        $maxSize = 2 * 1024 * 1024; // 2 Mo
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    
        if ($file['error'] !== UPLOAD_ERR_OK) {
            die('Erreur lors de l’upload : ' . $file['error']);
        }
        // Vérifie la taille
        if ($file['size'] > $maxSize) {
            die('Le fichier est trop volumineux.');
        }
        // Vérifie le type MIME avec `finfo`
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        if (!in_array($mime, $allowedMimeTypes)) {
            die('Type de fichier non autorisé : ' . $mime);
        }
        // renommer le fichier
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = $nomproduit. '.' . $extension;
        // Déplace le fichier
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
            echo "Fichier uploadé avec succès : ". $newName;
        } else {
            echo "Échec du déplacement du fichier.";
        }
    return $newName;
    }
    function ajout_img_plat($nomFichier, $id_produit){
        $sql="UPDATE produit SET imageplat=$nomFichier WHERE id_produit=$id_produit";
        mysqli_query(dbconnect(),$sql);
    }
    function get_nom_produit($id_produit){
        $sql="SELECT * FROM produit WHERE id_produit=$id_produit";
        return get_one_line($sql);
    }
?>
