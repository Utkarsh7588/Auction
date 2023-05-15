<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="home.php">Home</a></li>
                <li><a href="post-add.html">Post Advertisement</a></li>
                <li><a href="my-bids.php">Your Advertisements</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Item Details</h2>
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

        // Check if the itemId parameter is set in the URL
        if (isset($_GET['itemId'])) {
            $itemId = $_GET['itemId'];

            // Fetch the item details from the database
            $query = "SELECT * FROM items WHERE itemId = $itemId";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo "<h3>Item ID: " . $row['itemId'] . "</h3>";
                echo "<img src='" . $row['imagePath'] . "' alt='Item Image' style='width: 200px; height: 200px;'>";
                echo "<p>Description: " . $row['description'] . "</p>";
                echo "<p>Quality: " . $row['quality'] . "</p>";
                echo "<p>Highest Bid: $" . $row['highest_bid'] . "</p>";

                // Display the bid form
                echo "<h4>Place a Bid</h4>";
                echo "<form action='place-bid.php' method='POST'>";
                echo "<input type='hidden' name='itemId' value='" . $row['itemId'] . "'>";
                echo "<label for='bidAmount'>Bid Amount:</label>";
                echo "<input type='number' id='bidAmount' name='bidAmount' step='0.01' required>";
                echo "<input type='submit' value='Place Bid'>";
                echo "</form>";
            } else {
                echo "<p>No item found with the provided ID.</p>";
            }
        } else {
            echo "<p>Invalid item ID.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </main>
    <footer>
        <p>&copy; 2023 Auction Site</p>
    </footer>
</body>
</html>
