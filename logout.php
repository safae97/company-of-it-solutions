<?php
session_start();

if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();

    // Set a temporary flag to indicate logout
    $_SESSION['logged_out'] = true;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Logout Page</title>
</head>
<body>
<?php
if (isset($_SESSION['logged_out'])) {
    echo "<script>
        alert('Logged out successfully');
        document.location.href = 'home.html';

    </script>";
    unset($_SESSION['logged_out']); 
// Clear the flag after use
}
?>
</body>
</html>
