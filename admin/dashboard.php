<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>Admin Dashboard</h1>
    <a href="upload.php">Upload Image</a> | <a href="logout.php">Logout</a>
</body>

</html>