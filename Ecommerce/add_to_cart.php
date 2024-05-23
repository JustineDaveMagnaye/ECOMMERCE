<?php
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}


$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$image = $_POST['image'];
$user_id = $_SESSION['user_id']; 

$image_filename = basename($image);

$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "ecommerce";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_check_query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
$result = $conn->query($user_check_query);
if ($result->num_rows == 0) {
    echo "User does not exist.";
    exit();
}

$sql = "INSERT INTO cart (user_id, product_name, price, quantity, img) VALUES ('$user_id', '$name', '$price', '$quantity', '$image_filename')";

if ($conn->query($sql) === TRUE) {
    echo "Product added to cart successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
