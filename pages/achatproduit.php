<?php
    include("../inc/fonctions.php");
    achat_produit($_POST['quantite_produit'], $_POST['id_produit']);
    header('location: Acceuil.php?id_membre='.$_POST['id_membre']);
?>