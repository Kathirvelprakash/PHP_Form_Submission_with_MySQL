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
            padding: 10px;
        }
        .message {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>User Registration</h2>

    <form action="process.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>Age:</td>
                <td><input type="number" name="age" required></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <input type="radio" name="gender" value="Male" required> Male
                    <input type="radio" name="gender" value="Female"> Female
                    <input type="radio" name="gender" value="Other"> Other
                </td>
            </tr>
            <tr>
                <td>Hobbies:</td>
                <td>
                    <input type="checkbox" name="hobbies[]" value="Reading"> Reading
                    <input type="checkbox" name="hobbies[]" value="Music"> Music
                    <input type="checkbox" name="hobbies[]" value="Sports"> Sports
                </td>
            </tr>
            <tr>
                <td>Country:</td>
                <td>
                    <select name="country" required>
                        <option value="India">India</option>
                        <option value="USA">USA</option>
                        <option value="UK">UK</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Bio:</td>
                <td><textarea name="bio"></textarea></td>
            </tr>
            <tr>
                <td>Profile Picture:</td>
                <td><input type="file" name="profile_picture" accept="image/*" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Register"></td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>