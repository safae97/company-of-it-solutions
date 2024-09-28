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
  <title>Facturation Client</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <script>
    function validateForm() {
      const receiverName = document.getElementById('receiverName');
      const receiverRIB = document.getElementById('receiverRIB');
      const total = document.getElementById('total');
      const date = document.getElementById('date');
      const errorMessage = document.getElementById('errorMessage');
      errorMessage.textContent = ''; // Clear previous error message

      if (receiverName.value === '') {
        alert('Name field is empty');


      return false;
      }
      if (receiverRIB.value === '') {
        errorMessage.textContent = 'Please enter receiver RIB.';
        return false;
      }
      if (total.value === '') {
        errorMessage.textContent = 'Please enter total amount.';
        return false;
      }
      if (isNaN(total.value)) {
        errorMessage.textContent = 'Total amount must be a number.';
        return false;
      }
      if (date.value === '') {
        errorMessage.textContent = 'Please enter payment date.';
        return false;
      }

      
      return true; // Form is valid
    }

    function showSuccessMessage() {
      alert('<?php echo $successMessage; ?>');
    }
  </script>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facturation</title>
  <style>.container {
  width: 600px; /* Adjust width as needed */
  margin: 0 auto; /* Center the container horizontally */
  justify-content: center; /* Center buttons horizontally */

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
                        <h2 class="pull-left">Formulaire des clients</h2>
                    </div>
                    <?php
                    include_once 'dbconnection.php';
                    $result = mysqli_query($conn, "SELECT form_id,client_nom, RIB, montant FROM formulaire_client");

                    ?>

                    <?php
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                      <table class='table table-bordered table-striped'>
                      
                      <tr>
                        <td>Form's ID</td>
                        <td>Client's Name</td>
                        <td>RIB</td>
                        <td>montant</td>

                      </tr>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["form_id"]; ?></td>
                        <td><?php echo $row["client_nom"]; ?></td>
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
    <h2>Facturation </h2>
    <form method="POST" action="insertfactureclient.php" >  
    <div class="form-group">
        <label for="total">Formulaire ID:</label>
        <input type="number" id="form_id" name="form_id" placeholder="Enter client form ID" required>
      </div>
      <div class="form-group">
        <label for="rib">RIB de Client:</label>
        <input type="text" id="rib" name="rib" placeholder="Enter client's RIB" required>
      </div>
      <div class="form-group">
        <label for="name">Nom de Client:</label>
        <input type="text" id="name" name="name" placeholder="Enter client's name" required>
      </div>
      <div class="form-group">
        <label for="date">Date Actuel:</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="total">Totale(DH):</label>
        <input type="number" id="total" name="total" placeholder="Enter total amount of the purchase" required>
      </div>
      <br>
      <button type="submit" class="btn  btn-lg  " data-bs-toggle="hover"  style=" background-color: #007bff;color: antiquewhite; display: block; margin: 0 auto; margin-bottom: 2rem;" data-bs-toggle="hover">
            Enregistrer
          </button><br><br>
    </form><br>
    
  </div>
  <script>
  function validateForm() {
  const receiverName = document.getElementById('receiverName');
  const receiverRIB = document.getElementById('receiverRIB');
  const total = document.getElementById('total');
  const date = document.getElementById('date');

  // Check if receiver name is empty
  if (receiverName.value === '') {
    alert('Please enter the client name.');
    return false;
  }

  // Check if receiver RIB is empty or not a number
  if (receiverRIB.value === '' || isNaN(parseInt(receiverRIB.value))) { // Use parseInt for integer check
    alert('Please enter a valid client RIB (numbers only).');
    return false;
  }

  // Check if total is empty or not a number
  if (total.value === '' || isNaN(parseFloat(total.value))) { // Use parseFloat for decimal check
    alert('Please enter a valid total amount (numbers only).');
    return false;
  }

  // Check if date is empty
  if (date.value === '') {
    alert('Please enter a payment date.');
    return false;
  }


  return true;  // Allow form submission if all validations pass
}
</script>
</body>
</html>
