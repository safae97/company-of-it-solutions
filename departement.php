
<!DOCTYPE html>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Departements</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <style>
  .bs-example{
            margin: 20px;
        }
        .container {
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
  </style>
</head>
<body>
<form action="logout.php" method="post">
  <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
  </div>
    </form>
  <div class="container">
  <div class="bs-example">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Departements</h2>
                    </div>
                    <?php
                    include_once 'dbconnection.php';
                    $result = mysqli_query($conn,"SELECT * FROM departement");
                    ?>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                      <table class='table table-bordered table-striped'>
                      
                      <tr>
                        <td>departement id</td>
                        <td>departement nom</td>
                        <td>budget id</td>

                      </tr>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["departement_id"]; ?></td>
                        <td><?php echo $row["departement_nom"]; ?></td>
                        <td><?php echo $row["budget_id"]; ?></td>

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
    <h3 class="pull-left">Attribuer un Budget a une Departement</h3>
<br>
    <form action="addbudgettodepartement.php" method="post" >
    <div class="form-group">
  <label for="departmentname">Nom Departement :</label>
        <input type="text" id="departmentname" name="departmentname" required>
  </div>
      <div class="form-group">
        <label for="budgetid">Budget ID:</label>
        <input type="number" id="budgetid" name="budgetid" required>
      </div>
      <br>
      <div class="button-container">
        <button type="submit" class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite; ">Save Budget</button>
      </div>
    </form><br>    

    
  </div>
 
</body>
</html>
