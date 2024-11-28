<?php
include('../config/database.php');

// Handle payment deletion
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM payments WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect back to payments list after deletion
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
