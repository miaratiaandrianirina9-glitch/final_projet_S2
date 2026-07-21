<?php
session_start();
include_once("fonctions.php");

$id_produit     = (int)$_GET['id_produit'];
$quantite_dispo = (int)$_GET['quantite_dispo'];
$new_price      = (int)$_GET['new_price'];
$id_membre      = $_SESSION['id_membre'];

$sql_insert = "INSERT INTO produit_membre (id_produit, id_membre, prix_vente, quantite_dispo, date_dispo) 
               VALUES ($id_produit, $id_membre, $new_price, $quantite_dispo, NOW())";

mysqli_query(dbconnect(), $sql_insert);

header("Location: ../pages/add_modif_produit.php");
exit();
?>