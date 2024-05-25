<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Connect to the database
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "ifood";
    $customerName = $_POST["customerName"];
    $orderTotal = $_POST["orderTotal"];
    $items = $_POST["items"];
    $quantities = $_POST["quantities"];

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->query("SET GLOBAL FOREIGN_KEY_CHECKS=0");

    $orderStmt = $conn->prepare("INSERT INTO orders (CustomerName, Total) VALUES (?, ?)");
    $orderStmt->bind_param("sd", $customerName, $orderTotal);

    if ($orderStmt->execute()) {
        $orderId = $conn->insert_id;

        $itemsArray = explode(",", $items);
        $quantitiesArray = explode(",", $quantities);

        $itemStmt = $conn->prepare("INSERT INTO orderitems (Quantity, ItemName, OrderNumber) VALUES (?, ?, ?)");

        for ($i = 0; $i < count($itemsArray); $i++) {
            $itemStmt->bind_param("isi", $quantitiesArray[$i], $itemsArray[$i], $orderId);
            $itemStmt->execute();

            if ($itemStmt->errno) {
                echo "Error inserting order item: " . $itemStmt->error;
                break;
            }

            $decrementStmt = $conn->prepare("UPDATE items SET ItemQuantity = ItemQuantity - ? WHERE ItemName = ?");
            $decrementStmt->bind_param("is", $quantitiesArray[$i], $itemsArray[$i]);
            $decrementStmt->execute();


            $selectQuantityStmt = $conn->prepare("SELECT ItemQuantity FROM items WHERE ItemName = ?");
            $selectQuantityStmt->bind_param("s", $itemsArray[$i]);
            $selectQuantityStmt->execute();
            $selectQuantityStmt->bind_result($itemQuantity);
            $selectQuantityStmt->fetch();

            if ($itemQuantity == 0) {
                echo "<script> 
                    alert('Out of stock: " . $itemsArray[$i] . "');
                </script>";
            }

            $selectQuantityStmt->close();
        }

        echo "<script> 
          alert('Order placed successfully!');
          window.location.href = 'menu.html';
        </script>";
    } else {
        echo "Error: " . $orderStmt->error;
    }

    $decrementStmt->close();
    $itemStmt->close();
    $orderStmt->close();
    $conn->query("SET GLOBAL FOREIGN_KEY_CHECKS=1");
    $conn->close();
}
?>