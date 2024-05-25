<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page</title>
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $username = $_POST["username"];
    $password = $_POST["password"];


    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "ifood";

    $conn = new mysqli($servername, $username_db,'', $database);



    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("SELECT UserName, Password, UserLevel FROM users WHERE UserName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();


    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbUsername, $dbPassword, $dbUserLevel);
        $stmt->fetch();





        if (password_verify(trim($password), $dbPassword)) {


            echo "<script>
            sessionStorage.setItem('level','$dbUserLevel')
            sessionStorage.setItem('name','$dbUsername');
            window.location.href = 'index.html';
            
            </script>";

            echo " <script src='gloobal.js'></script>;";

        } else {
            echo "<script>
            alert('invalid password or username');
            window.location.href = 'index.html';
            
            </script>";
        }
    } else {
        echo "<script>
            alert('invalid password or username');
            window.location.href = 'index.html';
            
            </script>";
    }



    $stmt->close();
    $conn->close();
}
?>

<script src="gloobal.js"></script>

<body>

</body>
</html>