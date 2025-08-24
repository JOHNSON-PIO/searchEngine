<?php
include 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = "SELECT g.*, a.username AS uploaded_by FROM gallery g JOIN admin a ON g.uploadedBy = a.adminID WHERE g.imageID = $id";
$result = $mysqli->query($query);
$image = $result ? $result->fetch_assoc() : null;

if (!$image) {
    die("Image not found.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Image Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Image Details</h1>
    <a href="search.php?keyword=<?php echo urlencode($_GET['keyword'] ?? ''); ?>">Back to Results</a>
    <div class="image-details">
        <img src="images/uploads/<?php echo htmlspecialchars($image['imagePath']); ?>"
            alt="<?php echo htmlspecialchars($image['caption']); ?>" width="500">
        <p><strong>Caption:</strong> <?php echo htmlspecialchars($image['caption']); ?></p>
        <p><strong>Uploaded On:</strong> <?php echo htmlspecialchars($image['timeUploaded']); ?></p>
        <p><strong>Uploaded By:</strong> <?php echo htmlspecialchars($image['uploaded_by']); ?></p>
    </div>
</body>

</html>
<?php
if ($result) {
    $result->free();
}
?>