<?php
$conn = new mysqli("localhost", "root", "", "user_data");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age = intval($_POST['age']);
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : "";
    $country = $_POST['country'];
    $bio = trim($_POST['bio']);

    // File Upload Handling
    $target_dir = "uploads/";
    $file_name = basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;
    
    move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, age, gender, hobbies, country, bio, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisssss", $name, $email, $password, $age, $gender, $hobbies, $country, $bio, $target_file);

    if ($stmt->execute()) {
        echo "<p class='message'>Registration successful! <a href='display.php'>View Users</a></p>";
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>