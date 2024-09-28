<?php
include_once("dbconnection.php");
$input = filter_input_array(INPUT_POST);

if ($input['action'] == 'edit') {
  $update_field = "";

    // Ensure that status modification is not allowed
    if (isset($input['status'])) {
        die("Error: status modification is not allowed.");
    }

    if (isset($input['date_debut'])) {
      $update_field .= "date_debut='" . $input['date_debut'] . "'";
    }
    if (isset($input['date_fin'])) {
        if ($update_field !== "") {
            $update_field .= ", ";
        }
        $update_field .= "date_fin='" . $input['date_fin'] . "'";
    }
    if (isset($input['projet_id'])) {
        if ($update_field !== "") {
            $update_field .= ", ";
        }
        $update_field .= "projet_id='" . $input['projet_id'] . "'";
    }
    if (isset($input['employee_id'])) {
        if ($update_field !== "") {
            $update_field .= ", ";
        }
        $update_field .= "employee_id='" . $input['employee_id'] . "'";
    }
    if (isset($input['titre_tache'])) {
        if ($update_field !== "") {
            $update_field .= ", ";
        }
        $update_field .= "titre_tache='" . $input['titre_tache'] . "'";
    }

    // If valid update fields exist, proceed with update query
    if ($update_field && $input['tache_id']) {
        $sql_query = "UPDATE tache SET $update_field WHERE tache_id='" . $input['tache_id'] . "'";
        mysqli_query($conn, $sql_query) or die("database error:" . mysqli_error($conn));
    }
}
?>
