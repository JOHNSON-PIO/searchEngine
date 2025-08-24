<?php
// Start session for admin authentication
session_start();
include '../config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize username input
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Query to find admin by username
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = $mysqli->query($query);
    $admin = $result ? $result->fetch_assoc() : null;

    // Check credentials (plain-text as per gallery.sql schema)
    if ($admin && $admin['password'] === $password) {
        $_SESSION['admin_id'] = $admin['adminID']; // Store admin ID in session
        header("Location: dashboard.php"); // Redirect to dashboard
        exit;
    } else {
        $error = "Invalid credentials.";
    }

    // For hashed passwords (recommended, requires ALTER TABLE admin MODIFY password VARCHAR(255))
    // if ($admin && password_verify($password, $admin['password'])) {
    //     $_SESSION['admin_id'] = $admin['adminID'];
    //     header("Location: dashboard.php");
    //     exit;
    // } else {
    //     $error = "Invalid credentials.";
    // }

    // Free the result set
    if ($result) {
        $result->free();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>Admin Login</h1>
    <!-- Display error message if login fails -->
    <?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <!-- Login form -->
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>

</html>