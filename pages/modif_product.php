<?php 
    session_start();
    include_once("../inc/fonctions.php");

    $id_produit = (int)$_GET['id_produit'];
    $id_categorie = (int)$_GET['id_categorie'];

    // Récupération des infos actuelles du produit
    $information = get_info_produit($id_produit);
    $all_categorie = get_categorie($id_categorie);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le produit</title>
</head>
<body>
    <h1>Modifier le produit</h1>
    <div class="form">
        <button><a class="btn" href="Acceuil.php">Tout produit vendus</a></button>
        <button><a class="btn" href="Mes_Ventes.php">Mes produit vendus</a></button>
        <button><a class="btn" href="Statistiques.php">Voir les Statistiques</a></button>
        <button><a class="btn" href="Vendre.php">Vendre des produits</a></button>
        <button><a class="btn" href="add_modif_produit.php">Ajouter ou modifier des produits</a></button>
    </div>

    <form action="../inc/traite_modif_product.php" method="get">
        <p>Nom du produit : 
            <input type="text" name="new_name_product" value="<?= htmlspecialchars($information['nom']); ?>" required>
        </p>

        <p>Catégorie : 
            <select name="choix_categorie">
                <option value="<?= $id_categorie; ?>">Conserver la catégorie actuelle (<?= $information['categorie']; ?>)</option>
                <?php foreach($all_categorie as $categorie){ ?>
                    <option value="<?= $categorie['id_categorie'];?>"><?= $categorie['nom_categorie'];?></option>
                <?php } ?>
            </select>
        </p>

        <p>Prix : 
            <input type="number" name="new_price" value="<?= $information['prix']; ?>" required>
        </p>

        <!-- Champ caché pour transmettre l'ID du produit -->
        <input type="hidden" name="id_produit" value="<?= $id_produit; ?>">

        <p><input type="submit" value="Enregistrer les modifications"></p>
    </form>
</body>
</html>