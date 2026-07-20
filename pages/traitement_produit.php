<?php
    include("../inc/fonctions.php");
    vendre_produit($_POST['id_produit'], $_POST['quantite'], $_POST['id_membre']);
    if(isset($_POST['imgplat'])){
        header('location: uploadIMG.php?filePlat='.$_POST['imgplat']);
    }
    else{
        header('location: Vendre.php?id_membre='.$_POST['id_membre']);
    }
?>