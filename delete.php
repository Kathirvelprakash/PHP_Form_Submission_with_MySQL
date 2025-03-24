<?php
$conn = new mysqli("localhost", "root", "", "user_data");

$id = $_GET['id'];

// Fetch profile picture path
$result = $conn->query("SELECT profile_picture FROM users WHERE id='$id'");
$row = $result->fetch_assoc();

if ($row && file_exists($row['profile_picture'])) {
    unlink($row['profile_picture']); // Delete file
}

$conn->query("DELETE FROM users WHERE id='$id'");
echo "Record deleted. <a href='display.php'>Go Back</a>";
?>