<?php 
    session_start();
    include_once("../inc/fonctions.php");
    $all_stat=get_vente_par_membre($_SESSION['id_membre']);

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
    <h1>Ventes pour le membre <?= $all_stat[0]['nom_membre'];?></h1>
    <div class="form">
        <button><a class="btn" href="Acceuil.php">Tout produit vendus</a></button>
        <button><a class="btn" href="Mes_Ventes.php">Mes produit vendus</a></button>
        <button><a class="btn" href="Statistiques.php">Voir les Statistiques</a></button>
        <button><a class="btn" href="Vendre.php">Vendre des produits</a></button>
    </div>
    <table class="table" border=1 width=700>
        <tr>
            <td>Produit</td>
            <td>Prix de vente</td>
            <td>Quantite vendu</td>
            <td>Prix totale</td>
        </tr>
        <? foreach($all_stat as $stat){?>
            <tr>
                <td><?= $stat['nom_produit']?></td>
                <td><?= $stat['prix_vente']?></td>
                <td><?= $stat['quantite_vendu']?></td>
                <td><?= $stat['prix_total']?></td>
            </tr>
        <? }?>
    <table>
</body>
</html>