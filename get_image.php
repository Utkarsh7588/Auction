<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auction";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the itemId from the query parameter
$itemId = $_GET['itemId'];

// Retrieve the image data from the database
$query = "SELECT image FROM items WHERE itemId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $itemId);
$stmt->execute();
$stmt->bind_result($imageData);
$stmt->fetch();
$stmt->close();

// Set the appropriate content headers
header("Content-Type: image/jpeg");
header("Content-Length: " . strlen($imageData));

// Output the image data
echo $imageData;

// Close the database connection
$conn->close();
?>
