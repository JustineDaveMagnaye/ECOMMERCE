<?php
session_start();

// Check if user is logged in as admin, if not, redirect to login page
if (!isset($_SESSION['email']) || $_SESSION['email'] !== "") {
    header("Location: login.php");
    exit();
}

// Database connection details
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for product details
$product_id = $product_name = $product_price = "";
$error_message = "";

// Retrieve product details from database
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    $sql = "SELECT name, price, image FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_image = $row['image'];
    } else {
        $error_message = "Product not found.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    $product_image = uniqid() . '-' . $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'productimage/'.$product_image;


    $query = mysqli_query($conn, "UPDATE products SET name='$product_name', price='$product_price', image='$product_image'");
    
    if(move_uploaded_file($tempname, $folder)) {
        $success_message = "Product adding successfully.";
    } else {
        $error_message = "Error adding product.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Ecommerce</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
        }

        .container {
            margin-left: 250px;
            padding: 20px;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
            opacity: 0.9;
            overflow-y: auto;
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 16px;
            color: #fff;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a.active {
            background-color: #4CAF50;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .form-box {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        input[type="submit"],
        .cancel-button {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #666;
            border-radius: 5px;
            background-color: #444;
            color: #fff;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            cursor: pointer;
            background-color: #4CAF50;
        }
        .cancel-button {
            cursor: pointer;
            background-color: #f44336;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .product-image {
            max-width: 200px;
            margin-bottom: 10px;
        }

        .success-message,
        .error-message {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        
        .error-message {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="sidebar">
    <div class="logo">
            <img src="./img/logo.jpg" alt="Logo">
        </div>
        <a href="#" class="active">Catalog</a>
        <a href="#">Reports</a>
        <a href="#">My Profile</a>
        <a href="login.php">Logout</a>
    </div>

    <div class="container">
        <div class="form-box">
            <h2>Edit Product</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <div class="form-group">
                    <label for="product_name">Product Name:</label><br>
                    <input type="text" id="product_name" name="product_name" value="<?= $product_name ?>" required><br>
                </div>

                <div class="form-group">
                    <label for="product_price">Product Price:</label><br>
                    <input type="number" id="product_price" name="product_price" min="0" step="0.01" value="<?= $product_price ?>" required><br>
                </div>

                <div class="form-group">
                    <label for="image">Product Image:</label><br>
                    <img src="productimage/<?= $product_image ?>" class="product-image">
                    <input type="file" name="image" min="0" step="0.01"><br>
                </div>

                <input type="submit" name="update_product" value="Update Product" class="button">
            </form>
                <button onclick="window.location.href='adminpage.php'" class="cancel-button">Cancel</button>
        </div>
    </div>
</body>
</html>
