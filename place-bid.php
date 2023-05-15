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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted bid amount and item ID
    $itemId = $_POST['itemId'];
    $bidAmount = $_POST['bidAmount'];

    // Validate the bid amount
    if (!is_numeric($bidAmount) || $bidAmount <= 0) {
        echo "<script>alert('Invalid amount'); window.location.href='item-details.php?itemId=".$itemId."';</script>";
            exit;
    }

    // Fetch the current highest bid for the item
    $query = "SELECT highest_bid FROM items WHERE itemId = $itemId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentHighestBid = $row['highest_bid'];

        // Check if the submitted bid amount is higher than the current highest bid
        if ($bidAmount > $currentHighestBid) {
            // Update the highest bid for the item in the database
            $updateQuery = "UPDATE items SET highest_bid = $bidAmount WHERE itemId = $itemId";
        
            if ($conn->query($updateQuery) === true) {
                // Redirect to item-details.php with the itemId
                echo "<script>alert('Bid successfully updated'); window.location.href='item-details.php?itemId=".$itemId."';</script>";
                exit;
            } else {
                // Redirect to item-details.php with the itemId and an alert message
                echo "<script>alert('Error updating highest bid'); window.location.href='item-details.php?itemId=".$itemId."';</script>";
                exit;
            }
        } else {
            // Redirect to item-details.php with the itemId and an alert message
            echo "<script>alert('Invalid amount'); window.location.href='item-details.php?itemId=".$itemId."';</script>";
            exit;
        }
        
        
        
    } else {
        echo "<script>alert('Invalid amount'); window.location.href='item-details.php?itemId=".$itemId."';</script>";
            exit;
    }
}

// Close the database connection
$conn->close();
?>

