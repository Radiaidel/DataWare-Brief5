<?php
// ini_set('display_errors', 'off');

$server_name = "localhost";
$user = "root";
$password = "";
$db = "dataware";

$conn = mysqli_connect($server_name, $user, $password, $db);

if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

$sql = "SELECT * FROM equipe;";
$res = mysqli_query($conn, $sql);

if (!$res) {
    die("Erreur dans la requête : " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Liste des équipes</title>
    <style>
        html,
        body,
        .intro {

            height: 100%;
        }

        body {
            background-color: #282a41;
        }

        table td,
        table th {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .mask-custom {
            background-color: #3d3f54;
            border-radius: 2em;
            border: 2px solid rgba(255, 255, 255, 0.05);
            background-clip: padding-box;
            box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
        }

        h1 {
            color: #e1b204;
            font-size: 3em;
            font-weight: 600;
            margin: 1em;
            text-align: center;
        }

        .btnmodifier {
            border-radius: 20px;
            background: #e1b204;
        }

        .btnajouter {
            border-radius: 20px;
            border: 1px solid #e1b204;
            color: #e1b204;
            background-color: #3d3f54;
        }

        input {
            border: none;
            border-radius: 10px;
            color: white;
            background: transparent;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1>Liste des équipes</h1>

        <button type="button" class="btn btnajouter mb-3 float-end" id="ajouterMembreBtn">Ajouter une équipe</button>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card mask-custom">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless text-white mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Date de création</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($ligne = mysqli_fetch_assoc($res)) {
                                            echo "<tr>
                        <form action='equipe.php' method='post'>
                           
                                    <td><input type='text' name='id_equipe' value='" . $ligne['id_equipe'] . "'>
                                    </td>
                                    <td>
                                        <input type='text' name='nom_equipe' value='" . $ligne['nom_equipe'] . "'>
                                    </td>
                                    <td>" . $ligne['date_creation'] . "</td>
                                    <td>
                                        <button type='submit' class='btn btnmodifier' name='modifierEquipe'>Modifier</button>
                                    </td>
                                </form>
                            </tr>";
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // Connectez-vous à la base de données ici
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idEquipe = $_POST["id_equipe"];
            $nouveauNomEquipe = $_POST["nom_equipe"];

            if (isset($_POST["modifierEquipe"])) {
                // Effectuez la mise à jour du nom de l'équipe
                $sqlUpdate = "UPDATE equipe SET nom_equipe = '$nouveauNomEquipe' WHERE id_equipe = $idEquipe";
                $resUpdate = mysqli_query($conn, $sqlUpdate);

                if ($resUpdate) {
                    echo "Équipe mise à jour avec succès!";
                } else {
                    echo "Erreur lors de la mise à jour de l'équipe : " . mysqli_error($conn);
                }
            }
        }
        ?>


        <div class="modal" id="ajoutMembreModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une équipe</h5>
                    </div>
                    <div class="modal-body">
                        <form action="equipe.php" method="post">
                            <div class="mb-3">
                                <label for="nom_equipe" class="form-label">Nom de l'équipe</label>
                                <input type="text" class="form-control" id="nom_equipe" name="nom_equipe" required>
                            </div>
                            <button type="submit" class="btn btn-success" name="ajouterEquipe">Ajouter</button>
                        </form>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($_POST["ajouterEquipe"])) {
                                $nomEquipe = $_POST["nom_equipe"];

                                if (strlen($nomEquipe) >= 3) {
                                    $sqlInsert = "INSERT INTO equipe (id_equipe,nom_equipe, date_creation) VALUES (290,'$nomEquipe', NOW());";
                                    $resInsert = mysqli_query($conn, $sqlInsert);

                                    if ($resInsert) {
                                        echo "Équipe ajoutée avec succès!";
                                    } else {
                                        echo "Erreur lors de l'ajout de l'équipe : " . mysqli_error($conn);
                                    }
                                } else {
                                    echo "Le nom de l'équipe doit avoir au moins 3 caractères.";
                                }
                            }
                        }
                        ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>






        <div class="modal" id="ajoutMembreModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une équipe</h5>
                    </div>
                    <div class="modal-body">
                        <form action="equipe.php" method="post">
                            <div class="mb-3">
                                <label for="nom_equipe" class="form-label">Nom de l'équipe</label>
                                <input type="text" class="form-control" id="nom_equipe" name="nom_equipe" required>
                            </div>
                            <button type="submit" class="btn btn-success" name="ajouterEquipe">Ajouter</button>
                        </form>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('ajouterMembreBtn').addEventListener('click', function () {
            var modal = document.getElementById('ajoutMembreModal');
            modal.style.display = 'block';
        });

    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-... (votre hachage)" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-i+qfLGTpB6rEAiBf6MOcYx3Lm1O8Y+EKBe3heVJpKJlMbIu16ZEs1QOm5O1wU6N5"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-i+qfLGTpB6rEAiBf6MOcYx3Lm1O8Y+EKBe3heVJpKJlMbIu16ZEs1QOm5O1wU6N5"
        crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-9aS0aLHZvpUdXrDPQlHh8A9I5I/pZnU+JxlgqUpoIFhMuTpNc/gt7B4G9Rm4NIfQ" crossorigin="anonymous"></script> -->
</body>

</html>

<?php
// Fermer la connexion à la base de données
mysqli_close($conn);
?>