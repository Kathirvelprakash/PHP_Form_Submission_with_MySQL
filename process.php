<?php
$conn = new mysqli("localhost", "root", "", "user_data");

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $age = $_POST["age"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $hobbies = isset($_POST["hobbies"]) ? implode(", ", $_POST["hobbies"]) : "";
    $country = $_POST["country"];
    $bio = trim($_POST["bio"]);

    // File Upload Handling
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create folder if not exists
    }

    $file_name = basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];

    if (!empty($file_name) && in_array($fileType, $allowedTypes)) {
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
    } else {
        $target_file = ""; // No file uploaded
    }

    // Insert Data into Database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, age, gender, hobbies, country, bio, profile_picture) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("sssssssss", $name, $email, $password_hashed, $age, $gender, $hobbies, $country, $bio, $target_file);

    if ($stmt->execute()) {
        // Redirect to a separate success page
        header("Location: success.php");
        exit();
    } else {
        echo "Error: Could not register user.";
    }
    $stmt->close();
}
?>
