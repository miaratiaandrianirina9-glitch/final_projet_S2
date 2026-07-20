<?php
    include("../inc/fonctions.php");
    achat_produit($quantite, $idproduit);
    header('location: Acceuil.php?numero_etu='.$_POST['numero_etu']);
?>