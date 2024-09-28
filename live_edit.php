<?php
include_once("dbconnection.php");
$input = filter_input_array(INPUT_POST);

if ($input['action'] == 'edit') {
  $update_field = "";

  // Validate if project_nom (project name) is present in the input
  if (isset($input['projet_nom'])) {
    die("Error: Project name modification is not allowed.");
  }

  // Check for other fields
  if (isset($input['status'])) {
    $update_field .= "status='" . $input['status'] . "'";
  }

  if (isset($input['date_debut'])) {
    // Add a comma if $update_field already contains a value
    if ($update_field !== "") {
      $update_field .= ", ";
    }
    $update_field .= "date_debut='" . $input['date_debut'] . "'";
  }

  if (isset($input['date_fin'])) {
    // Add a comma if $update_field already contains a value
    if ($update_field !== "") {
      $update_field .= ", ";
    }
    $update_field .= "date_fin='" . $input['date_fin'] . "'";
  }

  // If valid update fields exist, proceed with update query
  if ($update_field && $input['projet_id']) {
    $sql_query = "UPDATE projet SET $update_field WHERE projet_id='" . $input['projet_id'] . "'";
    mysqli_query($conn, $sql_query) or die("database error:" . mysqli_error($conn));
  }
}
?>
