<?php
// Include your database connection file (dbconnection.php)
include("dbconnection.php");

// Check if the task ID is set and not empty
if(isset($_POST['taskid']) && !empty($_POST['taskid'])) {
    // Sanitize the task ID to prevent SQL injection
    $task_id = mysqli_real_escape_string($conn, $_POST['taskid']);

    // SQL query to delete the task with the provided ID
    $sql_query = "DELETE FROM tache WHERE tache_id = '$task_id'";

    // Execute the query
    if(mysqli_query($conn, $sql_query)) {
        echo "<script>
                alert('Task deleted successfully');
                document.location.href = 'chefprojectindex.html';
              </script>";
    } else {
        echo "<script>
                alert('There has been a problem deleting the task');
                console.log('Error: " . mysqli_error($conn) . "');
                document.location.href = 'tasks.php';
              </script>";
    }
} else {
    // Handle case where task ID is not set or empty
    echo "<script>
            alert('Task ID is missing or empty');
            document.location.href = 'tasks.php';
          </script>";
}

// Close the database connection
mysqli_close($conn);
?>