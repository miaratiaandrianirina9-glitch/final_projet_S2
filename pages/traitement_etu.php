<?php
    include("../inc/fonctions.php");
    $verif = est_dans_la_base($_POST['numero_etu']);
    if($verif==0){
        header('location: Acceuil.php?numero_etu='.$_POST['numero_etu']);
    }
    else{
        header('location: Inscription.php?numero_etu='.$_POST['numero_etu']);
    }
?>