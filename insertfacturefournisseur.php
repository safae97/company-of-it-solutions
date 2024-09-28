<?php
include("dbconnection.php");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: "
		. $conn->connect_error);
}
$ID= $_POST['form_id'];
$RIB = $_POST['rib'];
$Date = $_POST['date'];
$total = $_POST['total'];

    // Prepare SQL statement
    $sql = "INSERT INTO facture_stock (form_id, RIB, montant, date) VALUES ('$ID','$RIB','$total','$Date')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('Facture saved successfully ');
    document.location.href = 'facturationfournisseur.php';

    </script>";
} else {
	echo "<script>
    alert('there has been a problem! ');
    document.location.href = 'facturationfournisseur.php';

    </script>"; 
    $sql . "<br>" . $conn->error;
}
