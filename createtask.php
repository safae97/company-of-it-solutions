<?php

include_once("dbconnection.php"); // Include your database connection file

// Check if form is submitted and method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $taskid = $_POST["taskid"];
  $projectid = $_POST["projectid"];
  $taskdesc = $_POST["taskdesc"];
  $taskstatus = $_POST["taskstatus"];
  $dated = $_POST["dated"];
  $datef = $_POST["datef"];
  $employeeid = $_POST["employeeid"];

  // Create the SQL query to insert data
  $sql_query = "INSERT INTO tache (tache_id,projet_id, titre_tache, status, date_debut, date_fin,employee_id) 
  VALUES ('$taskid', '$projectid', '$taskdesc', '$taskstatus', '$dated', '$datef',' $employeeid')";

  // Execute the query and handle errors
  if (mysqli_query($conn, $sql_query)) {
    echo "<script>
    alert('Task created successfully ');
    document.location.href = 'tasks.php';

    </script>";  } else {
    echo "Error inserting record: " . mysqli_error($conn);
  }
}

?>