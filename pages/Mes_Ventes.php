<?php 
    include_once("../inc/fonctions.php");
    $montant=montant_vente_by_member($_GET['id_membre']);
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
    <p>Montant total: <?= $montant['montant_total']?></p>
</div>
</body>
</html>