<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "ifood";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT o.serialo, o.CustomerName, o.Total, u.FullName, u.PhoneNumber
                        FROM orders o
                        JOIN users u ON o.CustomerName = u.UserName");

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='order-item'>
                <p>Order ID: " . $row["serialo"] . "</p>
                <p>Customer Name: " . $row["FullName"] . "</p>
                <p>Phone Number: " . $row["PhoneNumber"] . "</p>
                <p>Total: $" . $row["Total"] . "</p>";

        $orderId = $row["serialo"];
        $itemsResult = $conn->query("SELECT * FROM orderitems WHERE OrderNumber = $orderId");

        if ($itemsResult->num_rows > 0) {
            // Move the "Items" heading inside the order-item container
            echo "<p class='itemss'>Items:</p><ul>";

            while ($itemRow = $itemsResult->fetch_assoc()) {
                echo "<li>" . $itemRow["ItemName"] . " (Quantity: " . $itemRow["Quantity"] . ")</li>";
            }

            echo "</ul>";
        } else {
            echo "<p>No items found for this order.</p>";
        }

        echo "<button class='delete-btn' data-orderid='" . $row["serialo"] . "'>Delete Order</button>
              </div>";
    }
} else {
    echo "No orders found.";
}

$conn->close();
?>