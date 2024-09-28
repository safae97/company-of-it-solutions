<?php
include("dbconnection.php");

// Récupérer la liste des demandes de congé en attente
$sql = "SELECT * FROM conge WHERE statut = 'Non'";
$result = mysqli_query($conn, $sql);

// Traitement des décisions du RH
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['valider'])) {
        $conge_id = $_POST['conge_id'];
        $sql_update = "UPDATE conge SET statut = 'Oui' WHERE conge_id = ?";
    } elseif (isset($_POST['rejeter'])) {
        $conge_id = $_POST['conge_id'];
        $sql_update = "UPDATE conge SET statut = 'Rejeté' WHERE conge_id = ?";
    }

    if ($stmt = mysqli_prepare($conn, $sql_update)) {
        mysqli_stmt_bind_param($stmt, "i", $conge_id);
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
    <title>Liste des demandes de congé en attente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
       .container {
  width: 600px; /* Adjust width as needed */
  margin: 0 auto; /* Center the container horizontally */
margin-top: 3cm;
margin-left:9cm ;
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
         .table{
            margin-top: 1cm;
margin-left:2cm ;
         }
         .conge-table {
    width: 100%;
    border-collapse: collapse;
}

.conge-table th,
.conge-table td {
    padding: 8px;
    border: 1px solid #ddd;
}

.conge-table th {
    background-color: #f2f2f2;
    text-align: left;
}

.conge-table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.conge-table tbody tr:hover {
    background-color: #ddd;
}

.conge-table button {
    margin-right: 5px; /* Add space between buttons */
}


    </style>
</head>
<body>
<form action="logout.php" method="post">
    <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
    </div>
      </form>
      <div class="container">
    <h2>Liste des demandes de congé en attente</h2>
    <br><br>
    <table class="conge-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Employé ID</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $row['conge_id']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['date_debut']; ?></td>
                <td><?php echo $row['date_fin']; ?></td>
                <td><?php echo $row['employee_id']; ?></td>
                <td><?php echo $row['statut']; ?></td>
                <td>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="conge_id" value="<?php echo $row['conge_id']; ?>">
                        <button class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;" data-bs-toggle="hover" type="submit" name="valider">Valider</button>
                       <br><br> <button class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;" data-bs-toggle="hover" type="submit" name="rejeter">Rejeter</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

      </div>
</body>
</html>
