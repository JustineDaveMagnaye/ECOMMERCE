<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to JDave's Protein Store</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('./img/background.png');
            background-size: 100% 100%; 
            background-position: center;
            background-color: #333;
            color: #000; 
        }

        .topnav {
            background-color: #222;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
        }

        .topnav a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .topnav a:hover {
            background-color: #555;
        }

        .topnav .logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
        }

        .topnav .logo:hover {
            transform: rotate(360deg);
        }

        .header-motto {
            font-size: 32px;
            font-weight: bold;
            color: #fff;
            margin: 20px auto;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 2px;
            background-color: #222;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }

        .container .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #fff;
        }

        p {
            color: #666; /* Changed font color to a darker shade of gray */
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .features {
            display: flex;
            justify-content: space-around;
            margin-bottom: 40px;
        }

        .feature {
            width: 30%;
            padding: 20px;
            background-color: gray;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-left: 10px;
        }

        .feature h3 {
            color: #fff;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .feature p {
            color: #ccc;
            font-size: 16px;
        }

        .cta {
            background-color: #4caf50;
            padding: 40px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .cta h2 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .cta button {
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            color: #4caf50;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cta button:hover {
            background-color: #ddd;
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            grid-gap: 30px; 
            justify-items: center;
        }

        .product {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px; 
        }

        .product h3 {
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: center;
            font-size: 18px; 
            color: #000; 
        }

        .product p {
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: center;
            font-size: 16px; 
            color: #666; 
        }
        .product-image {
            width: 30vh;
            height: 25vh;
        }
        .buy-button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #4caf50;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 5px;
        display: block;
        width: 100%; 
        max-width: 200px; 
        margin-left: auto;
        margin-right: auto;
        }

        .buy-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="topnav">
        <img class="logo" src="./img/logo.jpg" alt="Protein Shake Store Logo">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Login</a>
    </div>

    <div class="header-motto">Welcome to JDave's Protein Store</div>

    <div class="container">
        <h2>Our Products</h2>
        <div class="product-container">
            <?php
            $servername = "localhost";
            $username_db = "root";
            $password_db = "";
            $database = "ecommerce";

            $conn = new mysqli($servername, $username_db, $password_db, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, name, price, image FROM products"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="product">
                        <h3><?= $row['name'] ?></h3>
                        <p>₱<?= $row['price'] ?></p>
                        <img src="productimage/<?php echo $row['image'] ?>" class="product-image">
                        <button class="buy-button">Purchase</button>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No products found</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <div class="container">
        <h2>Why Choose Us?</h2>
        <div class="features">
            <div class="feature">
                <h3>Quality Products</h3>
                <p>We offer the best quality protein!</p>
            </div>
            <div class="feature">
                <h3>Expert Advice</h3>
                <p>Our knowledgeable Jdaves staff are here to help you find the perfect products for you!</p>
            </div>
            <div class="feature">
                <h3>Fast Delivery</h3>
                <p>Get your protein products delivered straight to your door!</p>
            </div>
        </div>
    </div>
</body>
</html>
