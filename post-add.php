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

// Check if the table exists
$tableName = "items";
$checkTableQuery = "SHOW TABLES LIKE '".$tableName."'";
$result = $conn->query($checkTableQuery);

if ($result->num_rows == 0) {
    // Table does not exist, create it
    $createTableQuery = "CREATE TABLE ".$tableName." (
        itemId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userId VARCHAR(25) NOT NULL,
        imagePath VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        history TEXT NOT NULL,
        quality VARCHAR(50) NOT NULL,
        highest_bid DECIMAL(10, 2) DEFAULT 0.00
    )";

    if ($conn->query($createTableQuery) === true) {
        echo "Table created successfully.";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

// Retrieve form data
$userId = $_SESSION['userId'];
$imagePath = "uploads/".basename($_FILES['image']['name']);
$description = $_POST['description'];
$history = $_POST['history'];
$quality = $_POST['quality'];

// Move the uploaded image to a directory
$targetDirectory = "uploads/";
$targetFile = $targetDirectory . basename($_FILES['image']['name']);

// Check if the target directory exists, create it if not
if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0755, true);
}

if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
    // Image moved successfully, proceed with database insertion
    // Prepare and bind the insert statement
    $insertQuery = "INSERT INTO ".$tableName." (userId, imagePath, description, history, quality) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssss", $userId, $imagePath, $description, $history, $quality);

    // Execute the prepared statement
    if ($stmt->execute() === true) {
        // Data stored successfully
        header("Location: home.php?alert=success");
    } else {
        // Error storing data
        echo "<script>window.location.href='post-add.html';alert('Error posting advertisement'); </script>";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Failed to move the image
    echo "Error moving the uploaded image.";
}

// Close the database connection
$conn->close();
?>
