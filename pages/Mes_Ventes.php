<?php 
    include_once("../inc/fonctions.php");
    if(!isset($_GET['id_membre'])){
        header("Location: index.php");
    }
    $montant=get_montant_total_membre($_GET['id_membre']);
    // $montant=montant_vente_by_member($_GET['id_membre']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>Membre: <? echo $montant['nom_membre'];?></p>
    <p>Montant total des ventes: <?= $montant['montant_total']?></p>
</body>
</html>