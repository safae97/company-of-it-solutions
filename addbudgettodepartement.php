<?php
include("dbconnection.php");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: "
		. $conn->connect_error);
}
$departementname= $_POST['departmentname'];
$budgetid = $_POST['budgetid'];
$formationname= $_POST['formationname'];


    // Prepare SQL statement
    $sql=" UPDATE departement SET budget_id = '$budgetid'  WHERE departement_nom = '$departementname' ";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('modification succefully saved');
    document.location.href = 'financierindex.html';

    </script>";
} else {
	echo "<script>
    alert('there has been a problem! ');
    document.location.href = 'financierindex.html';

    </script>"; 
    $sql . "<br>" . $conn->error;
}