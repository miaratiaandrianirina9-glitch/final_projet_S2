<?php 
    include_once("../inc/fonctions.php");
    $montant=get_montant_by_member($id_membre);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Montant total: <?= $montant['montant_total']?></p>
</body>
</html>