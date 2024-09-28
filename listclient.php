<!DOCTYPE html>
<html>
<head>
    <title>Affichage de la table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Contenu de la table</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Telephone</th>
    </tr>

    <?php
    include("dbconnection.php");

    // Exécution de la requête pour récupérer les données de la table
    $sql = "SELECT client_id, client_nom, client_prenom, email, telephone FROM client";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Affichage des données dans le tableau HTML
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["client_id"]. "</td><td>" . $row["client_nom"]. "</td><td>" . $row["client_prenom"]. "</td><td>" . $row["email"]. "</td><td>" . $row["telephone"]. "</td></tr>";


        }
    } else {
        echo "0 résultats";
    }

    // Fermeture de la connexion
    $conn->close();
    ?>
</table>

</body>
</html>
