<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    $product_image = uniqid() . '-' . $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'productimage/'.$product_image;

    $query = mysqli_query($conn, "INSERT INTO products (name, price, image) VALUES('$product_name', '$product_price', '$product_image')");
    
    if(move_uploaded_file($tempname, $folder)) {
        $success_message = "Product adding successfully.";
    } else {
        $error_message = "Error adding product.";
    }
    
}

if (isset($_GET['delete_product'])) {
    $product_id = $_GET['delete_product'];

    $query = mysqli_query($conn, "DELETE FROM products WHERE id=$product_id");
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Ecommerce</title>
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
        input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #666;
            border-radius: 5px;
            background-color: #444;
            color: #fff;
        }

        input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #666;
            border-radius: 5px;
            background-color: #444;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"] {
            cursor: pointer;
            background-color: #4CAF50;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #666;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        .no-products {
            margin-top: 20px;
            color: #888;
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

        .product-image {
            max-width: 100px;
            max-height: 100px;
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
            <center><h1>Your Catalog</h1></center>
        </div>
        <div class="content">
            <h2>Add Product</h2>
            <div class="form-box">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="product_name">Product Name:</label><br>
                        <input type="text" id="product_name" name="product_name" required><br>
                    </div>

                    <div class="form-group">
                        <label for="product_price">Product Price:</label><br>
                        <input type="number" id="product_price" name="product_price" min="0" step="0.01" required><br>
                    </div>

                    <div class="form-group">
                        <label for="image">Upload Product Image:</label><br>
                        <input type="file" name="image" required><br>
                    </div>
                    <input type="submit" name="add_product" value="Add Product" class="button">
                </form>
            </div>
        </div>
        <div class="form-box">
            <div class="content">
                <h2>Existing Products</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql = "SELECT id, name, price, image FROM products"; 
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['price'] ?></td>
                                <td><img src="productimage/<?= $row['image'] ?>" alt="Product Image" class="product-image"></td>
                                <td>
                                    <a href='edit_product.php?id=<?= $row['id'] ?>'>Edit</a> |
                                    <a href='adminpage.php?delete_product=<?= $row['id'] ?>'>Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No products found</td></tr>";
                    }
                    ?>
                </table>
                <?php if (isset($success_message)): ?>
                    <div class="success-message"><?= $success_message ?></div>
                <?php endif; ?>
                <?php if (isset($error_message)): ?>
                    <div class="error-message"><?= $error_message ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
