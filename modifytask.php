<?php
// Inclure le fichier de connexion à la base de données
include_once 'dbconnection.php';

// Vérifier si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $taskid = $_POST['taskid'];
    $status = $_POST['status'];

    // Préparer la requête SQL d'UPDATE
    $sql = "UPDATE tache SET status = ? WHERE tache_id = ?";

    // Préparer la déclaration SQL
    if($stmt = mysqli_prepare($conn, $sql)){
        // Liaison des variables à la déclaration préparée sous forme de paramètres
        mysqli_stmt_bind_param($stmt, "si", $param_status, $param_taskid);
        
        // Définir les valeurs des paramètres
        $param_status = $status;
        $param_taskid = $taskid;
        
        // Exécuter la déclaration préparée
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
            alert('Statut enregistré avec succès');
            window.location.href = 'employe.php';
            </script>";
        } else {
            echo "<script>
            alert('Il y a eu un problème lors de l'enregistrement du statut');
            window.location.href = 'employe.php';
            </script>"; 
        }

        // Fermer la déclaration
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
        alert('Erreur de préparation de la requête SQL');
        window.location.href = 'employe.php';
        </script>"; 
    }

    // Fermer la connexion
    mysqli_close($conn);
}
?>

