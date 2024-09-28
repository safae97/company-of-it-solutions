<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><!DOCTYPE html>
   <style>
        .container {
            width: 80%; /* Ajustez la largeur selon vos besoins */
            margin: 0 auto; /* Centre le conteneur horizontalement */
        }
        
        .demandes-container {
            margin-top: 3rem; /* Marge supérieure de 3rem */
        }
        .demandes-header {
            font-size: 24px; /* Taille de police */
            font-weight: bold; /* Poids de la police en gras */
            margin-bottom: 1.5rem; /* Marge inférieure de 1.5rem */
        }
        .demande-details {
            font-size: 18px; /* Taille de police */
            margin-bottom: 1rem; /* Marge inférieure de 1rem */
        }
        /* Styles pour les tableaux */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .logout-btn {
         position: fixed; /* Fixed positioning for logout button */
         top: 3rem;
         right: 3rem;
         cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Bouton de déconnexion -->
    <form action="logout.php" method="post">
  <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
  </div>
    </form> 

    <div class="container">
        <div class="demandes-container">
            <!-- Section Demandes de Congé -->
            <div>
                <h3 class="demandes-header">Demandes de Congé</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Type de congé</th>
                            <th>Réponse</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include the database connection file
                        include("dbconnection.php");

                        // Vérification de la session de l'employé
                        session_start();
                        if (!isset($_SESSION["employee_id"])) {
                            // Redirection vers la page de connexion si l'employé n'est pas connecté
                            header("Location: connexion.php");
                            exit();
                        }

                        // Requête SQL pour sélectionner les demandes de congé de l'employé spécifique
                        $sql_conge = "SELECT * FROM conge WHERE employee_id = ?";
                        if ($stmt_conge = mysqli_prepare($conn, $sql_conge)) {
                            // Liaison des paramètres avec l'ID de l'employé
                            mysqli_stmt_bind_param($stmt_conge, "i", $_SESSION["employee_id"]);

                            // Exécution de la requête préparée
                            if (mysqli_stmt_execute($stmt_conge)) {
                                // Récupération du résultat de la requête
                                $result_conge = mysqli_stmt_get_result($stmt_conge);

                                // Vérification s'il y a des demandes de congé
                                if (mysqli_num_rows($result_conge) > 0) {
                                    // Afficher les demandes de congé de l'employé
                                    while ($row_conge = mysqli_fetch_assoc($result_conge)) {
                                        echo "<tr>";
                                        echo "<td>" . $row_conge['type'] . "</td>";
                                        echo "<td>" . $row_conge['statut'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    // Aucune demande de congé trouvée pour cet employé
                                    echo "<tr><td colspan='2'>Aucune demande de congé trouvée pour cet employé.</td></tr>";
                                }
                            } else {
                                echo "Erreur lors de l'exécution de la requête de congé : " . mysqli_error($conn);
                            }
                            // Fermeture du statement
                            mysqli_stmt_close($stmt_conge);
                        } else {
                            echo "Erreur lors de la préparation de la requête de congé : " . mysqli_error($conn);
                        }
                        // Fermeture de la connexion à la base de données
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Section Demandes de Périphérique -->
            <div>
                <h3 class="demandes-header">Demandes de Périphérique</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nom du périphérique</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include the database connection file (if not included already)
                        include("dbconnection.php");

                        // Vérification de la session de l'employé (si ce n'est pas déjà fait)
                       // session_start();
                        if (!isset($_SESSION["employee_id"])) {
                            // Redirection vers la page de connexion si l'employé n'est pas connecté
                            header("Location: connexion.php");
                            exit();
                        }

                        // Requête SQL pour sélectionner les demandes de périphérique de l'employé spécifique
                        $sql_peripherique = "SELECT * FROM demande WHERE employee_id = ?";
                        if ($stmt_peripherique = mysqli_prepare($conn, $sql_peripherique)) {
                            // Liaison des paramètres avec l'ID de l'employé
                            mysqli_stmt_bind_param($stmt_peripherique, "i", $_SESSION["employee_id"]);

                            // Exécution de la requête préparée
                            if (mysqli_stmt_execute($stmt_peripherique)) {
                                // Récupération du résultat de la requête
                                $result_peripherique = mysqli_stmt_get_result($stmt_peripherique);

                                // Vérification s'il y a des demandes de périphérique
                                if (mysqli_num_rows($result_peripherique) > 0) {
                                    // Afficher les demandes de périphérique de l'employé
                                    while ($row_peripherique = mysqli_fetch_assoc($result_peripherique)) {
                                        echo "<tr>";
                                        echo "<td>" . $row_peripherique['nom_peripherique'] . "</td>";
                                        echo "<td>" . $row_peripherique['statue'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    // Aucune demande de périphérique trouvée pour cet employé
                                    echo "<tr><td colspan='2'>Aucune demande de périphérique trouvée pour cet employé.</td></tr>";
                                }
                            } else {
                                echo "Erreur lors de l'exécution de la requête de périphérique : " . mysqli_error($conn);
                            }
                            // Fermeture du statement
                            mysqli_stmt_close($stmt_peripherique);
                        } else {
                            echo "Erreur lors de la préparation de la requête de périphérique : " . mysqli_error($conn);
                        }
                        // Fermeture de la connexion à la base de données
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>