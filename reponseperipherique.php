<?php
include("dbconnection.php");

// Récupérer la liste des demandes de périphérique en attente
$sql = "SELECT * FROM demande WHERE statue = 'Envoyer'";
$result = mysqli_query($conn, $sql);

// Traitement des décisions du RH
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['valider'])) {
        $demande_id = $_POST['demande_id'];
        $sql_update = "UPDATE demande SET statue = 'Valider' WHERE demande_id = ?";
        
    } elseif (isset($_POST['traitement'])) {
        $demande_id = $_POST['demande_id'];
        $sql_update = "UPDATE demande SET statue = 'Rejeter' WHERE demande_id = ?";
    }

    if ($stmt = mysqli_prepare($conn, $sql_update)) {
        mysqli_stmt_bind_param($stmt, "i", $demande_id);
        if (mysqli_stmt_execute($stmt)) {
            // Redirection vers la page actuelle après la mise à jour
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Erreur lors de la mise à jour du statut : " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur lors de la préparation de la requête de mise à jour : " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des demandes de périphérique en attente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
  width: 1000px; /* Adjust width as needed */
  margin: 0 auto; /* Center the container horizontally */
margin-top: 3cm;
margin-left:5cm ;
}
        .welcome {
            text-align: center;
            font-size: 2rem; /* Adjust font size as desired */
            margin-top: 6rem;
        }
        .btn-container {
            display: flex;
            justify-content: center; /* Center buttons horizontally */
            gap: 20rem; /* Add space between buttons */
            margin-top: 15rem; /* Adjust margin for desired position */
        }
        .logout-btn {
            position: fixed; /* Fixed positioning for logout button */
            top: 3rem;
            right: 3rem;
            cursor: pointer;
        }
        .dropdown:hover .dropdown-menu {
        display: block;
         }

    </style>
</head>
<body>
<form action="logout.php" method="post">
    <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
    </div>
      </form>
      <div class="container">
    <h2>Liste des demandes de périphérique en attente</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom périphérique</th>
                <th>ID Employé</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['demande_id']; ?></td>
                    <td><?php echo $row['nom_peripherique']; ?></td>
                    <td><?php echo $row['employee_id']; ?></td>
                    <td><?php echo $row['statue']; ?></td>
                    <td>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="hidden" name="demande_id" value="<?php echo $row['demande_id']; ?>">
                            <button class="btn  btn-lg " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;margin-left:2cm;" type="submit" name="valider">Valider</button>
                            <button class="btn  btn-lg " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;margin-left:2cm;" type="submit" name="traitement">Rejeter</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
      </div>
</body>
</html>
