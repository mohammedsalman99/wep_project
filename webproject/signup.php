<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["usernamee"];
    $password = $_POST["passwordd"];
    $fullName = $_POST["fullName"];
    $phoneNumber = $_POST["phoneNumber"];
    $userLevel = 1;


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "ifood";

    $conn = new mysqli($servername, $username_db, $password_db, $database);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $checkStmt = $conn->prepare("SELECT UserName FROM users WHERE UserName = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {

        echo "Error: Username is already in use. Please choose a different username.";
    } else {

        $insertStmt = $conn->prepare("INSERT INTO users (UserName, Password, FullName, PhoneNumber, UserLevel) VALUES (?, ?, ?, ?, ?)");
        $insertStmt->bind_param("ssssi", $username, $hashedPassword, $fullName, $phoneNumber, $userLevel);

        if ($insertStmt->execute()) {
            echo "<script>
            alert('User registered successfully');
            window.location.href = 'index.html';
            
            </script>";
        } else {
            echo "Error: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>