<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caption = $mysqli->real_escape_string(trim($_POST['caption']));
    $file = $_FILES['image'];

    if ($file['error'] === UPLOAD_ERR_OK && !empty($caption)) {
        $uploadDir = '../images/uploads/';
        $fileName = uniqid() . '.jpg'; // Assuming JPG as per SQL dump
        $uploadPath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $admin_id = (int)$_SESSION['admin_id'];
            $query = "INSERT INTO gallery (caption, imagePath, uploadedBy, timeUploaded) VALUES ('$caption', '$fileName', $admin_id, NOW())";
            if ($mysqli->query($query)) {
                $message = "<p style='color: green;'>Image uploaded successfully!</p>";
            } else {
                $message = "<p style='color: red;'>Failed to save image data.</p>";
            }
        } else {
            $message = "<p style='color: red;'>Failed to upload image.</p>";
        }
    } else {
        $message = "<p style='color: red;'>Please provide a caption and select an image.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Image</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>Upload Image</h1>
    <a href="dashboard.php">Back to Dashboard</a>
    <?php echo $message; ?>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="caption" placeholder="Image Caption" required>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
</body>

</html>