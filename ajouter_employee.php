<?php
include("dbconnection.php");

$employee_nom = $employee_prenom = $date_naiss = "";
$rh_id = 1;
$employee_nom_err = $employee_prenom_err = $date_naiss_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    if (empty($employee_nom_err) && empty($employee_prenom_err) && empty($date_naiss_err)) {
        $sql = "INSERT INTO employee (rh_id, employee_nom, employee_prenom, date_naiss) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "isss", $rh_id, $employee_nom, $employee_prenom, $date_naiss);

            if (mysqli_stmt_execute($stmt)) {
                // Redirection
                header("Location: listeemployers.php");
                exit();
            } else {
                echo "Oops! Une erreur s'est produite. Veuillez réessayer plus tard.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un employé</title>
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
        input[type="date"] {
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
        input[type="date"]:focus {
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
    <div class="container">
        <h2>Ajouter un nouvel employé</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="employee_nom">Nom:</label>
                <input type="text" id="employee_nom" name="employee_nom" value="<?php echo $employee_nom; ?>" required>
                <span class="error"><?php echo $employee_nom_err; ?></span>
            </div>
            <div>
                <label for="employee_prenom">Prénom:</label>
                <input type="text" id="employee_prenom" name="employee_prenom" value="<?php echo $employee_prenom; ?>" required>
                <span class="error"><?php echo $employee_prenom_err; ?></span>
            </div>
            <div>
                <label for="date_naiss">Date de naissance:</label>
                <input type="date" id="date_naiss" name="date_naiss" value="<?php echo $date_naiss; ?>" required>
                <span class="error"><?php echo $date_naiss_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Ajouter">
            </div>
        </form>
    </div>
</body>

</html>

