<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Formations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><!DOCTYPE html>
   <style>
        .container {
            width: 80%; /* Ajustez la largeur selon vos besoins */
            margin: 0 auto; /* Centre le conteneur horizontalement */
            margin-top: 3rem; /* Marge supérieure de 3rem */
        }
        .formation {
            border: 1px solid #ccc; /* Bordure de 1px solide */
            padding: 1rem; /* Remplissage de 1rem */
            margin-bottom: 1rem; /* Marge inférieure de 1rem */
        }
        .formation h3 {
            margin-top: 0; /* Annule la marge supérieure pour les titres h3 */
        }
        .formation p {
            margin-bottom: 0.5rem; /* Marge inférieure de 0.5rem pour les paragraphes */
        }
        .logout-btn {
         position: fixed; /* Fixed positioning for logout button */
         top: 3rem;
         right: 3rem;
         cursor: pointer;
        }
    </style>
</head>

<body>
  <form action="logout.php" method="post">
  <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
  </div>
    </form> 
    <div class="container">
        <?php
        include("dbconnection.php");

        // Requête SQL pour sélectionner toutes les formations
        $sql = "SELECT * FROM formation";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Vérification s'il y a des formations
            if (mysqli_num_rows($result) > 0) {
                // Afficher les formations attribuées à l'employé avec l'ID 1
                while ($row = mysqli_fetch_assoc($result)) {
                    // Afficher les détails de la formation dans une boîte stylisée
                    echo "<div class='formation'>";
                    echo "<h3>Nom de la formation: " . $row["formation_nom"] . "</h3>";
                    echo "<p>Description: " . $row["formation_description"] . "</p>";
                    echo "</div>";
                }
            } else {
                // Aucune formation trouvée
                echo "<p>Aucune formation.</p>";
            }
        } else {
            // Erreur lors de l'exécution de la requête
            echo "<p>Erreur lors de l'exécution de la requête : " . mysqli_error($conn) . "</p>";
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($conn);
        ?>
    </div>
</body>

</html>