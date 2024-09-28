<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Titre</title>
    <style>
        /* Style créatif pour le formulaire */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        input[type="text"], input[type="date"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        input[type="text"]:focus, input[type="date"]:focus {
            outline: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(to right, #4CAF50, #2E8B57);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: linear-gradient(to right, #45a049, #2E8B57);
        }
        .error {
            color: #d9534f;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Formulaire</h1>
    <!-- Votre formulaire et contenu PHP ici -->

  

    <?php
// Inclusion du fichier de connexion à la base de données
include("dbconnection.php");

// Initialisation des variables pour stocker les données du formulaire
$nom = $prenom = $date_naiss = "";
$nom_err = $prenom_err = $date_naiss_err = "";

// Traitement du formulaire lors de sa soumissionp _,<k
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation du champ Nom
    $nom = $_POST["employee_nom"];

    // Validation du champ Prénom
    $prenom = $_POST["employee_prenom"];

    // Validation du champ Date de Naissance
    $date_naiss = $_POST["date_naiss"];

    // Vérifier s'il n'y a pas d'erreurs avant de procéder à l'authentification
    if (empty($nom_err) && empty($prenom_err) && empty($date_naiss_err)) {
        // Requête SQL pour rechercher l'employé dans la base de données
        $sql = "SELECT * FROM employee WHERE employee_nom = ? AND employee_prenom = ? AND date_naiss = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Liaison des paramètres avec les valeurs saisies dans le formulaire
            mysqli_stmt_bind_param($stmt, "sss", $nom, $prenom, $date_naiss);

            // Exécution de la requête préparée
            if (mysqli_stmt_execute($stmt)) {
                // Récupération du résultat de la requête
                $result = mysqli_stmt_get_result($stmt);

                // Vérification si l'employé existe
                if (mysqli_num_rows($result) == 1) {
                    // L'employé est authentifié avec succès
                    // Démarrer la session
                    session_start();
                    // L'employé est authentifié avec succès
                   // Stocker l'ID de l'employé dans la session
                   $row = mysqli_fetch_assoc($result);
                   $_SESSION["employee_id"] = $row["employee_id"];

                    // Afficher les options après la connexion
                    echo "<h2>Bienvenue, $prenom $nom!</h2>";
                    echo "<ul>";
                    echo "<li><a href='demanderconge.php'>Demander Congé.</a></li>";
                    echo "<li><a href='consulter_demande.php'>Consulter Mes Demandes.</a></li>";
                    echo "<li><a href='consulter_formation.php'>Consulter Mes Formations.</a></li>";
                    echo "<li><a href='demander_peripherique.php'>Demander peripherique.</a></li>";
                    echo "<li><a href='employe.php'>consulter taches.</a></li>";
                    echo "</ul>";
                } else {
                    // L'employé n'existe pas dans la base de données
                    echo "Les informations de connexion sont incorrectes.";
                }
            } else {
                echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
            }

            // Fermeture du statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Erreur lors de la préparation de la requête : " . mysqli_error($conn);
        }
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($conn);
}
?>
 
</div>



</body>
</html>