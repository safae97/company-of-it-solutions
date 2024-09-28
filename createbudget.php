

<?php
include("dbconnection.php");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: "
		. $conn->connect_error);
}
$budget= $_POST['budget'];

    // Prepare SQL statement
    $sql = "INSERT INTO budget (montant) VALUES ('$budget')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('budget saved successfully ');
    document.location.href = 'financierindex.html';

    </script>";
} else {
	echo "<script>
    alert('there has been a problem! ');
    document.location.href = 'financierindex.html';

    </script>"; 
    $sql . "<br>" . $conn->error;
}
