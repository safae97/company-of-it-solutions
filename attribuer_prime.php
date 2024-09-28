<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de prime</title>
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

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        select {
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
        select:focus {
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
        .logout-btn {
            position: fixed; /* Fixed positioning for logout button */
            top: 3rem;
            right: 3rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<form action="logout.php" method="post">
    <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
    </div>
      </form>
    <div class="container">
        <h2>Ajouter une prime</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="id_employee">ID de l'employé :</label>
                <input type="text" id="id_employee" name="id_employee" required>
            </div>
            <div>
                <label for="type_prime">Type de prime :</label>
                <select id="type_prime" name="type_prime" required>
                    <option value="fin_annee">Fin d'année</option>
                    <option value="celebration">Célébration</option>
                    <option value="">Autre</option>
                </select>
            </div>
            <input type="submit" name="add_prime" value="Ajouter prime">
        </form>
    </div>



<?php
// Inclure le fichier de connexion à la base de données
include("dbconnection.php");

// Vérifier si le formulaire a été soumis et si le bouton d'ajout de prime a été cliqué
if(isset($_POST['add_prime'])) {
    // Récupérer les valeurs saisies dans le formulaire
    $id_employee = $_POST['id_employee'];
    $type_prime = $_POST['type_prime'];
    $rh_id = 1; // Valeur fixe pour rh_id

    // Requête SQL d'insertion pour ajouter la prime dans la table prime
    $sql = "INSERT INTO prime (employee_id, type_prime, rh_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Vérifier si la préparation de la requête a réussi
    if ($stmt) {
        // Liaison des valeurs et exécution de la requête
        mysqli_stmt_bind_param($stmt, "iss", $id_employee, $type_prime, $rh_id);
        if (mysqli_stmt_execute($stmt)) {
            // Redirection vers une page de succès ou autre page si nécessaire
            echo "<script>
    alert('succefully added');
    document.location.href = 'choixtacheRH.html';

    </script>";
            exit();
        } else {
            echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
        }
    } else {
        echo "Erreur lors de la préparation de la requête : " . mysqli_error($conn);
    }

    // Fermer la connexion et la déclaration
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

</body>
</html>
