<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Items List</title>
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
        <h2>Items List</h2>
        <table>
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Quality</th>
                    <th>Highest Bid</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
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

                // Fetch items from the items table
                $query = "SELECT * FROM items";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['itemId'] . "</td>";
                        echo "<td><img src='" . $row['imagePath'] . "' alt='Item Image' style='width: 100px; height: 100px;'></td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['quality'] . "</td>";
                        echo "<td>" . $row['highest_bid'] . "</td>";
                        echo "<td><button onclick='goToItem(" . $row['itemId'] . ")'>View Details</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No items found.</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2023 Auction Site</p>
    </footer>

    <script>
        function goToItem(itemId) {
            // Redirect to the item details page
            window.location.href = "item-details.php?itemId=" + itemId;
        }
    </script>
</body>
</html>
