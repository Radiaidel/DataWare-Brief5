<?php
ini_set('display_errors', 'off'); //pour ne pas afficher les erreurs et warnings
$server_name = "localhost";
$user = "root";
$password = "";
$db = "dataware";

$conn = mysqli_connect($server_name, $user, $password, $db);

if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["ajoutermembre"])) {
        $nom_membre = $_POST["nom_membre"];
        $prenom_membre = $_POST["prenom_membre"];
        $email_membre = $_POST["email_membre"];
        $telephone_membre = $_POST["telephone_membre"];
        $role_membre = $_POST["role_membre"];
        $statut_membre = $_POST["statut_membre"];
        $equipe_membre = $_POST["equipe_membre"];

        // Insérer le membre dans la base de données
        $sqlInsertMembre = "INSERT INTO `membre`(`id_membre`, `nom_membre`, `prenom_membre`, `email`, `telephone`, `role`, `status_membre`, `id_equipe`) VALUES (4356,'$nom_membre', '$prenom_membre', '$email_membre', '$telephone_membre', '$role_membre', '$statut_membre', $equipe_membre)";
        $resInsertMembre = mysqli_query($conn, $sqlInsertMembre);

        if ($resInsertMembre) {
            echo "Membre ajouté avec succès!";
        } else {
            echo "Erreur lors de l'ajout du membre : " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <section class="intro">
        <h1>Liste des membres</h1>

        <button type="button" class="btn btnajouter mb-3 float-end" id="ajouterMembreBtn">Ajouter un membre</button>



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
                                            <th scope="col">nom</th>
                                            <th scope="col">prenom</th>
                                            <th scope="col">email</th>
                                            <th scope="col">telephone</th>
                                            <th scope="col">role</th>
                                            <th scope="col">status</th>
                                            <th scope="col">nom equipe</th>
                                            <th scope="col">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT id_membre,nom_membre,prenom_membre,email,telephone,role, status_membre, nom_equipe FROM membre inner join equipe on membre.id_equipe=equipe.id_equipe;";
                                        $res = mysqli_query($conn, $sql);
                                        if (!$res) {
                                            die("Erreur dans la requête : " . mysqli_error($conn));

                                        }

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
                                                            <td>
                                                                <button type='submit' class='btn btnmodifier' name='modifierEquipe' id='modifierEquipe'>Modifier</button>
                                                                <button type='submit' class='btn btnmodifier' name='supprimerEquipe'>Supprimer</button>  
                                                            </td>
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


        <div class="modal" id="ajoutMembreModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title m-auto text-white">Ajouter un membre</h5>
                    </div>
                    <div class="modal-body">
                        <form action="membre.php" method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="nom_membre" name="nom_membre"
                                    placeholder="Nom" required>
                                <input type="text" class="form-control" id="prenom_membre" name="prenom_membre"
                                    placeholder="Prenom" required>
                                <input type="email" class="form-control" id="email_membre" name="email_membre"
                                    placeholder="Email" required>
                                <input type="text" class="form-control" id="telephone_membre" name="telephone_membre"
                                    placeholder="Telephone" required>
                                <select class="form-select" id="role_membre" name="role_membre"
                                    aria-label="Default select example">
                                    <option selected>Role</option>
                                    <option value="Chef de projet">Chef de projet</option>
                                    <option value="Concepteur UX/UI">Concepteur UX/UI </option>
                                    <option value="Testeur">Testeur</option>
                                    <option value="Analyste commercial">Analyste commercial</option>
                                    <option value="Administrateur de base de données">Administrateur de base de données
                                    </option>
                                    <option value="Responsable des opérations">Responsable des opérations</option>
                                    <option value="Scrum Master">Scrum Master</option>
                                    <option value="Support technique">Support technique </option>
                                    <option value="Spécialiste en sécurité">Spécialiste en sécurité </option>
                                </select>

                                <select class="form-select" id="statut_membre" name="statut_membre"
                                    aria-label="Default select example">
                                    <option selected>statut</option>
                                    <option value="Actif">Actif </option>
                                    <option value="En congé">En congé</option>
                                    <option value="En attente">En attente</option>
                                    <option value="En probation">En probation</option>
                                    <option value="En formation">En formation</option>
                                    <option value="Indisponible">Indisponible </option>
                                    <option value="En retraite">En retraite</option>
                                </select>

                                <select class="form-select" id="equipe_membre" name="equipe_membre"
                                    aria-label="Default select example">
                                    <option selected>Equipe</option>
                                    <?php

                                    $sql = "SELECT id_equipe,nom_equipe FROM equipe;";
                                    $res = mysqli_query($conn, $sql);
                                    while ($ligne = mysqli_fetch_assoc($res)) {
                                        echo "<option value='" . $ligne['id_equipe'] . "'>" . $ligne['nom_equipe'] . "</option>";
                                    }

                                    ?>
                                </select>




                            </div>
                            <button type="submit" class="btn btn-success" name="ajoutermembre">Ajouter</button>
                        </form>
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
    </section>

</body>

</html>