<?php
include("dbconnection.php");

$client_nom = $montant = $RIB = "";
$client_id = 1; // Assuming a static value for now
$client_nom_err = $montant_err = $RIB_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handling client_nom
    if (empty(trim($_POST["client_nom"]))) {
        $client_nom_err = "Veuillez entrer un nom.";
    } else {
        $client_nom = trim($_POST["client_nom"]);
    }

    // Handling montant
    if (empty(trim($_POST["montant"]))) {
        $montant_err = "Veuillez entrer un montant.";
    } else {
        $montant = trim($_POST["montant"]);
    }

    // Handling RIB
    if (empty(trim($_POST["RIB"]))) {
        $RIB_err = "Veuillez entrer un RIB.";
    } else {
        $RIB = trim($_POST["RIB"]);
    }

    // If there are no errors, proceed with the database insertion
    if (empty($client_nom_err) && empty($montant_err) && empty($RIB_err)) {
        $sql = "INSERT INTO formulaire_stock (manager_id, fournisseur_nom, montant, RIB) VALUES ( ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "isii", $client_id, $client_nom, $montant, $RIB);

            if (mysqli_stmt_execute($stmt)) {
                // Redirect on successful insertion
                header("Location: formulaire.php");
                exit();
            } else {
                echo "Oops! Une erreur s'est produite. Veuillez réessayer plus tard.";
            }

            mysqli_stmt_close($stmt);
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
</head>
<body>
    <h1>Entrer les informations du fournisseut</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
        <label for="client_nom">Nom de fournisseur:</label><br>
        <input type="text"  name="client_nom" value="<?php echo $client_nom; ?>">
        <span><?php echo $client_nom_err; ?></span>
    </div>
    <div>
        <label for="montant">Montant:</label><br>
        <input type="number" name="montant" value="<?php echo $montant; ?>">
        <span><?php echo $montant_err; ?></span>
    </div>
    <div>
        <label for="RIB">RIB:</label><br>
        <input type="number" name="RIB" value="<?php echo $RIB; ?>">
        <span><?php echo $RIB_err; ?></span>
    </div>

    <input type="submit" value="Envoyer">
    </form>
</body>
</html>