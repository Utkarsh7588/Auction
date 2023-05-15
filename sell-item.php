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

// Check if the sold_items table exists
$soldItemsTableName = "sold_items";
$checkSoldItemsTableQuery = "SHOW TABLES LIKE '".$soldItemsTableName."'";
$result = $conn->query($checkSoldItemsTableQuery);

if ($result->num_rows == 0) {
    // Table does not exist, create it
    $createSoldItemsTableQuery = "CREATE TABLE ".$soldItemsTableName." (
        itemId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userId INT(6) NOT NULL,
        imagePath VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        history TEXT NOT NULL,
        quality VARCHAR(50) NOT NULL,
        highest_bid DECIMAL(10, 2) DEFAULT 0.00
    )";

    if ($conn->query($createSoldItemsTableQuery) === true) {
        echo "Table 'sold_items' created successfully.";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

if (isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];

    // Retrieve the item details from the items table
    $retrieveQuery = "SELECT * FROM items WHERE itemId = $itemId";
    $result = $conn->query($retrieveQuery);

    if ($result->num_rows > 0) {
        // Item found, move it to the sold_items table

        // Get the item details
        $item = $result->fetch_assoc();
        $userId = $item['userId'];
        $image = $item['imagePath'];
        $description = $item['description'];
        $history = $item['history'];
        $quality = $item['quality'];
        $highestBid = $item['highest_bid'];

        if ($highestBid > 0) {
            // Prepare and bind the insert statement for sold_items table
            $insertQuery = "INSERT INTO sold_items (itemId, userId, imagePath, description, history, quality, highest_bid) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("iissssd", $itemId, $userId, $image, $description, $history, $quality, $highestBid);

            // Execute the prepared statement
            if ($stmt->execute() === true) {
                // Item successfully sold, remove it from the items table

                // Prepare and bind the delete statement for items table
                $deleteQuery = "DELETE FROM items WHERE itemId = ?";
                $stmt = $conn->prepare($deleteQuery);
                $stmt->bind_param("i", $itemId);

                // Execute the prepared statement
                if ($stmt->execute() === true) {
                    echo "<script>window.location.href='my-bids.php';alert('Item Sold'); </script>";
                } else {
                    echo "Error deleting item: " . $conn->error;
                }
            } else {
                echo "Error selling item: " . $conn->error;
            }
        } else {
            
            echo "<script>window.location.href='my-bids.php';alert('Cannot sell the item at a price of 0'); </script>";
        }
    } else {
        
        echo "<script>window.location.href='my-bids.php';alert('Item not found.); </script>";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
