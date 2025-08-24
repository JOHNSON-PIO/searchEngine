<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Woogle Search Engine</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Woogle Image Search</h1>
    <form action="search.php" method="GET">
        <input type="text" name="keyword" placeholder="Enter keyword" required>
        <button type="submit">Search</button>
    </form>
</body>

</html>