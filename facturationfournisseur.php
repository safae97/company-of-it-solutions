<?php

// Define company RIB information (replace with your actual details)
$companyRIB = [
  'bankCode' => 'XXXX',
  'branchCode' => 'XXXX',
  'accountNumber' => 'XXXXXXXXXXXXXXXX',
  'RIBKey' => 'XX'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facturation Stock</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><!DOCTYPE html>
<html lang="en">
<head>
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
  </style>
</head>
<body>
<form action="logout.php" method="post">
  <div class="logout-btn">  <button  type="submit" name="logout" class="btn btn-danger">Logout</button>
  </div>
    </form> 
  <br><br>
  <div class="container">
  <div class="bs-example">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Formulaire de Stock</h2>
                    </div>
                    <?php
                    include_once 'dbconnection.php';
                    $result = mysqli_query($conn, "SELECT form_id,fournisseur_nom, RIB, montant FROM formulaire_stock");

                    ?>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                      <table class='table table-bordered table-striped'>
                      
                      <tr>
                        <td>ID fournisseur</td>
                        <td>Nom de fournisseur</td>
                        <td>RIB</td>
                        <td>montant</td>

                      </tr>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["form_id"]; ?></td>
                        <td><?php echo $row["fournisseur_nom"]; ?></td>
                        <td><?php echo $row["RIB"]; ?></td>
                        <td><?php echo $row["montant"]; ?></td>

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
    <br><br>
    <h2 class="pull-left">Facturation</h2>

    <form method="POST" action="insertfacturefournisseur.php" >  
    <div class="form-group">
        <label for="total">Formulaire ID:</label>
        <input type="number" id="form_id" name="form_id" placeholder="Enter fournisseur form ID" required>
      </div>
      <div class="form-group">
        <label for="rib">RIB de Fournisseur:</label>
        <input type="text" id="rib" name="rib" placeholder="Enter recipient's RIB" required>
      </div>
      <div class="form-group">
        <label for="date">Date Actuel:</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="total">Totale (DH):</label>
        <input type="number" id="total" name="total" placeholder="Enter total amount" required>
      </div>
      <br>
      <button type="submit" class="btn  btn-lg  " data-bs-toggle="hover"  style=" background-color: #007bff;color: antiquewhite; display: block; margin: 0 auto; margin-bottom: 2rem;" data-bs-toggle="hover">
            Enregistrer
          </button><br><br>
    </form><br>
    <h2>Formulaire de Paimenet</h2>
    <form action="process_payement_fournisseur.php" method="post">
  <div class="form-group">
    <label for="receiverName">Nom de Fournisseur:</label>
    <input type="text" id="receiverName" name="receiverName" required>
  </div>
  <div class="form-group">
    <label for="receiverRIB"> RIBde Fournisseur:</label>
    <input type="text" id="receiverRIB" name="receiverRIB" required>
  </div>
  <div class="form-group">
    <label for="total">Totale (DH):</label>
    <input type="number" id="totalpay" name="totalpay" required>
  </div>
  <div class="form-group">
    <label for="date">Date de Paiment:</label>
    <input type="date" id="datepay" name="datepay" required>
  </div>
  <br>
  <label for="companyRIB">RIB de l'entreprise:</label>
  <span>
    <?php echo $companyRIB['bankCode'] . ' ' . $companyRIB['branchCode'] . ' ' . $companyRIB['accountNumber'] . ' ' . $companyRIB['RIBKey']; ?>
  </span>
  <br><br>
  <div class="button-container">

    <button type="submit" class="btn  btn-lg  " data-bs-toggle="hover" style="background-color: #007bff;color: antiquewhite; " data-bs-toggle="hover" >Envoyer Paimenet</button>
  </div></form>
  </div>
  <br><br>
<script>
 function validateForm() {
  const receiverName = document.getElementById('receiverName');
  const receiverRIB = document.getElementById('receiverRIB');
  const total = document.getElementById('totalpay');
  const date = document.getElementById('datepay');

  // Check receiver name (assuming it should be text)
  if (receiverName.value === '') {
    alert('Please enter a receiver name.');
    return false;
  }

  // Check receiver RIB (assuming it should be an integer)
  if (receiverRIB.value === '' || isNaN(parseInt(receiverRIB.value))) {
    alert('Please enter a valid receiver RIB (numbers only).');
    return false;
  }
  if (totalpay.value === '' || isNaN(parseFloat(totalpay.value))) {
    alert('Please enter a valid total amount (numbers only).');
    return false;
  }

  // Check date (assuming it's handled by a date picker or accepts a valid format)
  if (datepay.value === '') {
    alert('Please enter a payment date.');
    return false;
  }

  

  // Check date (assuming it's handled by a date picker or accepts a valid format)
 

  // Assuming the date input uses a date picker or accepts a valid date format, we don't need additional validation for date type here in most cases.

  return true;  // Allow form submission if all validations pass
}

</script>
</body>
</html>
