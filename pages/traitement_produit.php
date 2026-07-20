<?php
    include("../inc/fonctions.php");
    vendre_produit($_POST['id_produit'], $_POST['quantite'], $_POST['id_membre']);
    if(isset($_POST['imgplat'])){
        $filename=upload($_POST['imgplat'], $_POST['nomproduit']);
        ajout_img_plat($filename, $_POST['id_produit'])
    }
    header('location: Vendre.php?id_membre='.$_POST['id_membre']);
?>