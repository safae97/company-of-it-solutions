<?php
include("dbconnection.php");

// Initialisation des variables pour stocker les données du formulaire
$type = $date_debut = $date_fin = $employee_id = $statut = $raison = "";
$type_err = $date_debut_err = $date_fin_err = $employee_id_err = $statut_err = $raison_err = "";

// Traitement du formulaire lors de sa soumission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation du champ Type de congé
    $type = $_POST["type"];

    // Validation du champ Date de début
    $date_debut = $_POST["date_debut"];

    // Validation du champ Date de fin
    $date_fin = $_POST["date_fin"];

    // Validation du champ ID de l'employé
    $employee_id = $_POST["employee_id"];

    // Validation du champ Statut
    $statut = $_POST["statut"];

    // Validation du champ Raison
    $raison = $_POST["raison"];

    // Vérifier s'il n'y a pas d'erreurs avant d'insérer dans la base de données
    if (empty($type_err) && empty($date_debut_err) && empty($date_fin_err) && empty($employee_id_err) && empty($statut_err) && empty($raison_err)) {
        // Préparation de la requête SQL d'insertion
        $sql = "INSERT INTO conge (type, date_debut, date_fin, employee_id, statut, raison) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Liaison des paramètres avec les valeurs saisies dans le formulaire
            mysqli_stmt_bind_param($stmt, "sssiss", $type, $date_debut, $date_fin, $employee_id, $statut, $raison);

            // Exécution de la requête préparée
            if (mysqli_stmt_execute($stmt)) {
                // Redirection vers une page de confirmation ou une autre page après l'insertion
                echo "<script>
                alert('demande envoyer ');
            
                </script>";
                exit();
            } else {
                echo "Erreur lors de l'exécution de la requête d'insertion : " . mysqli_error($conn);
            }

            // Fermeture du statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Erreur lors de la préparation de la requête d'insertion : " . mysqli_error($conn);
        }
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Demande de Congé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 400px;
            max-width: 90%;
            text-align: center;
        }

        h2 {
            color: #007bff;
            margin-bottom: 30px;
            font-size: 24px;
        }

        label {
            color: #333;
            font-weight: bold;
        }

        input[type="text"], input[type="date"], textarea {
            width: calc(100% - 20px);
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            font-size: 16px;
        }

        input[type="text"]:focus, input[type="date"]:focus, textarea:focus {
            outline: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        select {
            width: calc(100% - 20px);
            padding: 15px;
            margin: 10px 0;
            border: none;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            font-size: 16px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        select:focus {
            outline: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(to right, #007bff, #0056b3);
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: linear-gradient(to right, #0056b3, #003d80);
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
    <h2>Demande de Congé</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="type">Type de congé :</label>
            <input type="text" id="type" name="type" required>
            <span><?php echo $type_err; ?></span>
        </div>
        <div>
            <label for="date_debut">Date de début :</label>
            <input type="date" id="date_debut" name="date_debut" required>
            <span><?php echo $date_debut_err; ?></span>
        </div>
        <div>
            <label for="date_fin">Date de fin :</label>
            <input type="date" id="date_fin" name="date_fin" required>
            <span><?php echo $date_fin_err; ?></span>
        </div>
        <div>
            <label for="employee_id">ID de l'employé :</label>
            <input type="number" id="employee_id" name="employee_id" required>
            <span><?php echo $employee_id_err; ?></span>
        </div>
        <div>
            <label for="statut">Statut :</label>
            <select id="statut" name="statut" required>
                <option value="Non">Non</option>
            </select>
            <span><?php echo $statut_err; ?></span>
        </div>
        <div>
            <label for="raison">Raison :</label>
            <textarea id="raison" name="raison" required></textarea>
            <span><?php echo $raison_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Envoyer">
        </div>
    </form>
</div>

</body>
</html>