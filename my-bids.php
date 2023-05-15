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
        userId VARCHAR(25) NOT NULL,
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

// Retrieve the user's bidding advertisements
$userId = $_SESSION['userId'];
$biddingRetrieveQuery = "SELECT * FROM items WHERE userId = '$userId'";
$biddingResult = $conn->query($biddingRetrieveQuery);

// Retrieve the user's sold items
$soldRetrieveQuery = "SELECT * FROM sold_items WHERE userId = '$userId'";
$soldResult = $conn->query($soldRetrieveQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Bidding Advertisements</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
             <li><a href="home.php">Home</a></li>
                <li><a href="post-add.html">Post Advertisement</a></li>
                <li><a href="my-bids.php">Your Advertisements</a></li>
                <li><a href="index.php">Logout</a></li>
        </ul>
    </nav>

    <main>
        <section>
            
            <h2>Your Bidding Advertisements</h2>
            <?php
            
            if ($biddingResult->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Item ID</th><th>Image</th><th>Description</th><th>History</th><th>Quality</th><th>Highest Bid</th><th>Sell Item</th></tr>";

                while ($row = $biddingResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['itemId'] . "</td>";
                    echo "<td><img src='" . $row['imagePath'] . "' alt='Item Image' style='width: 100px; height: 100px;'></td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['history'] . "</td>";
                    echo "<td>" . $row['quality'] . "</td>";
                    echo "<td>" . $row['highest_bid'] . "</td>";
                    echo "<td><button onclick=\"sellItem(" .$row['itemId']. ")\">Sell Item</button></td>";

echo "</tr>";
}
echo "</table>";
} else {
echo "<p>No bidding advertisements found.</p>";
}
?>
</section>
<section>
        <h2>Your Sold Items</h2>
        <?php
        if ($soldResult->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Item ID</th><th>Image</th><th>Description</th><th>History</th><th>Quality</th><th>Highest Bid</th></tr>";

            while ($row = $soldResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['itemId'] . "</td>";
                echo "<td><img src='" . $row['imagePath'] . "' alt='Item Image' style='width: 100px; height: 100px;'></td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['history'] . "</td>";
                echo "<td>" . $row['quality'] . "</td>";
                echo "<td>" . $row['highest_bid'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No sold items found.</p>";
        }
        ?>
    </section>
</main>

<script>
    function sellItem(itemId) {
        // Confirm with the user before selling the item
        if (confirm("Are you sure you want to sell this item?")) {
            // Redirect to the sell-item.php page with the item ID
            window.location.href = "sell-item.php?itemId=" + itemId;
        }
    }
</script>

