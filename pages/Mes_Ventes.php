<?php 
    include_once("../inc/fonctions.php");
    if(!isset($_GET['id_membre'])){
        header("Location: index.php");
    }
    $montant=get_montant_total_vente($_GET['id_membre']);
    $produit_vendu=get_produit_vendu($_GET['id_membre']);
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
    <p>Membre: <? echo $montant['nom_membre'];?></p>
    <table border="1" class="table">
        <tr>
            <td>Produit</td>
            <td>Quantite vendu</td>
            <td>Prix de vente</td>
            <td>Prix total</td>
        </tr>
        <? foreach($produit_vendu as $produit){?>
            <tr>
                <td><? echo $produit['nom_produit']; ?></td>
                <td><? echo $produit['quantite_vendu']; ?></td>
                <td><? echo $produit['prix_vente']; ?></td>
                <td><? echo $produit['prix_total']; ?></td>
            </tr>
        <? }?>
    </table>
    <p>Montant total des ventes: <?= $montant['montant_total']?></p>
</body>
</html>