<?php
// Inclure le fichier de connexion à la base de données
include("dbconnection.php");

// Initialiser les variables de message d'erreur
$client_nom_err = $client_prenom_err = $email_err = $telephone_err =  "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs saisies dans le formulaire
    $client_nom = $_POST['client_nom'];
    $client_prenom = $_POST['client_prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Valider les données saisies
    if(empty($client_nom)) {
        $client_nom_err = "Veuillez entrer votre nom.";
    }
    if(empty($client_prenom)) {
        $client_prenom_err = "Veuillez entrer votre prénom.";
    }
    if(empty($email)) {
        $email_err = "Veuillez entrer votre email.";
    }
    if(empty($telephone)) {
        $telephone_err = "Veuillez entrer votre numéro de téléphone.";
    }

    // Si aucune erreur, insérer les données dans la base de données
    if(empty($client_nom_err) && empty($client_prenom_err) && empty($email_err) && empty($telephone_err)) {
        // Préparer la requête SQL pour l'insertion
        $sql = "INSERT INTO client (client_nom, client_prenom, email, telephone) VALUES (?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($conn, $sql)) {
            // Liage des paramètres à la requête
            mysqli_stmt_bind_param($stmt, "ssss", $client_nom, $client_prenom, $email, $telephone);

            // Exécution de la requête
            if(mysqli_stmt_execute($stmt)) {
                // Rediriger l'utilisateur vers une page de succès ou de connexion
                echo "<script>
    alert('Signed Up successfully ');
    document.location.href = 'loginclient.php';

    </script>";
            } else {
                echo "<script>
    alert('Error ');
    document.location.href = 'home.html';

    </script>";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Fermer la connexion à la base de données
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
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
        input[type="email"]:focus,
        input[type="tel"]:focus {
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

        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="client_nom">Nom:</label>
                <input type="text" id="client_nom" name="client_nom" value="<?php echo isset($_POST['client_nom']) ? $_POST['client_nom'] : ''; ?>" required>
                <span class="error"><?php echo $client_nom_err; ?></span>
            </div>
            <div>
                <label for="client_prenom">Prénom:</label>
                <input type="text" id="client_prenom" name="client_prenom" value="<?php echo isset($_POST['client_prenom']) ? $_POST['client_prenom'] : ''; ?>" required>
                <span class="error"><?php echo $client_prenom_err; ?></span>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div>
                <label for="telephone">Téléphone:</label>
                <input type="tel" id="telephone" name="telephone" value="<?php echo isset($_POST['telephone']) ? $_POST['telephone'] : ''; ?>">
                <span class="error"><?php echo $telephone_err; ?></span>
            </div>
            <div>
                <input type="submit" value="S'inscrire">
            </div>
        </form>
        <p>Déjà un compte? <a href="loginclient.php">Connectez-vous ici</a>.</p>
    </div>
</body>
</html>

