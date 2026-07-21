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
        <button><a class="btn" href="Acceuil.php">Tout produit vendus</a></button>
        <button><a class="btn" href="Mes_Ventes.php">Mes produit vendus</a></button>
        <button><a class="btn" href="Statistiques.php">Voir les Statistiques</a></button>
        <button><a class="btn" href="Vendre.php">Vendre des produits</a></button>
        <p class="succes"> <?php if(isset($_GET['succes'])){echo $_GET['succes'];}?></p>
        <form action="traitement_produit.php" method="post" enctype="multipart/form-data">
            <label for="produit">Nom du produit</label>
            <p><select name="id_produit" id="produit">
                <? foreach($all_produit as $produit){?>
                    <option value="<?= $produit['id_produit']?>"><?= $produit['nom']?></option>
                    <?}?>
                </select></p>

                <label for="quantite">Quantite du produit a vendre</label>
                <p><input type="number" name="quantite" id="quantite"></p>
                    <label for="fichier">Ajouter une image</label>
                    <input type="file" name="imgplat" id="fichier" accept="image/*">
                <p><input type="submit" value="Vendre"></p>
                <input type="hidden" name="id_memp">
            </form>
        </div>
</div>
</body>
</html>