<?php
    include("../inc/fonctions.php");
    vendre_produit($_POST['id_produit'], $_POST['quantite'], $_POST['id_membre']);
    header('location: Vendre.php?id_membre='.$_POST['id_membre']);
?>