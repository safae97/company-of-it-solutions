<?php
session_start();

include("dbconnection.php");



// Récupérer la liste des utilisateurs depuis la base de données
$query = "SELECT * FROM Offre_emploi";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Liste des offres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .table {
            background-color: rgba(255, 255, 255, 0.8); /* Fond semi-transparent pour améliorer la lisibilité */
        }

        .table th,
        .table td {
            vertical-align: middle; /* Centrer le contenu verticalement */
        }
    </style>
</head>

<body>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID d'offre</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date limite</th>
                    <th>  </th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $row['emploi_id'] ?></td>
                        <td><?= $row['titre'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['date'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>
    <a href="cv.php" class="btn btn-lg" style="background-color: #007bff; color: antiquewhite;margin-left:15cm;">Postuler</a>
<br><br>

</body>

</html>

