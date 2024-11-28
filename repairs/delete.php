<?php
include('../config/database.php');

// Handle deletion of the repair record
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM repairs WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful deletion
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
