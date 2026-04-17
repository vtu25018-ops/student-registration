<?php
include '../connect.php';

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
</head>
<body>

<h2>Students List</h2>

<table border="1">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>DOB</th>
    <th>Department</th>
    <th>Phone</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['dob']}</td>
            <td>{$row['department']}</td>
            <td>{$row['phone']}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No data found</td></tr>";
}
?>

</table>

</body>
</html>
