<?php 
    include_once("../inc/fonctions.php");
    $all_produit=get_all_produit();
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
    <h1>Vendre des produits</h1>
    <div class=form>
        <form action="traitement_produit.php" method="post">
            <button><a class="btn" href="Acceuil.php?id_membre=<?=$_GET['id_membre']?>">Tout produit vendus</a></button>
            <button><a class="btn" href="Mes_Ventes.php?id_membre=<?=$_GET['id_membre']?>">Mes produit vendus</a></button>
            <p>Produit <select name="id_produit">
                <? foreach($all_produit as $produit){?>
                    <option value="<?= $produit['id_produit']?>"><?= $produit['nom']?></option>
                    <?}?>
                </select></p>
                <p>Quantite: <input type="text" name="quantite"></p>
                <p><input type="submit" value="Vendre"></p>
                <input type="hidden" name="id_membre" value="<?=$_GET['id_membre']?>">
            </form>
        </div>
</div>
</body>
</html>