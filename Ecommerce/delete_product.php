<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "ecommerce";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM cart WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $param_id);

        $param_id = $product_id;

        if ($stmt->execute()) {
            header("location: homepage.php");
            exit();
        }
        $stmt->close();
    }

    $conn->close();
} 
?>
