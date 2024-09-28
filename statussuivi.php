<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><!DOCTYPE html>
<style>
        .container {
            width: 80%; /* Adjust width as needed */
            margin: 0 auto; /* Center the container horizontally */
        }
        .logout-btn {
            position: fixed; /* Position fixe pour le bouton de déconnexion */
            top: 3rem;
            right: 3rem;
            cursor: pointer;
        }
    </style>
</head>

<body>
<form action="logout.php" method="post">
  <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
  </div>
    </form>
    <br><br><div class="container">
    <h1 class="text-center mt-5">Projet Status</h1>
    
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">Project Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                include("dbconnection.php");

                // Prepare the SQL query to retrieve the "projet_nom" and "status" columns from the "projet" table
                $sql = "SELECT projet_nom, status FROM projet";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if ($result && mysqli_num_rows($result) > 0) {
                    // Fetch the data and display it in table rows
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['projet_nom'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // No records found
                    echo "<tr><td colspan='2' class='text-center'>No records found</td></tr>";
                }

                // Free the result set
                mysqli_free_result($result);

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
