<?php
session_start(); // start session at the top
include '../connect.php'; // make sure connect.php points to the correct DB

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // we assume plain text password for now

    // Check user in database
    $sql = "SELECT customer_id, name, password FROM customers WHERE name='$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Simple password check (replace with password_hash if using hashed passwords)
        if ($password === $row['password']) {
            // Login success: set session
            $_SESSION['user_id'] = $row['customer_id'];
            $_SESSION['username'] = $row['name'];

            // Redirect to dashboard (adjust path)
            header("Location: ../task2_dashboard/dashboard.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>
</body>
</html>
