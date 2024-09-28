<?php
include("dbconnection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="dist/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>
<script type="text/javascript" src="custom_task_table.js"></script>
<script type="text/javascript" src="custom_project_table.js"></script>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <style>.container {
  width: 600px; /* Adjust width as needed */
  margin: 0 auto; /* Center the container horizontally */

}

.form-group {
  margin-bottom: 1rem;
}

h2 {
  margin-bottom: 1rem;
}

.form-group {
  margin-bottom: 1rem;
}

h2 {
  margin-bottom: 1rem;
}
    
    .logout-btn {
      position: fixed; /* Fixed positioning for logout button */
      top: 3rem;
      right: 3rem;
      cursor: pointer;
    }
    .PayementForm {
            font-size: 3rem; /* Adjust font size as desired */
            margin-top: 6rem;
        }
        .form-group {
    display: grid; /* Use grid layout for each group */
    grid-template-columns: 150px auto; /* Define columns: fixed width for label, remaining space for input */
    margin-bottom: 10px; /* Add some spacing between groups */
  }
  .button-container {
    display: flex;
    justify-content: center; /* Center the button horizontally */
   
  }
  .welcome {
            text-align: center;
            font-size: 2rem; /* Adjust font size as desired */
            margin-top: 6rem;
        }
        .logout-btn {
            position: fixed; /* Fixed positioning for logout button */
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
  <h1 class="welcome">Liste des Projets</h1>
<br><br>
  <div class="container">
<table id="data_table" class="table table-striped">
<thead>
<tr>
<th>projet ID</th>
<th>projet ID</th>
<th>Nom de Projet</th>
<th>status</th>
<th>date debut</th>
<th>date fin</th>
</tr>
</thead>
<tbody>
<?php
$sql_query = "SELECT projet_id,projet_nom,  status, date_debut,date_fin FROM projet";
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
while( $developer = mysqli_fetch_assoc($resultset) ) {
?>
<tr id="<?php echo $developer ['projet_id']; ?>">
<td><?php echo $developer ['projet_id']; ?></td>
<td><?php echo $developer ['projet_id']; ?></td>
<td><?php echo $developer ['projet_nom']; ?></td>
<td><?php echo $developer ['status']; ?></td>
<td><?php echo $developer ['date_debut']; ?></td>
<td><?php echo $developer ['date_fin']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<br>
<h1 class="welcome">Liste des taches</h1>
<br><br>
  <div class="container">
<table id="data_table2" class="table table-striped">
<thead>
<tr>
<th>Tache Id</th>
<th>Tache Id</th>
<th>Titre de Tache</th>
<th>status</th>
<th>date debut</th>
<th>date fin</th>
<th>Projet ID</th>
<th>Employee ID</th>

</tr>
</thead>
<tbody>
<?php
$sql_query = "SELECT * FROM tache";
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
while( $developer = mysqli_fetch_assoc($resultset) ) {
?>
<tr id="<?php echo $developer ['tache_id']; ?>">
<td><?php echo $developer ['tache_id']; ?></td>
<td><?php echo $developer ['tache_id']; ?></td>
<td><?php echo $developer ['titre_tache']; ?></td>
<td><?php echo $developer ['status']; ?></td>
<td><?php echo $developer ['date_debut']; ?></td>
<td><?php echo $developer ['date_fin']; ?></td>
<td><?php echo $developer ['projet_id']; ?></td>
<td><?php echo $developer ['employee_id']; ?></td>

</tr>
<?php } ?>
</tbody>
</table>
<br>
</div>
<div class="button-container">
<a href="chefprojectindex.html">
  <button class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite;"type="button">Go Back</button>
</a>
</div>
    <br>

</body>
</html>