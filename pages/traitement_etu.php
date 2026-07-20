<?php
    include("../inc/fonctions.php");
    session_start();
    $verif = est_dans_la_base($_POST['numero_etu']);
    if($verif!=-1){
        header('location: Acceuil.php?id_membre='.$verif);
        exit();
    }
    else{
        header('location: Inscription.php?numero_etu='.$_POST['numero_etu']);
        exit();
    }
?>