
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
<script type="text/javascript" src="custom_project_table.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facturation</title>
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
<br><br>
<div class="bs-example">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Liste des taches</h2>
                    </div>
                    <?php
                    include_once 'dbconnection.php';
                    $result = mysqli_query($conn,"SELECT tache_id,titre_tache,employee_id,projet_id FROM tache");
                    ?>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                      <table class='table table-bordered table-striped'>
                      
                      <tr>
                        <td>tache id</td>
                        <td>Titre de tache </td>
                        <td>employee id</td>
                        <td>projet id</td>

                      </tr>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["tache_id"]; ?></td>
                        <td><?php echo $row["titre_tache"]; ?></td>
                        <td><?php echo $row["employee_id"]; ?></td>
                        <td><?php echo $row["projet_id"]; ?></td>

                    </tr>
                    <?php
                    $i++;
                    }
                    ?>
                    </table>
                     <?php
                    }
                    else{
                        echo "No result found";
                    }
                    ?>
                </div>
            </div>        
        </div>
    </div>
  

<h3 class="pull-left">Creer une Tache</h3>
<br>
    <form action="createtask.php" method="post" >
    <div class="form-group">
  <label for="taskid">Tache ID:</label>
        <input type="text" id="taskid" name="taskid" required>
  </div>
  <div class="form-group">
        <label for="projectid">Projet ID:</label>
        <input type="number" id="projectid" name="projectid" required>
      </div>
      <div class="form-group">
        <label for="taskdesc">Titre de Tache:</label>
        <input type="text" id="taskdesc" name="taskdesc" required>
      </div>
      <div class="form-group">
        <label for="taskstatus">Status de Tache:</label>
        <select id="taskstatus" name="taskstatus" >
      <option value="afaire">A faire</option>
      <option value="encours">en cours d'execution</option>
      <option value="termine">terminee</option>

    </select>      </div>
      <div class="form-group">
        <label for="dated">Date Debut:</label>
        <input type="date" id="dated" name="dated" required>
      </div>
      <div class="form-group">
        <label for="datef">Date Fin:</label>
        <input type="date" id="datef" name="datef" required>
      </div>
      <div class="form-group">
        <label for="employeeid">Employees ID:</label>
        <input type="number" id="employeeid" name="employeeid" >
      </div>
      <br>
      <div class="button-container">
        <button type="submit" class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite; " ">Enregistrer Tache</button>
      </div>

    </form>
    <br>
    <form action="deletetask.php" method="post" >
    <div class="form-group">
  <label for="taskid">Tache ID:</label>
        <input type="text" id="taskid" name="taskid" required>
  </div>
      <br>
      <div class="button-container">
      <button class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite; "type="submit">Supprimer Tache</button>
      </div>
    </form><br>
    

</body>
</html>



