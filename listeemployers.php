<?php
include("dbconnection.php");

// Vérifier si le formulaire de suppression a été soumis
if(isset($_POST['delete_employee'])) {
    // Récupérer l'identifiant de l'employé à supprimer
    $employee_id = $_POST['employee_id'];

    // Exécuter une requête SQL pour supprimer l'employé de la base de données
    $sql = "DELETE FROM employee WHERE employee_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $employee_id);
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
    <title>Liste des employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Style CSS créatif */



        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 999;
        }

        .welcome {
            font-size: 3rem;
            margin-bottom: 2rem;
            color: #131517;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
        }

        .btn-custom {
            font-size: 1.5rem;
            padding: 1rem 2rem;
            border-radius: 25px;
            background-color: #007bff;
            border-color: #f5f7f5;
        }

        .btn-custom:hover {
            background-color: #007bff;
            border-color: #007bff;
        }
        .container {
  width: 600px; /* Adjust width as needed */
  margin: 0 auto; /* Center the container horizontally */

}
    </style>
</head>
<body>
<form action="logout.php" method="post">
    <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
    </div>
      </form>
      <br><br><br><br>
      <div class="container">
    <h2>Liste des employés</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer la liste des employés depuis la base de données
            $query = "SELECT employee_id, employee_nom, employee_prenom, date_naiss FROM employee";
            $result = mysqli_query($conn, $query);
            
            // Afficher les employés sous forme de tableau
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['employee_id'] . "</td>";
                echo "<td>" . $row['employee_nom'] . "</td>";
                echo "<td>" . $row['employee_prenom'] . "</td>";
                echo "<td>" . $row['date_naiss'] . "</td>";
                echo "<td>
                       
                        <form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
                            <input type='hidden' name='employee_id' value='" . $row['employee_id'] . "'>
                            <input class='btn  btn-lg  '' data-bs-toggle='hover' style='background-color: #007bff;color: antiquewhite;'type='submit' name='delete_employee' value='Supprimer'>
                        </form>
                        

                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
      
<br><br><br>
    <h2>Ajouter un employé</h2>
    <form action="ajouter_employee.php" method="get">
        <button class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;margin-left:5cm;margin-top:2cm;"type="submit">Ajouter un employé</button>
    </form>
    <br><br></div>
</body>
</html>