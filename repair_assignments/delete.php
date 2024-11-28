<?php
include('../config/database.php');

// Handle repair assignment deletion
if (isset($_GET['repair_id'])) {
  $repair_id = $_GET['repair_id'];

  $sql = "DELETE FROM repair_assignments WHERE repair_id = $repair_id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful deletion
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
