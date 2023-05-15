<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auction";

// Establish database connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the submitted user ID and password
$userId = trim($_POST['userId']);
$password = trim($_POST['password']);

// Perform any necessary sanitization and validation on the input

// Prepare a SQL statement to check the user credentials
$query = "SELECT * FROM user_data WHERE userId = '$userId' AND password = '$password'";
$result = mysqli_query($connection, $query);

// Check if a row is returned from the query
if (mysqli_num_rows($result) == 1) {
    // Authentication successful
    $_SESSION['userId'] = $userId;
    header("Location: home.php");
} else {
    // Authentication failed
    
    echo "<script>window.location.href='sign-in.html';alert('Wrong credentials!'); </script>";
    
}

// Remember to close the database connection
mysqli_close($connection);
?>
