<?php
include 'includes.php';

// Read customer ID from URL and force it to an integer.
$id = intval($_GET['id'] ?? 0);

// Delete the matching customer row from the database.
$conn->query("DELETE FROM klanten WHERE id={$id}");

// Redirect to prevent repeated deletes on page refresh.
header("Location: index.php");
exit();
?>