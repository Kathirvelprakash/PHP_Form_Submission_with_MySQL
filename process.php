<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age = intval($_POST['age']);
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : "";
    $country = $_POST['country'];
    $bio = trim($_POST['bio']);
    
    // Handle file upload
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir);

    $profile_picture = "";
    if (!empty($_FILES["profile_picture"]["name"])) {
        $profile_picture = $target_dir . time() . "_" . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_picture);
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, age, gender, hobbies, country, bio, profile_picture) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisssss", $name, $email, $password, $age, $gender, $hobbies, $country, $bio, $profile_picture);
    
    if ($stmt->execute()) {
        echo "<p class='message'>Registration successful! <a href='display.php'>View Records</a></p>";
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>