<?php
session_start();
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auction";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the table exists
$tableName = "user_data";
$checkTableQuery = "SHOW TABLES LIKE '".$tableName."'";
$result = $conn->query($checkTableQuery);

if ($result->num_rows == 0) {
    // Table does not exist, create it
    $createTableQuery = "CREATE TABLE ".$tableName." (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userID VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        name VARCHAR(100) NOT NULL,
        address VARCHAR(100) NOT NULL,
        country VARCHAR(50) NOT NULL,
        zipcode VARCHAR(10) NOT NULL,
        email VARCHAR(100) NOT NULL,
        gender VARCHAR(10) NOT NULL
    )";

    if ($conn->query($createTableQuery) === true) {
        echo "Table created successfully.";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

// Retrieve form data with trim
$userID = trim($_POST['userID']);
$password = trim($_POST['password']);
$name = trim($_POST['name']);
$address = trim($_POST['address']);
$country = trim($_POST['country']);
$zipcode = trim($_POST['zipcode']);
$email = trim($_POST['email']);
$sex = trim($_POST['gender']);


// Prepare and bind the insert statement
$insertQuery = "INSERT INTO $tableName (userID, password, name, address, country, zipcode, email, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("ssssssss", $userID, $password, $name, $address, $country, $zipcode, $email, $sex);

// Execute the prepared statement
if ($stmt->execute() === true) {
    // Data stored successfully, redirect to signup page
    header("Location: sign-in.html?alert=success");
    exit();
} else {
    // Error storing data, redirect back to index.php
    echo "<script>window.location.href='sign-up.html';alert('Error storing data'); </script>";
    exit();
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();
?>
