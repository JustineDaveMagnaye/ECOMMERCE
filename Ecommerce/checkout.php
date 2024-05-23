<?php
session_start();

if (isset($_POST['checkout'])) {
    $user_id = $_SESSION['user_id'];

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "ecommerce";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT product_name, SUM(quantity) AS total_quantity FROM cart WHERE user_id = '$user_id' GROUP BY product_name";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $delete_sql = "DELETE FROM cart WHERE user_id = '$user_id'";
        if ($conn->query($delete_sql) === TRUE) {
        while ($row = $result->fetch_assoc()) {
            $product_name = $row['product_name'];
            $total_quantity = $row['total_quantity'];
            $update_sql = "UPDATE products SET quantity = quantity - $total_quantity WHERE name = '$product_name'";
            if ($conn->query($update_sql) == TRUE) {
                header("Location: homepage.php");
            }
        }
    } 
}

    $conn->close();
} 
?>
