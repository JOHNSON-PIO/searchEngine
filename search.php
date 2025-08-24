<?php
include 'config.php';

$keyword = isset($_GET['keyword']) ? $mysqli->real_escape_string(trim($_GET['keyword'])) : '';
$images = [];

if ($keyword) {
    $query = "SELECT * FROM gallery WHERE caption LIKE '%$keyword%'";
    $result = $mysqli->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
        $result->free();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Search Results for "<?php echo htmlspecialchars($keyword); ?>"</h1>
    <a href="index.php">Back to Search</a>
    <div class="gallery">
        <?php if (empty($images)): ?>
        <p>No images found.</p>
        <?php else: ?>
        <?php foreach ($images as $image): ?>
        <div class="image">
            <a href="view_image.php?id=<?php echo $image['imageID']; ?>&keyword=<?php echo urlencode($keyword); ?>">
                <img src="images/uploads/<?php echo htmlspecialchars($image['imagePath']); ?>"
                    alt="<?php echo htmlspecialchars($image['caption']); ?>" width="150">
            </a>
            <p><?php echo htmlspecialchars($image['caption']); ?></p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>