<?php
$conn = new mysqli("localhost", "root", "", "user_data");

$id = $_GET["id"];

// Get the profile picture path
$result = $conn->query("SELECT profile_picture FROM users WHERE id=$id");
$row = $result->fetch_assoc();
unlink($row['profile_picture']); // Delete file

// Delete from database
$conn->query("DELETE FROM users WHERE id=$id");

header("Location: display.php");
?>