<?php
include('../config/database.php');

// Handle deletion of the repair item
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = "DELETE FROM repair_items WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful deletion
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
