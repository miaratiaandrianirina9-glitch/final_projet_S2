<?php 
    include_once("../inc/fonctions.php");
    $all_stat=get_vente_par_membre();
    
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
    <h1>Ventes pour la membre <?= $all_stat[0]['nom_categorie'];?></h1>
    <table class="table" border=1 width=700>
        <tr>
            <td>Produit</td>
            <td>Prix de vente</td>
            <td>Quantite vendu</td>
            <td>Prix totale</td>
        </tr>
        <? foreach($all_stat as $stat){?>
            <tr>
                <td><a href="vente_par_membre.php?id_produit=<?= $stat['id_produit'];?>"><?= $stat['nom_produit']?></td>
                <td><?= $stat['prix_vente']?></td>
                <td><?= $stat['quantite_vendu']?></td>
                <td><?= $stat['prix_total']?></td>
            </tr>
        <? }?>
    <table>
</body>
</html>