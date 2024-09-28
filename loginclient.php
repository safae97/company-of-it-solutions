<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
include("dbconnection.php");

// Initialiser les variables de message d'erreur
$client_nom = $email = "";
$client_nom_err = $email_err = $login_err = "";

// Traiter le formulaire lorsque soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider les données saisies
    if (empty(trim($_POST["client_nom"])) && empty(trim($_POST["email"]))) {
        $login_err = "Veuillez entrer votre nom de client ou votre email.";
    } else {
        // Récupérer les valeurs saisies dans le formulaire
        $client_nom = trim($_POST["client_nom"]);
        $email = trim($_POST["email"]);
    }

    // Si aucune erreur, vérifier les informations de connexion
    if (empty($client_nom_err) && empty($email_err)) {
        // Préparer une requête SQL pour vérifier les informations de connexion
        $sql = "SELECT  client_nom, email FROM client WHERE client_nom = ? OR email = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_client_nom, $param_email);
            $param_client_nom = $client_nom;
            $param_email = $email;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                // Vérifier si l'utilisateur existe, si oui, rediriger
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Rediriger l'utilisateur vers la page d'accueil
                    header("location: pagehome.php");
                } else {
                    // Afficher un message d'erreur si l'utilisateur n'existe pas
                    $login_err = "Aucun compte trouvé avec ces informations.";
                }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 40px;
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
        input[type="email"] {
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
        input[type="email"]:focus {
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

        p {
            text-align: center;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
    <h2>Connexion</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="client_nom">Nom de Client:</label>
            <input type="text" id="client_nom" name="client_nom" value="<?php echo $client_nom; ?>">
            <span><?php echo $client_nom_err; ?></span>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            <span><?php echo $email_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Se connecter">
        </div>
        <p><?php echo $login_err; ?></p>
    </form>
    </div>
</body>
</html>
