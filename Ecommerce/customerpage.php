<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "ecommerce";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page - Ecommerce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
            justify-items: center;
        }

        .product {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product img {
            max-width: 100%;
            height: auto;
        }

        .product h3 {
            margin-top: 10px;
            text-align: center;
        }

        .product p {
            text-align: center;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Products</h1>
        <div class="product-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="product">
                        <img src="path_to_product_image/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                        <h3><?php echo $row['name']; ?></h3>
                        <p><?php echo '$' . $row['price']; ?></p>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
