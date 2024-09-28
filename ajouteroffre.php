<?php
include("dbconnection.php");

$titre = $description = $date = "";
$rh_id=1;
$titre_err = $description_err = $date_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["titre"]))) {
        $titre_err = "Veuillez entrer un titre.";
    } else {
        $titre = trim($_POST["titre"]);
    }

    if (empty(trim($_POST["description"]))) {
        $description_err = "Veuillez entrer une description.";
    } else {
        $description = trim($_POST["description"]);
    }

    if (empty(trim($_POST["date"]))) {
        $date_err = "Veuillez entrer une date.";
    } else {
        $date = trim($_POST["date"]);
    }

    if (empty($titre_err) && empty($description_err) && empty($date_err)) {
        $sql = "INSERT INTO offre_emploi (rh_id ,titre, description, date) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "isss",$rh_id,  $titre, $description, $date);


            if (mysqli_stmt_execute($stmt)) {
                // Redirection HTML
                echo '<meta http-equiv="refresh" content="0;url=listoffre.php">';
                exit();
            } else {
                echo "Oops! Une erreur s'est produite. Veuillez réessayer plus tard.";
            }
            
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une offre d'emploi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   
    <style>
.logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 999;
        }    </style>
</head>

<body>
<form action="logout.php" method="post">
    <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
    </div>
      </form>
    <div class="container">
    <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une offre d'emploi</title>
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
        <h2>Ajouter une nouvelle offre d'emploi</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="titre">Titre :</label>
                <input type="text" id="titre" name="titre" value="<?php echo $titre; ?>" required>
                <span class="error"><?php echo $titre_err; ?></span>
            </div>
            <div>
                <label for="description">Description :</label>
                <input type="text" id="description" name="description" value="<?php echo $description; ?>" required>
                <span class="error"><?php echo $description_err; ?></span>
            </div>
            <div>
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" value="<?php echo $date; ?>" required>
                <span class="error"><?php echo $date_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Ajouter">
            </div>
        </form>
    </div>
    
</body>


</html>
