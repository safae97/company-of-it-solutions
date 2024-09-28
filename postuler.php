<?php
session_start();

include("dbconnection.php");

// Récupérer la liste des offres d'emploi depuis la base de données
$query = "SELECT * FROM Offre_emploi";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Liste des formations</title>
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
    <!-- Ajout du bouton à la fin du tableau -->
    <div class="text-center">
        <a href="#" class="btn btn-primary">Postuler</a>
    </div>

</body>

</html>
