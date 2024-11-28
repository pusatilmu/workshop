<?php
include('../config/database.php');

// Handle customer deletion
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM customers WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after deletion
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
