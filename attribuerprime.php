<?php
include("dbconnection.php");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: "
		. $conn->connect_error);
}
$ID= $_POST['employeeId'];
$amount = $_POST['amount'];


    // Prepare SQL statement
    $sql="UPDATE prime SET montant = '$amount'  WHERE employee_id = '$ID' ";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('succefully sent');
    document.location.href = 'employee.php';

    </script>";
} else {
	echo "<script>
    alert('there has been a problem! ');
    document.location.href = 'employee.php';

    </script>"; 
    $sql . "<br>" . $conn->error;
}