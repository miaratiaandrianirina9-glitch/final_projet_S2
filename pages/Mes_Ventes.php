<?php 
    include_once("../inc/fonctions.php");
    session_start();
    if(!isset($_SESSION['id_membre'])){
        header("Location: index.php");
    }
    $montant=get_montant_total_vente($_SESSION['id_membre']);
    $produit_vendu=get_produit_vendu($_SESSION['id_membre']);
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
    <h1>Membre: <? echo $montant['nom_membre'];?></h1>
    <div class="form">
        <button><a class="btn" href="Acceuil.php">Tout produit vendus</a></button>
        <button><a class="btn" href="Mes_Ventes.php">Mes produit vendus</a></button>
        <button><a class="btn" href="Statistiques.php">Voir les Statistiques</a></button>
        <button><a class="btn" href="Vendre.php">Vendre des produits</a></button>
    </div>
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
    <h2>Montant total des ventes: <?= $montant['montant_total']?></h2>
</body>
</html>