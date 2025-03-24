<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : "";
    $country = $_POST['country'];
    $bio = $_POST['bio'];

    // Handle File Upload
    $target_dir = "uploads/";
    $profile_picture = "";
    if (!empty($_FILES["profile_picture"]["name"])) {
        $profile_picture = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_picture);
    }

    // Insert data into database
    $sql = "INSERT INTO users (name, email, password, age, gender, hobbies, country, bio, profile_picture)
            VALUES ('$name', '$email', '$password', '$age', '$gender', '$hobbies', '$country', '$bio', '$profile_picture')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully. <a href='display.php'>View Records</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
