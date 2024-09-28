<?php
// Vérifie si un ID d'employé a été passé via GET
if (!isset($_GET['employee_id'])) {
    // Redirige vers la liste des employés si aucun ID n'a été fourni
    header("Location: listeemployers.php");
    exit();
}

// Inclut le fichier de connexion à la base de données
include("dbconnection.php");

// Initialise les variables pour stocker les valeurs de l'employé
$employee_id = $_GET['employee_id'];
$employee_nom = $employee_prenom = $date_naiss = "";
$employee_nom_err = $employee_prenom_err = $date_naiss_err = "";

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valide et met à jour les attributs de l'employé
    if (empty(trim($_POST["employee_nom"]))) {
        $employee_nom_err = "Veuillez entrer un nom.";
    } else {
        $employee_nom = trim($_POST["employee_nom"]);
    }

    if (empty(trim($_POST["employee_prenom"]))) {
        $employee_prenom_err = "Veuillez entrer un prénom.";
    } else {
        $employee_prenom = trim($_POST["employee_prenom"]);
    }

    if (empty(trim($_POST["date_naiss"]))) {
        $date_naiss_err = "Veuillez entrer une date de naissance.";
    } else {
        $date_naiss = trim($_POST["date_naiss"]);
    }

    // Si aucune erreur de validation, exécute la mise à jour dans la base de données
    if (empty($employee_nom_err) && empty($employee_prenom_err) && empty($date_naiss_err)) {
        $sql = "UPDATE employee SET employee_nom = ?, employee_prenom = ?, date_naiss = ? WHERE employee_id = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $employee_nom, $employee_prenom, $date_naiss, $employee_id);

            if (mysqli_stmt_execute($stmt)) {
                // Redirige vers la liste des employés après la mise à jour
                header("Location: listeemployers.php");
                exit();
            } else {
                echo "Oops! Une erreur s'est produite. Veuillez réessayer plus tard.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
} else {
    // Sélectionne l'employé à modifier en fonction de son ID
    $sql = "SELECT employee_nom, employee_prenom, date_naiss FROM employee WHERE employee_id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $employee_id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            
            // Vérifie si l'employé existe
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $employee_nom, $employee_prenom, $date_naiss);
                mysqli_stmt_fetch($stmt);
            } else {
                // Redirige vers la liste des employés si l'employé n'existe pas
                header("Location: listeemployers.php");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un employé</title>
</head>
<body>
    <h2>Modifier un employé</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
        <div>
            <label>Nom:</label>
            <input type="text" name="employee_nom" value="<?php echo $employee_nom; ?>">
            <span><?php echo $employee_nom_err; ?></span>
        </div>
        <div>
            <label>Prénom:</label>
            <input type="text" name="employee_prenom" value="<?php echo $employee_prenom; ?>">
            <span><?php echo $employee_prenom_err; ?></span>
        </div>
        <div>
            <label>Date de naissance:</label>
            <input type="date" name="date_naiss" value="<?php echo $date_naiss; ?>">
            <span><?php echo $date_naiss_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Enregistrer les modifications">
        </div>
    </form>
</body>
</html>
