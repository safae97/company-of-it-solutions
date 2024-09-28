<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            background-image: url('/site\ images/esssai.jpg');
            font-family: Arial, sans-serif; /* Police de caractères */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            float: left;
            width: 50%; /* Chaque formulaire prend la moitié de la page */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            height: 150px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn {
            position: fixed; /* Fixed positioning for logout button */
            top: 3rem;
            right: 3rem;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<form action="logout.php" method="post">
    <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
    </div>
      </form><br><br>    <br><br>
<div class="container">
    

    <h2>Passer une commande</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="nom">Nom de l'Entreprise:</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Telephone:</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div >
            <label for="email">Email de fournisseur :</label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="sujet">Sujet:</label>
            <input type="text" id="sujet" name="sujet" required>
        </div>
        <div>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="3" cols="40" required></textarea>
        </div>
        <div>
            <label for="pdf">Fichier des peripheriques de:</label>
            <input type="file" id="pdf" name="pdf">
        </div>
        <div>
            <input class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;"type="submit" value="Envoyer" name="send">
        </div>
    </form>
</div>
<br><br>    <br><br><br><br><br>    <br><br>
<div class="container">
    

    <h2>Envoyer le formulaire au financier </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="nom">Nom de fournisseur:</label>
            <input type="text" id="nom" name="name" required>
        </div>
        <div>
            <label for="prenom">RIB:</label>
            <input type="text" id="prenom" name="rib" required>
        </div>
        <div >
            <label for="Mantant">Montant de votre commande :</label>
            <input type="text" id="email" name="montant">
        </div>
        <div>
            <input class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;" type="submit" value="Envoyer" name="send">
        </div>
    </form>
</div>

<?php
include("dbconnection.php");

if(isset($_POST['send'])) {
    $nom = isset($_POST['name']) ? $_POST['name'] : '';
    $rib = isset($_POST['rib']) ? $_POST['rib'] : '';
    $montant = isset($_POST['montant']) ? $_POST['montant'] : '';
    $manager = 1;

    $sql = "INSERT INTO formulaire_stock (manager_id, fournisseur_nom, RIB, montant) VALUES (?, ?, ?, ?)";

    if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "isss", $manager, $nom, $rib, $montant);

        if(mysqli_stmt_execute($stmt)) {
            echo "Les données ont été insérées avec succès dans la base de données.";
        } else {
            echo "Erreur lors de l'exécution de la requête d'insertion : " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur lors de la préparation de la requête d'insertion : " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

</body>
</html>
