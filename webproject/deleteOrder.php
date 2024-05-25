<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "ifood";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $orderId = $_POST["orderId"];

    $deleteOrderItemsStmt = $conn->prepare("DELETE FROM orderitems WHERE OrderNumber = ?");
    $deleteOrderItemsStmt->bind_param("i", $orderId);

    if ($deleteOrderItemsStmt->execute()) {
        $deleteOrderStmt = $conn->prepare("DELETE FROM orders WHERE serialo = ?");
        $deleteOrderStmt->bind_param("i", $orderId);

        if ($deleteOrderStmt->execute()) {
            echo "success";
        } else {
            echo "error: " . $deleteOrderStmt->error;
        }

        $deleteOrderStmt->close();
    } else {
        echo "error: " . $deleteOrderItemsStmt->error;
    }

    $deleteOrderItemsStmt->close();
    $conn->close();
}
?>