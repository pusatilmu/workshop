<?php
include('../config/database.php');

// Handle employee deletion
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM employees WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to employee list after deletion
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
