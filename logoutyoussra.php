<?php
// Démarrer la session
session_start();

// Détruire toutes les données de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger vers une autre page après la déconnexion (par exemple, la page de connexion)
header("Location: loginclient.php"); // Assurez-vous de remplacer "login.php" par l'URL de la page vers laquelle vous souhaitez rediriger après la déconnexion
exit();
?>
