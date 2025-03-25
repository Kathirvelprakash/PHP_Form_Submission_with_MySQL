<?php
$conn = new mysqli("localhost", "root", "", "user_data");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        die("User not found!");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $hobbies = isset($_POST["hobbies"]) ? implode(", ", $_POST["hobbies"]) : "";
    $country = $_POST["country"];
    $bio = $_POST["bio"];
    $old_picture = $_POST["old_picture"];

    // Handle file upload if new picture is provided
    if (!empty($_FILES["profile_picture"]["name"])) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES["profile_picture"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Delete old file
            if (file_exists($old_picture)) {
                unlink($old_picture);
            }
        } else {
            die("Error uploading file.");
        }
    } else {
        $target_file = $old_picture; // Keep old profile picture
    }

    // Update query
    $sql = "UPDATE users SET 
            name='$name', email='$email', age='$age', gender='$gender', hobbies='$hobbies',
            country='$country', bio='$bio', profile_picture='$target_file' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: display.php"); // Redirect to display page
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #aaa;
            width: 400px;
            text-align: center;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit User</h2>

    <form action="edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <input type="hidden" name="old_picture" value="<?= $row['profile_picture']; ?>">

        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?= $row['name']; ?>" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" value="<?= $row['email']; ?>" required></td>
            </tr>
            <tr>
                <td>Age:</td>
                <td><input type="number" name="age" value="<?= $row['age']; ?>" required min="1"></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <input type="radio" name="gender" value="Male" <?= ($row['gender'] == 'Male') ? 'checked' : ''; ?>> Male
                    <input type="radio" name="gender" value="Female" <?= ($row['gender'] == 'Female') ? 'checked' : ''; ?>> Female
                    <input type="radio" name="gender" value="Other" <?= ($row['gender'] == 'Other') ? 'checked' : ''; ?>> Other
                </td>
            </tr>
            <tr>
                <td>Hobbies:</td>
                <td>
                    <?php $hobbiesArray = explode(", ", $row['hobbies']); ?>
                    <input type="checkbox" name="hobbies[]" value="Reading" <?= in_array("Reading", $hobbiesArray) ? 'checked' : ''; ?>> Reading
                    <input type="checkbox" name="hobbies[]" value="Music" <?= in_array("Music", $hobbiesArray) ? 'checked' : ''; ?>> Music
                    <input type="checkbox" name="hobbies[]" value="Sports" <?= in_array("Sports", $hobbiesArray) ? 'checked' : ''; ?>> Sports
                </td>
            </tr>
            <tr>
                <td>Country:</td>
                <td>
                    <select name="country" required>
                        <option value="India" <?= ($row['country'] == 'India') ? 'selected' : ''; ?>>India</option>
                        <option value="USA" <?= ($row['country'] == 'USA') ? 'selected' : ''; ?>>USA</option>
                        <option value="UK" <?= ($row['country'] == 'UK') ? 'selected' : ''; ?>>UK</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Bio:</td>
                <td><textarea name="bio"><?= $row['bio']; ?></textarea></td>
            </tr>
            <tr>
                <td>Profile Picture:</td>
                <td>
                    <img src="<?= $row['profile_picture']; ?>" width="50"><br>
                    <input type="file" name="profile_picture" accept="image/*">
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>