<?php
    include("../inc/fonctions.php");
    vendre_produit($_POST['id_produit'], $_POST['quantite'], $_SESSION['id_membre']);
    $nom_produit=get_nom_produit($_POST['id_produit']);
    if(isset($_FILES['imgplat']) && $_FILES['imgplat']['error'] === UPLOAD_ERR_OK){
        echo "Fichier recu";
        $filename=upload($_FILES['imgplat'], $nom_produit['nom']);
        ajout_img_plat($filename, $_POST['id_produit']);
    }
    else{
        echo "Aucun fichier recu";
    }
    header('location: Vendre.php);
?>