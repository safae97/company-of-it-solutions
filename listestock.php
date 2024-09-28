
<?php
include("dbconnection.php");

// Vérifier si le formulaire de suppression a été soumis
if(isset($_POST['delete_stock'])) {
    // Récupérer l'identifiant de l'offre à supprimer
    $stock_id = $_POST['stock_id'];

    // Exécuter une requête SQL pour supprimer l'offre de la base de données
    $sql = "DELETE FROM stock WHERE stock_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $stock_id);
    mysqli_stmt_execute($stmt);

    // Rediriger vers la page actuelle pour actualiser la liste des offres
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Vérifier si le formulaire de modification de la description a été soumis
// Vérifier si le formulaire de modification de la quantité a été soumis
if(isset($_POST['update_qte'])) {
    // Récupérer l'identifiant de l'offre et la nouvelle quantité
    $stock_id = $_POST['stock_id']; // Assurez-vous d'utiliser $stock_id ici
    $new_quantity = $_POST['new_quantity'];

    // Exécuter une requête SQL pour mettre à jour la quantité de périphérique dans la base de données
    $sql = "UPDATE stock SET quantite_peripherique = ? WHERE stock_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $new_quantity, $stock_id); // Utilisez $stock_id ici
    mysqli_stmt_execute($stmt);

    // Rediriger vers la page actuelle pour actualiser la liste des offres
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
// Vérifier si le formulaire d'ajout de périphérique a été soumis
if(isset($_POST['add_stock'])) {
    // Récupérer les valeurs saisies pour le nouveau périphérique
    $nom_peripherique = $_POST['nom_peripherique'];
    $marque = $_POST['marque'];
    $quantite_peripherique = $_POST['quantite_peripherique'];
    $quantite_min = $_POST['quantite_min'];
    $manager_id = 1;

    // Exécuter une requête SQL pour ajouter le nouveau périphérique dans la base de données
    $sql = "INSERT INTO stock (manager_id,nom_peripherique, marque, quantite_peripherique, quantite_min) VALUES (?,?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issii",$manager_id, $nom_peripherique, $marque, $quantite_peripherique, $quantite_min);
    mysqli_stmt_execute($stmt);

    // Rediriger vers la page actuelle pour actualiser la liste des offres
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste du stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
       .container {
  width: 600px; /* Adjust width as needed */
  margin: 0 auto; /* Center the container horizontally */
margin-top: 3cm;
margin-left:12cm ;
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

    </style>
</head>
<body>
    <div class="table">
    <h2>Liste du stock</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>nom peripherique</th>
                <th>marque</th>
                <th>quantite peripherique</th>
                <th>quantite min</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer la liste des offres depuis la base de données
            $query = "SELECT stock_id, nom_peripherique, marque, quantite_peripherique, quantite_min FROM stock";
            $result = mysqli_query($conn, $query);
            
            // Afficher les offres sous forme de tableau
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['stock_id'] . "</td>";
                echo "<td>" . $row['nom_peripherique'] . "</td>";
                echo "<td>" . $row['marque'] . "</td>";
                echo "<td>" . $row['quantite_peripherique'] . "</td>";
                echo "<td>" . $row['quantite_min'] . "</td>";
                echo "<td>
                        <form action='" . $_SERVER['PHP_SELF'] . "' method='post'>
                            <input type='hidden' name='stock_id' value='" . $row['stock_id'] . "'>
                            <input type='int' name='new_quantity' placeholder='Nouvelle quantité'>
                            <input class='btn  btn-lg  ' data-bs-toggle='hover' style='background-color: #007bff;color: antiquewhite;' type='submit' name='update_qte' value='Modifier'>
                            <input class='btn  btn-lg  ' data-bs-toggle='hover' style='background-color: #007bff;color: antiquewhite;' type='submit' name='delete_stock' value='Supprimer'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    <div class="container">
    <h2>Ajouter un périphérique</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="nom_peripherique">Nom périphérique:</label>
        <input type="text" name="nom_peripherique" required><br>
        <label for="marque">Marque:</label>
        <input type="text" name="marque" required><br>
        <label for="quantite_peripherique">Quantité périphérique:</label>
        <input type="number" name="quantite_peripherique" required><br>
        <label for="quantite_min">Quantité min:</label>
        <input type="number" name="quantite_min" required><br>
        <input class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;" type="submit" name="add_stock" value="Ajouter périphérique">
    </form>
    </div>
</body>
</html>