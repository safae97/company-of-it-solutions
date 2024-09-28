<?php
include("dbconnection.php");

// Initialisation des variables pour stocker les données du formulaire
$formation_nom = $employee_id = $formation_description = "";
$budget_id = 1; // Valeur par défaut pour le budget_id
$rh_id = 1; // Valeur par défaut pour le rh_id
$formation_nom_err = $employee_id_err = $formation_description_err = "";

// Traitement du formulaire lors de sa soumission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation du champ Nom de la formation
    if (empty(trim($_POST["formation_nom"]))) {
        $formation_nom_err = "Veuillez entrer un nom de formation.";
    } else {
        $formation_nom = trim($_POST["formation_nom"]);
    }

    // Validation du champ Employee ID
    if (empty(trim($_POST["employee_id"]))) {
        $employee_id_err = "Veuillez entrer au moins un ID d'employé.";
    } else {
        $employee_ids_input = $_POST["employee_id"];
        $employee_ids = explode(",", $employee_ids_input); // Divise la saisie en un tableau d'identifiants d'employés

        // Insérer chaque identifiant d'employé dans la base de données
        foreach ($employee_ids as $employee_id) {
            // Assurez-vous que $employee_id est un entier valide avant l'insertion
            $employee_id = trim($employee_id);
            if (!is_numeric($employee_id)) {
                $employee_id_err = "L'ID d'employé '$employee_id' n'est pas valide.";
                break;
            }
        }
    }

    // Validation du champ Description de la formation
    if (empty(trim($_POST["formation_description"]))) {
        $formation_description_err = "Veuillez entrer une description de la formation.";
    } else {
        $formation_description = trim($_POST["formation_description"]);
    }

    // Vérifier s'il n'y a pas d'erreurs avant d'insérer dans la base de données
    if (empty($formation_nom_err) && empty($employee_id_err) && empty($formation_description_err)) {
        // Préparation de la requête SQL d'insertion
        $sql = "INSERT INTO formation (formation_nom, budget_id, employee_id, rh_id, formation_description) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Liaison des paramètres avec les valeurs saisies dans le formulaire
            mysqli_stmt_bind_param($stmt, "siiss", $formation_nom, $budget_id, $employee_id, $rh_id, $formation_description);

            // Exécution de la requête préparée
            if (mysqli_stmt_execute($stmt)) {
                // Redirection vers la page de liste des formations après l'insertion
                header("location: listformation.php");
                exit();
            } else {
                echo "Erreur lors de l'exécution de la requête d'insertion : " . mysqli_error($conn);
            }

            // Fermeture du statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Erreur lors de la préparation de la requête d'insertion : " . mysqli_error($conn);
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une formation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 999;
        }
        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #007bff;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<form action="logout.php" method="post">
    <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
    </div>
      </form>
    <div>
    <h2>Ajouter une formation</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="formation_nom">Nom de la formation :</label>
            <input type="text" id="formation_nom" name="formation_nom" required>
            <span class="error"><?php echo $formation_nom_err; ?></span>
        </div>
        <div>
            <label for="employee_id">ID des Employés (séparés par des virgules):</label>
            <input type="text" id="employee_id" name="employee_id" required>
            <span class="error"><?php echo $employee_id_err; ?></span>
        </div>
        <div>
            <label for="formation_description">Description de la formation :</label>
            <textarea id="formation_description" name="formation_description" required></textarea>
            <span class="error"><?php echo $formation_description_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Ajouter">
        </div>
    </form>
    </div>
</body>
</html>
