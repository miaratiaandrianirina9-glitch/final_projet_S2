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
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="body">
    <h1>Les produits vendus</h1>
    <table class="table" border=1 width=900>
        <tr>
            <th>Produit</th>
            <th>Quantite disponible</th>
            <th>Achat</th>
            <th>id_membre</th>
        </tr>
    <? foreach($all_produit as $produit){?>
        <tr>
        <form action="achatproduit.php" method="post">
            <td>
                <img src="../assets/uploads/<?= $produit['imagePlat']?>" alt="image">
                <p><?= $produit['nom']?></p>
            </td>
            <td><?= $produit['quantite_dispo']?></td>
            <td> Quantite: <input id="quantite" type="text" name="quantite_produit" value="1">
            <input type="submit" value="Acheter"></td>
            <td><?= $produit['id_membre']?></td>
            <input type="hidden" name="id_produit" value="<?=$produit['id_produit']?>">
            <input type="hidden" name="id_membre" value="<?=$_GET['id_membre']?>">
        </form>
        </tr>
        <?}?>
    </table>
    <button class="btn-a"><a class="btn" href="Vendre.php?id_membre=<?=$_GET['id_membre']?>">Vendre des produits</a></button>
</div>
</body>
</html>