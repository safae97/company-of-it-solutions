<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
        /* Style pour la classe "welcome" */
        .welcome {
            text-align: center;
            font-size: 2rem; /* Ajustez la taille de la police selon vos préférences */
            margin-top: 6rem; /* Ajustez la marge supérieure pour la position souhaitée */
        }

        /* Style pour la classe "btn-container" */
        .btn-container {
            display: flex;
            justify-content: center; /* Centre les boutons horizontalement */
            gap: 20rem; /* Ajoute de l'espace entre les boutons */
            margin-top: 15rem; /* Ajustez la marge pour la position souhaitée */
        }

        /* Style pour la classe "logout-btn" */
        .logout-btn {
            position: fixed; /* Position fixe pour le bouton de déconnexion */
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
    <h1 class="welcome">Interface Client</h1>
    <div class="btn-container">
        <div class="dropdown mr-2">
            <button type="button" class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite; " data-bs-toggle="hover" onclick="window.location.href='contact_us.php';">Demande de conseil et accompagnement</button>
        </div>
        
        <div class="dropdown">
            <button type="button" class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite; "  data-bs-toggle="hover" onclick="window.location.href='pagepassercommande.php';">Demande de maintenance</button>
        </div>
        <div class="dropdown">
            <button type="button" class="btn  btn-lg " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite; "  data-bs-toggle="hover" onclick="window.location.href='statussuivi.php';">Suivi projet</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EQh7TCQayCWfB3qSDQLEU1Q+TjtEyHB8sEv/yQpCt705+YAQjOiSDN5v9z" crossorigin="anonymous"></script>
</body>
</html>