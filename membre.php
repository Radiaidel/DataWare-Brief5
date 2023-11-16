<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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


$sql="SELECT id_membre,nom_membre,prenom_membre,email,telephone,role, status_membre, nom_equipe FROM membre inner join equipe on membre.id_equipe=equipe.id_equipe;";
$res = mysqli_query($conn, $sql);
if(!$res){
    die("Erreur dans la requête : " . mysqli_error($conn));

}

echo"<table class=\"table table-striped table-dark\">
<thead>
  <tr>
    <th scope=\"col\">#</th>
    <th scope=\"col\">nom</th>
    <th scope=\"col\">prenom</th>
    <th scope=\"col\">email</th>
    <th scope=\"col\">telephone</th>
    <th scope=\"col\">role</th>
    <th scope=\"col\">status</th>
    <th scope=\"col\">nom equipe</th>
  </tr>
</thead>   
<tbody>
";

while ($ligne = mysqli_fetch_assoc($res)) {
    echo "<tr>
            <th scope=\"row\">" . $ligne['id_membre'] . "</td>
            <td>" . $ligne['nom_membre'] . "</td>
            <td>" . $ligne['prenom_membre'] . "</td>
            <td>" . $ligne['email'] . "</td>
            <td>" . $ligne['telephone'] . "</td>
            <td>" . $ligne['role'] . "</td>
            <td>" . $ligne['status_membre'] . "</td>
            <td>" . $ligne['nom_equipe'] . "</td>
          </tr>";
}

echo "</tbody></table>";


mysqli_close($conn);
?>

<div class="btn d-flex justify-content-around  ">
        <button class="py-2 px-5">
            <a href="index.php" class="text-decoration-none text-dark">Ajouter</a>
        </button>
        <button class="py-2 px-5">
            <a href="index.php" class="text-decoration-none text-dark">Modifier</a>
        </button>
        <button class="py-2 px-5">
            <a href="index.php" class="text-decoration-none text-dark">
                Supprimer
            </a>
        </button>
    </div>
</body>
</html>




