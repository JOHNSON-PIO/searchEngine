<?php
$host = 'localhost';
$dbname = 'gallery';
$username = 'root'; // Adjust if needed
$password = ''; // Adjust if needed

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>