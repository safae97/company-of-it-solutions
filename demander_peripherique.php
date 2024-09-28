<?php
include("dbconnection.php");

// Initialisation des variables pour stocker les données du formulaire
$nom_peripherique = $employer_id = "";
$manager_id = 1;
$statut = "Envoyer"; // Valeur par défaut pour le statut
$nom_peripherique_err = $employer_id_err = "";

// Traitement du formulaire lors de sa soumission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation du champ Nom de périphérique
    $nom_peripherique = $_POST["nom_peripherique"];

    // Validation du champ ID de l'employé
    $employer_id = $_POST["employer_id"];

    // Vérifier s'il n'y a pas d'erreurs avant d'insérer dans la base de données
    if (empty($nom_peripherique_err) && empty($employer_id_err)) {
        // Préparation de la requête SQL d'insertion
        $sql = "INSERT INTO demande (nom_peripherique, employee_id, manager_id, statue) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Liaison des paramètres avec les valeurs saisies dans le formulaire
            mysqli_stmt_bind_param($stmt, "siis", $nom_peripherique, $employer_id, $manager_id, $statut);

            // Exécution de la requête préparée
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>
                alert('demande envoyee ');
                document.location.href = 'connectionemployer.php';
            
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
    <title>Formulaire de Demande de Périphérique</title>
    <style>
        .container {
  width: 600px; /* Adjust width as needed */
  margin: 0 auto; /* Center the container horizontally */
  justify-content: center; /* Center buttons horizontally */
  margin-top:6cm;
  margin-right:90cm;
}
        .logout-btn {
      position: fixed; /* Fixed positioning for logout button */
      top: 3rem;
      right: 3rem;
      cursor: pointer;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<form action="logout.php" method="post">
  <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
  </div><div class= "container">
    </form>
    
    <h2>Demande de Périphérique</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="nom_peripherique">Nom du périphérique :</label>
            <input type="text" id="nom_peripherique" name="nom_peripherique" required>
            <span><?php echo $nom_peripherique_err; ?></span>
        </div>
        <br><br>
        <div>
            <label for="employer_id">ID de l'employé :</label>
            <input type="number" id="employer_id" name="employer_id" required>
            <span><?php echo $employer_id_err; ?></span>
        </div>
        <div>
        <input class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;" type="submit" value="Envoyer">
        </div>
    </form>
</body>
</html>