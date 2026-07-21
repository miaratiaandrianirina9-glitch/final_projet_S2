<?php
    session_start();
    include_once("fonctions.php");

    $id_produit       = (int)$_GET['id_produit'];
    $new_name_product = $_GET['new_name_product'];
    $choix_categorie  = (int)$_GET['choix_categorie'];
    $new_price        = (int)$_GET['new_price'];
    $id_membre        = (int)$_SESSION['id_membre'];

    $db = dbconnect();

    if (!empty($new_name_product) && $new_price > 0) {
        $safe_name = mysqli_real_escape_string($db, $new_name_product);
        
        $sql_update_produit = "UPDATE produit 
                               SET nom = '$safe_name', 
                                   id_categorie = $choix_categorie, 
                                   prix_reference = $new_price 
                               WHERE id_produit = $id_produit";
        
        mysqli_query($db, $sql_update_produit);
    }

    if ($new_price > 0) {
        $sql_update_produit_membre = "UPDATE produit_membre 
                                      SET prix_vente = $new_price 
                                      WHERE id_produit = $id_produit AND id_membre = $id_membre";
        
        mysqli_query($db, $sql_update_produit_membre);
    }

    header("Location: ../pages/add_modif_produit.php");
    exit();
?>