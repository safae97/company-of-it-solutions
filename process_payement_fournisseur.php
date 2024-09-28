<?php
// Check if all form fields are filled
if(isset($_POST['receiverName']) && isset($_POST['receiverRIB']) && isset($_POST['totalpay']) && isset($_POST['datepay'])) {
    // Check if any of the fields are empty
    if(empty($_POST['receiverName']) || empty($_POST['receiverRIB']) || empty($_POST['totalpay']) || empty($_POST['datepay'])) {
        // If any field is empty, display an error message
        echo "<script>
        alert('Please fill in all fields');
        </script>";
    } else {
        // If all fields are filled, display success message
        echo "<script>
        alert('Payment sent successfully');
        document.location.href = 'facturationfournisseur.php';
        </script>";
    }
}
?>
