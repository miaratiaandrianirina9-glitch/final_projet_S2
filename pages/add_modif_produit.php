<?php 
    session_start();
    include_once("../inc/fonctions.php");
    $all_produit=get_all_product($_SESSION['id_membre']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="body">
    <h1>Nos produits</h1>
    <div class="form">
        <button><a class="btn" href="Acceuil.php">Tout produit vendus</a></button>
        <button><a class="btn" href="Mes_Ventes.php">Mes produit vendus</a></button>
        <button><a class="btn" href="Statistiques.php">Voir les Statistiques</a></button>
        <button><a class="btn" href="Vendre.php">Vendre des produits</a></button>
        <button><a class="btn" href="add_modif_produit.php">Ajouter ou modifier des produits</a></button>
    </div>
    <table class="table" border=1 width=700>
        <tr>
            <td>Produit</td>
            <td>Categorie</td>
            <td>Prix</td>
            <td></td>
        </tr>
        <? foreach($all_produit as $produit){?>
            <tr>
                <td><?= $produit['nom']; ?></td>
                <td><?= $produit['categorie']; ?></td>
                <td><?= $produit['prix']; ?></td>
                <td><a href="modif_product.php?id_produit=<?= $produit['id_produit'];?>&id_categorie=<?= $produit['id_categorie'];?>">Modifier</a></td>
            </tr>
        <? } ?>
    <table>
    <button><a class="btn" href="add_product.php">Ajouter un produit</a></button>
    </div>
</body>
</html>