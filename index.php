<?php
// Initialize variables
$name = $email = $age = $gender = $country = $bio = "";
$hobbies = [];
$nameErr = $emailErr = $passwordErr = $ageErr = $genderErr = $hobbiesErr = $countryErr = $fileErr = "";

// Retain values after form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("process.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
            padding: 5px;
        }
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Registration</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required></td>
            </tr>
            <tr><td colspan="2"><span class="error"><?= $nameErr ?></span></td></tr>

            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required></td>
            </tr>
            <tr><td colspan="2"><span class="error"><?= $emailErr ?></span></td></tr>

            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr><td colspan="2"><span class="error"><?= $passwordErr ?></span></td></tr>

            <tr>
                <td>Age:</td>
                <td><input type="number" name="age" value="<?= htmlspecialchars($age) ?>" required min="1"></td>
            </tr>
            <tr><td colspan="2"><span class="error"><?= $ageErr ?></span></td></tr>

            <tr>
                <td>Gender:</td>
                <td>
                    <input type="radio" name="gender" value="Male" <?= ($gender == "Male") ? "checked" : "" ?>> Male
                    <input type="radio" name="gender" value="Female" <?= ($gender == "Female") ? "checked" : "" ?>> Female
                    <input type="radio" name="gender" value="Other" <?= ($gender == "Other") ? "checked" : "" ?>> Other
                </td>
            </tr>
            <tr><td colspan="2"><span class="error"><?= $genderErr ?></span></td></tr>

            <tr>
                <td>Hobbies:</td>
                <td>
                    <?php
                    // Fix: Convert stored hobbies string into an array safely
                    $hobbies = isset($row["hobbies"]) ? $row["hobbies"] : "";
                    $selected_hobbies = is_string($hobbies) ? explode(", ", $hobbies) : [];
                    ?>
                    <input type="checkbox" name="hobbies[]" value="Reading" <?php echo in_array("Reading", $selected_hobbies) ? "checked" : ""; ?>> Reading
                    <input type="checkbox" name="hobbies[]" value="Music" <?php echo in_array("Music", $selected_hobbies) ? "checked" : ""; ?>> Music
                    <input type="checkbox" name="hobbies[]" value="Sports" <?php echo in_array("Sports", $selected_hobbies) ? "checked" : ""; ?>> Sports
                </td>
            </tr>
            <tr><td colspan="2"><span class="error"><?= $hobbiesErr ?></span></td></tr>

            <tr>
                <td>Country:</td>
                <td>
                    <select name="country" required>
                        <option value="India" <?= ($country == "India") ? "selected" : "" ?>>India</option>
                        <option value="USA" <?= ($country == "USA") ? "selected" : "" ?>>USA</option>
                        <option value="UK" <?= ($country == "UK") ? "selected" : "" ?>>UK</option>
                    </select>
                </td>
            </tr>
            <tr><td colspan="2"><span class="error"><?= $countryErr ?></span></td></tr>

            <tr>
                <td>Bio:</td>
                <td><textarea name="bio"><?= htmlspecialchars($bio) ?></textarea></td>
            </tr>

            <tr>
                <td>Profile Picture:</td>
                <td><input type="file" name="profile_picture" accept="image/*" required></td>
            </tr>
            <tr><td colspan="2"><span class="error"><?= $fileErr ?></span></td></tr>

            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Register"></td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>