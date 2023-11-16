<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
ini_set('display_errors', 'off'); //pour ne pas afficher les erreurs et warnings
$server_name="localhost";
$user="root";
$password="";
$db="dataware";

$conn=mysqli_connect($server_name,$user,$password,$db);

if(!$conn){
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
$sql="select id_membre, nom_membre from membre;";
$res = mysqli_query($conn, $sql);


if(!$res){
    die("Erreur dans la requête : " . mysqli_error($conn));

}
while ($ligne = mysqli_fetch_assoc($res)) {
    echo "ID: " . $ligne['id_membre'] . " - Nom: " . $ligne['nom_membre'] . "<br>";
}

?>
</body>
</html>




