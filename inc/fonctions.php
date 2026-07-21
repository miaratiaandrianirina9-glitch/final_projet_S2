<?php 
    include("connexion.php");

    function get_all_lines($sql){
        $req = mysqli_query(dbconnect(),$sql);
        $result = array();

        while ($line = mysqli_fetch_assoc($req)) {
            $result[] = $line;
        }
        mysqli_free_result($req);
        // echo $sql;
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

        $sql3 = "SELECT MAX(id_produit_membre) FROM produit_membre";
        $proMembre=get_one_line($sql3);

        $sql4="INSERT INTO vente (date , heure , id_produit_membre, quantite)
        VALUES (NOW(),CURTIME(),$id_membre,". $proMembre['id_produit_membre'].", $quantite)";

        mysqli_query(dbconnect(),$sql2);
        mysqli_query(dbconnect(),$sql4);
    }
    function get_all_produit(){
        $sql="SELECT * FROM produit";
        return get_all_lines($sql);
    }

    function get_all_categorie($id_categorie){
        $sql="SELECT * FROM categorie c where c.id_categorie!=$id_categorie";
        return get_all_lines($sql);
    }

    function get_tout_categorie(){
        $sql="SELECT * FROM categorie";
        return get_all_lines($sql);
    }
    function vendre_produit($id_produit, $quantite, $id_membre){
        $sql1="SELECT * FROM produit WHERE id_produit=$id_produit";
        $produit=get_one_line($sql1);

        $sql2="INSERT INTO produit_membre (quantite_dispo,id_produit,id_membre,prix_vente,date_dispo)
        VALUES ($quantite,$id_produit,$id_membre,".$produit['prix_reference'].", NOW())";
        mysqli_query(dbconnect(),$sql2);

        mysqli_query(dbconnect(),$sql2);
 
    }

    function get_produit_vendu($id_membre){
        $sql = "SELECT *,p.nom as nom_produit, v.quantite as quantite_vendu, (pm.prix_vente * v.quantite) as prix_total 
        FROM produit_membre pm
        JOIN membre m ON pm.id_membre=m.id_membre 
        JOIN produit p ON p.id_produit=pm.id_produit
        JOIN vente v ON pm.id_produit_membre=v.id_produit_membre
        WHERE m.id_membre=$id_membre";

        return get_all_lines($sql);
    }

    function get_montant_total_vente($id_membre){
        $sql="SELECT membre.nom as nom_membre, sum(produit_membre.prix_vente * vente.quantite) as montant_total from vente 
        join produit_membre on vente.id_produit_membre=produit_membre.id_produit_membre join produit on produit_membre.id_produit=produit.id_produit
        join membre on produit_membre.id_membre=membre.id_membre where produit_membre.id_membre=$id_membre";

        return get_one_line($sql);
    }

    function get_vente_par_categorie(){
        $sql="SELECT *, 
        c.nom_categorie as nom_categorie ,
        c.id_categorie as id_categorie, 
        p.nom as nom_produit, 
        pm.prix_vente as prix_vente,
        v.quantite as quantite_vendu,
        (pm.prix_vente * v.quantite) as prix_total
        from vente v 
        join produit_membre pm on v.id_produit_membre=pm.id_produit_membre 
        join produit p on pm.id_produit=p.id_produit 
        join categorie c on p.id_categorie=c.id_categorie
        group by c.id_categorie";

        return get_all_lines($sql);
    }
    function get_vente_par_produit($id_categorie){
        $sql="SELECT
        c.nom_categorie as nom_categorie ,
        c.id_categorie as id_categorie, 
        p.nom as nom_produit, 
        p.id_produit as id_produit, 
        pm.prix_vente as prix_vente,
        v.quantite as quantite_vendu,
        (pm.prix_vente * v.quantite) as prix_total
        from vente v 
        join produit_membre pm on v.id_produit_membre=pm.id_produit_membre 
        join produit p on pm.id_produit=p.id_produit 
        join categorie c on p.id_categorie=c.id_categorie
        WHERE c.id_categorie=$id_categorie";

        return get_all_lines($sql);
    }
    function get_vente_par_membre($id_membre){
        $sql="SELECT
        c.nom_categorie as nom_categorie ,
        c.id_categorie as id_categorie, 
        p.nom as nom_produit, 
        p.id_produit as id_produit, 
        pm.prix_vente as prix_vente,
        v.quantite as quantite_vendu,
        (pm.prix_vente * v.quantite) as prix_total,
        m.nom as nom_membre
        FROM produit_membre pm
        JOIN membre m ON pm.id_membre = m.id_membre
        JOIN produit p ON pm.id_produit = p.id_produit
        JOIN categorie c ON p.id_categorie = c.id_categorie
        LEFT JOIN vente v ON v.id_produit_membre = pm.id_produit_membre
        WHERE pm.id_membre=$id_membre";

        return get_all_lines($sql);
    }

    function get_all_product($id_membre){
        $sql="SELECT * ,p.nom as nom, 
            c.nom_categorie as categorie, 
            c.id_categorie as id_categorie, 
            p.prix_reference as prix
            from produit p 
            join categorie c on p.id_categorie=c.id_categorie
            join produit_membre pm on p.id_produit=pm.id_produit
            where pm.id_membre=$id_membre";

            return get_all_lines($sql);
    }

    function get_info_produit($id_produit){
        $sql="SELECT *, p.nom as nom, 
            c.nom_categorie as categorie, 
            p.prix_reference as prix 
            from produit p 
            join categorie c on p.id_categorie=c.id_categorie
            where p.id_produit=$id_produit";

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
        $sql="UPDATE produit SET imageplat='$nomFichier' WHERE id_produit=$id_produit";
        mysqli_query(dbconnect(),$sql);
    }

    function get_nom_produit($id_produit){
        $sql="SELECT * FROM produit WHERE id_produit=$id_produit";
        return get_one_line($sql);
    }
    function get_produit_of($id_categorie){
        $sql="SELECT * FROM produit_membre pm
        JOIN membre m ON pm.id_membre=m.id_membre 
        JOIN produit p ON p.id_produit=pm.id_produit
        WHERE p.id_categorie=$id_categorie";
        return get_all_lines($sql);
    }
    function get_all_categorie(){
        $sql="SELECT * FROM categorie";
        return get_all_lines($sql);
    }
    function get_categorie_name($id_categorie){
        $sql="SELECT * FROM categorie WHERE id_categorie=$id_categorie";
        $categorie=get_one_line($sql);
        return $categorie['nom_categorie'];
    }
?>