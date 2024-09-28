<?php
include("dbconnection.php");

// Vérifier si le formulaire de suppression a été soumis
if(isset($_POST['delete_client'])) {
    // Récupérer l'identifiant de l'employé à supprimer
    $client_id = $_POST['client_id'];

    // Exécuter une requête SQL pour supprimer l'employé de la base de données
    $sql = "DELETE FROM client WHERE client_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $client_id);
    mysqli_stmt_execute($stmt);

    // Rediriger vers la page actuelle pour actualiser la liste des employés
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
  width: 600px; /* Adjust width as needed */
  margin: 0 auto; /* Center the container horizontally */
margin-top: 5cm;
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
    <h2>Liste des clients</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Telephone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer la liste des employés depuis la base de données
            $query = "SELECT client_id, client_nom, client_prenom, email, telephone FROM client";
            $result = mysqli_query($conn, $query);
            
            // Afficher les employés sous forme de tableau
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['client_id'] . "</td>";
                echo "<td>" . $row['client_nom'] . "</td>";
                echo "<td>" . $row['client_prenom'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                
                echo "<td>" . $row['telephone'] . "</td>"  ;
                echo "<td>
                
                <form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
                    <input class='btn  btn-lg  dropdown-toggle'data-bs-toggle='hover' style='background-color: #007bff;color: antiquewhite; ' type='hidden' name='client_id' value='" . $row['client_id'] . "'>
                    <input class='btn  btn-lg  dropdown-toggle'data-bs-toggle='hover' style='background-color: #007bff;color: antiquewhite;margin-left: 2cm; 'type='submit' name='delete_client' value='Supprimer'>
                </form>
                

                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
      </div>
    
</body>
</html>