<?php 
    include_once("../inc/fonctions.php");
    $all_produit=get_all_produit_by_member($_GET['numero_etu']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Les produits vendus</p>
    <? foreach($all_produit as $produit){?>
        <form action="traitement_produit" method="get">
            <p><?= $produit['nom']?></p>
            <p>Quantite: <input type="text" name="quantite_produit"></p>
            <p><input type="submit" value="Acheter"></p>
        </form>
    <?}?>
</body>
</html>