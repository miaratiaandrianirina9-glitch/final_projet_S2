<?php 
    include_once("../inc/fonctions.php");
    $all_categorie = get_tout_categorie();
    $all_produit   = get_all_produit(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
</head>
<body>
    <h1>Mettre un produit en vente</h1>
    <form action="../inc/traite_add_product.php" method="get">
        <p>Sélectionner le produit : 
            <select name="id_produit">
                <option value="">-- Sélectionner --</option>
                <?php foreach($all_produit as $produit) { ?>
                    <option value="<?= $produit['id_produit']; ?>"><?= $produit['nom']; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>Quantité disponible : <input type="number" name="quantite_dispo"></p>
        <p>Prix de vente : <input type="number" name="new_price"></p>
        <p><input type="submit" value="Mettre en vente"></p>
    </form>
</body>
</html>