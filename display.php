<?php
$conn = new mysqli("localhost", "root", "", "user_data");

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<center><h2>Registered Users</h2>";
echo "<table border='1' style='width:80%; text-align:center;'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Age</th>
<th>Gender</th>
<th>Hobbies</th>
<th>Country</th>
<th>Bio</th>
<th>Profile Picture</th>
<th>Actions</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>" . $row['id'] . "</td>
    <td>" . $row['name'] . "</td>
    <td>" . $row['email'] . "</td>
    <td>" . $row['age'] . "</td>
    <td>" . $row['gender'] . "</td>
    <td>" . $row['hobbies'] . "</td>
    <td>" . $row['country'] . "</td>
    <td>" . $row['bio'] . "</td>
    <td><img src='" . $row['profile_picture'] . "' width='50'></td>
    <td><a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>
    </tr>";
}
echo "</table></center>";
?>