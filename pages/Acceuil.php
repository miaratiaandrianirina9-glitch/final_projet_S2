<?php 
    include_once("../inc/fonctions.php");
    session_start();
    $all_produit=get_all_produit_by_member($_SESSION['id_membre']);
    $categorie=get_all_categorie();
    if(isset($_GET['categorie'])){
        $all_produit=get_produit_of($_GET['categorie']);
    }
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
    <h1>
        Les produits vendus
        <?php if(isset($_GET['categorie'])){ ?>
        categorie : <?=get_categorie_name($_GET['categorie']);?>
        <?php } ?>
    </h1>
    <div class="form">
        <button><a class="btn" href="Acceuil.php">Tout produit vendus</a></button>
        <button><a class="btn" href="Mes_Ventes.php">Mes produit vendus</a></button>
        <button><a class="btn" href="Statistiques.php">Voir les Statistiques</a></button>
        <button><a class="btn" href="Vendre.php">Vendre des produits</a></button>
    </div>
    <div class="left-bar">
        <?php foreach($categorie as $categorie){?>
        <button><a class="btn-cat" href="Acceuil.php?categorie=<?=$categorie['id_categorie']?>"><?=$categorie['nom_categorie']?></a></button>
        <?php } ?>
    </div>
    <table class="table" border=1 width=900>
        <tr>
            <th>ID</th>
            <th>Produit</th>
            <th>Quantite disponible</th>
            <th>Achat</th>
            <th>id_membre</th>
        </tr>
    <? foreach($all_produit as $produit){?>
        <tr>
        <form action="achatproduit.php" method="post">
            <td><?= $produit['id_produit']?></td>
            <td>
                <img class="img-plat" src="../assets/uploads/<?=$produit['imageplat']?>" alt="image" width="100">
                <p><?= $produit['nom']?></p>
            </td>
            <td><?= $produit['quantite_dispo']?></td>
            <td> Quantite: <input id="quantite" type="text" name="quantite_produit" value="1">
            <input type="submit" value="Acheter"></td>
            <td><?= $produit['id_membre']?></td>
            <input type="hidden" name="id_produit" value="<?=$produit['id_produit']?>">
            <input type="hidden" name="id_membre" value="<?=$_SESSION['id_membre']?>">
        </form>
        </tr>
        <?}?>
    </table>
</div>
</body>
</html>