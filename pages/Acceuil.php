<?php 
    include_once("../inc/fonctions.php");
    $all_produit=get_all_produit_by_member($_GET['id_membre']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Les produits vendus</h1>
    <a href="Vendre.php?id_membre=<?=$_GET['id_membre']?>">Vendre des produits</a>
    <? foreach($all_produit as $produit){?>
        <form action="achatproduit.php" method="post">
            <p><b><?= $produit['nom']?></b></p>
            <label for="quantite">Quantite dispo : <?= $produit['quantite_dispo']?></label>
            <p> Quantite: <input id="quantite" type="text" name="quantite_produit" value="1">
            <input type="submit" value="Acheter"></p>
            <input type="hidden" name="id_produit" value="<?=$produit['id_produit']?>">
            <input type="hidden" name="id_membre" value="<?=$_GET['id_membre']?>">
        </form>
    <?}?>
</body>
</html>