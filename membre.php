<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        html,
        body,
        .intro {
            height: 100%;
        }

        table td,
        table th {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .mask-custom {
            background: rgba(24, 24, 16, 0.7);
            border-radius: 2em;
            border: 2px solid rgba(255, 255, 255, 0.05);
            background-clip: padding-box;
            box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
        }
    </style>
    <title>Document</title>
</head>

<body>



    <section class="intro">
        <div class="bg-image h-100">
            <div class="mask d-flex align-items-center h-100">
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
                                                ini_set('display_errors', 'off'); //pour ne pas afficher les erreurs et warnings
                                                $server_name = "localhost";
                                                $user = "root";
                                                $password = "";
                                                $db = "dataware";

                                                $conn = mysqli_connect($server_name, $user, $password, $db);

                                                if (!$conn) {
                                                    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
                                                }


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
                                                                <button type='submit' class='btn btn-primary' name='modifierEquipe'>Modifier</button>
                                                                <button type='submit' class='btn btn-danger' name='supprimerEquipe'>Supprimer</button>  
                                                            </td>
                                                        </tr>";
                                                }

                                                mysqli_close($conn);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>