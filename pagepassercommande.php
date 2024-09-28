<?php
include("dbconnection.php");

$client_nom = $montant = $RIB = $projet_nom = "";
$client_id = $adminclient_id = $chefproject_id = 1;
$client_nom_err = $montant_err = $RIB_err = $projet_nom_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handling client_nom
    if (empty(trim($_POST["client_nom"]))) {
        $client_nom_err = "Veuillez entrer un nom.";
    } else {
        $client_nom = trim($_POST["client_nom"]);
    }

    // Assigning montant value to 1000
    $montant = 1000;

    // Handling RIB
    if (empty(trim($_POST["RIB"]))) {
        $RIB_err = "Veuillez entrer un RIB.";
    } else {
        $RIB = trim($_POST["RIB"]);
    }

    // Handling projet_nom
    if (empty(trim($_POST["projet_nom"]))) {
        $projet_nom_err = "Veuillez entrer un nom de projet.";
    } else {
        $projet_nom = trim($_POST["projet_nom"]);
    }

    // If there are no errors, proceed with the database insertion
    if (empty($client_nom_err) && empty($montant_err) && empty($RIB_err) && empty($projet_nom_err)) {
        // Insertion dans la table formulaire_client
        $sql_client = "INSERT INTO formulaire_client (client_id, adminclient_id, client_nom, montant, RIB) VALUES (?, ?, ?,?, ?)";
        if ($stmt_client = mysqli_prepare($conn, $sql_client)) {
            mysqli_stmt_bind_param($stmt_client, "iisii", $client_id, $adminclient_id, $client_nom, $montant, $RIB);

            if (mysqli_stmt_execute($stmt_client)) {
                mysqli_stmt_close($stmt_client);
            } else {
                echo "Oops! Une erreur s'est produite lors de l'insertion dans la table formulaire_client. Veuillez réessayer plus tard.";
                exit();
            }
        } else {
            echo "Oops! Une erreur s'est produite. Veuillez réessayer plus tard.";
            exit();
        }

        // Insertion dans la table projet
        $_cid = $client_id; // Utilisation du même client_id pour le chef du projet (à adapter selon votre logique métier)
        $sql_projet = "INSERT INTO projet (projet_nom, chefproject_id, client_id, adminclient_id) VALUES (?, ?, ?, ?)";
        if ($stmt_projet = mysqli_prepare($conn, $sql_projet)) {
            mysqli_stmt_bind_param($stmt_projet, "siii", $projet_nom, $chefproject_id, $client_id, $adminclient_id);

            if (mysqli_stmt_execute($stmt_projet)) {
                mysqli_stmt_close($stmt_projet);
                // Redirect on successful insertion
                header("Location: client.php");
                exit();
            } else {
                echo "Oops! Une erreur s'est produite lors de l'insertion dans la table projet. Veuillez réessayer plus tard.";
                exit();
            }
        } else {
            echo "Oops! Une erreur s'est produite. Veuillez réessayer plus tard.";
            exit();
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'insertion client</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><!DOCTYPE html>

    <style>
        .container {
            width: 600px; /* Adjust width as needed */
            margin: 0 auto; /* Center the container horizontally */
            justify-content: center; /* Center buttons horizontally */
            margin-top: 2cm;
            display: block;
        }
        .logout-btn {
            position: fixed; /* Fixed positioning for logout button */
            top: 3rem;
            right: 3rem;
            cursor: pointer;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<form action="logout.php" method="post">
    <div class="logout-btn">
        <button type="submit" name="logout" class="btn btn-danger">Logout</button>
    </div>
</form>
<div class="container">
    <h1>Entrer vos Informations</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="projet_nom">Nom du projet:</label><br>
            <input type="text" name="projet_nom" value="<?php echo $projet_nom; ?>">
            <span><?php echo $projet_nom_err; ?></span>
        </div>
        <div>
            <label for="client_nom">Nom du client:</label><br>
            <input type="text" name="client_nom" value="<?php echo $client_nom; ?>">
            <span><?php echo $client_nom_err; ?></span>
        </div>
        <label for="montant">Montant: 1000 DH</label><br>
        <span><?php echo $montant;100 ?></span>
        <span><?php echo $montant_err; ?></span>
        <div>
            <label for="RIB">RIB:</label><br>
            <input type="number" name="RIB" value="<?php echo $RIB; ?>">
            <span><?php echo $RIB_err; ?></span>
        </div>
        <br> <br>
        <input class="btn  btn-lg  " data-bs-toggle="hover"  style=" background-color: #007bff;color: antiquewhite; display: block; margin: 0 auto; margin-bottom: 2rem;" type="submit" value="Envoyer">
    </form>
</div>
</body>
</html>