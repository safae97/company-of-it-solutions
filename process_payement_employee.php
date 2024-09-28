<?php
// Check if sending to all employees
$sendToAll = filter_input(INPUT_POST, 'sendToAll', FILTER_SANITIZE_STRING);

if ($sendToAll === 'true') {
  // Simulate processing payments to all employees (replace with actual logic)
  $success = true; // Assuming successful processing for all
} else {
  // Simulate processing failure (replace with actual logic)
  $success = false;
}

// Prepare messages based on success/failure (outside if/else)
$successMessage = "Payments sent successfully to all employees!";
$errorMessage = "There has been a problem!";

// Use JavaScript for redirection and potentially displaying alerts (optional)
?>

<script>
<?php if ($success) { ?>
  alert('<?php echo $successMessage; ?>');
  document.location.href = 'employee.php';
<?php } else { ?>
  alert('<?php echo $errorMessage; ?>');
  // Optionally display error message within the page (avoid using document.location here)
<?php } ?>
</script>

