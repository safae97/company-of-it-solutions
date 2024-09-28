<?php
include("dbconnection.php");

// Vérifier si le formulaire de suppression a été soumis
if(isset($_POST['delete_formation'])) {
    // Récupérer l'identifiant de l'employé à supprimer
    $formation_id = $_POST['formation_id'];

    // Exécuter une requête SQL pour supprimer l'employé de la base de données
    $sql = "DELETE FROM formation WHERE formation_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $formation_id);
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
    <title>Liste des formations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
       .container {
  width: 600px; /* Adjust width as needed */
  margin: 0 auto; /* Center the container horizontally */
margin-top: 3cm;
margin-left:12cm ;
}
.hey{
    width: 600px; /* Adjust width as needed */

    margin-left:12cm ;

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

    <br><br><br>
    <div class="hey">
    <h2>Liste des formations</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Budget</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer la liste des formations depuis la base de données
            $query = "SELECT formation_id, budget_id, formation_nom, formation_description FROM formation";
            $result = mysqli_query($conn, $query);
            
            // Afficher les formations sous forme de tableau
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['formation_id'] . "</td>";
                echo "<td>" . $row['formation_nom'] . "</td>";
                echo "<td>" . $row['budget_id'] . "</td>";
                echo "<td>" . $row['formation_description'] . "</td>";
                echo "<td>
                        <form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
                            <input  type='hidden' name='formation_id' value='" . $row['formation_id'] . "'>
                            <input class='btn  btn-lg  '' data-bs-toggle='hover' style='background-color: #007bff;color: antiquewhite; margin-left:2cm;' type='submit' name='delete_formation' value='Supprimer'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    <div class="container">
    <h2>Ajouter une formation</h2>
    <form action="ajouterformation.php" method="get">
        <button class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;margin-left:2cmcm;margin-top:2cm;"type="submit">Ajouter une formation</button>
    </form>
    </div>

</body>
</html>