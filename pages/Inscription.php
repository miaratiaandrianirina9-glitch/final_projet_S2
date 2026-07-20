<?php 
    include("connexion.php");
    $numero_etu=$_GET['numero_etu'];
    if(isset($_GET['nom_membre'])){
        $nom_membre=$_GET['nom_membre'];

        $sql_insert_member = "INSERT INTO membre (nom, numero_etu) VALUES ('$nom_membre', '$numero_etu')";
        mysqli_query($dbconnect, $sql_insert_member);
        header("Location: traitement_etu.php?numero_etu=" . $numero_etu);
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
    <h1>Le numero <? echo $numero_etu;?>, inscrivez vous!</h1>
    <form action="Insciption.php" method="get">
        <p> Entrer votre nom: 
            <input type="text" name="nom_membre"> 
            <input type="hidden" name="numero_etu" value="<?=$numero_etu?>">
            <input type="submit" value="Inscrire">
        </p>
    </form>
</div>
</body>
</html>