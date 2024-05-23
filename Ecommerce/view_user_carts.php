<?php
session_start();

if ($_SESSION['username'] !== "admin") {
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "ecommerce";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT c.user_id, u.username 
        FROM cart c
        INNER JOIN users u ON c.user_id = u.id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Carts - Admin Panel</title>
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

    .container {
        margin-left: 250px;
        padding: 20px;
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
    input[type="submit"],
    input[type="file"] {
        width: calc(100% - 20px);
        padding: 10px;
        border: 1px solid #666;
        border-radius: 5px;
        background-color: #444;
        color: #fff;
    }

    input[type="file"] {
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
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: #fff;
        font-weight: bold;
    }

    .product-image {
        max-width: 80px;
        max-height: 80px;
        display: block;
        margin: 0 auto;
    }

    .total-price {
        margin-top: 10px;
        font-weight: bold;
    }
    .reports-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 9999;
        }
        #reportsModal {
        display: none;
        position: fixed;
        z-index: 9998;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        }
        #reportsModal .modal-content {
            background-color: #fefefe;
            color: black;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #reportsModal .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        #reportsModal .close:hover,
        #reportsModal .close:focus {
            color: black;
            text-decoration: none;
        }

        #reportsModal h2 {
            margin-bottom: 20px;
            color: #fff;
            text-align: center;
        }

        #reportsModal label {
            display: block;
            margin-bottom: 10px;
        }

        #reportsModal textarea {
            width: 95%;
            max-width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #reportsModal button[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #reportsModal button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="sidebar">
        <div class="logo">
            <img src="./img/logo.jpg" alt="Logo">
        </div>
        <a href="adminpage.php">Catalog</a>
        <a href="view_user_carts.php" class="active">View User Carts</a>
        <a href="login.php">Logout</a>
    </div>

    <div class="container">
        <div class="form-box">
            <center><h2>View User Carts</h2></center>
        </div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userId = $row['user_id'];
                $username = $row['username'];

                $cartItemsSql = "SELECT * FROM cart WHERE user_id = $userId";
                $cartItemsResult = $conn->query($cartItemsSql);

                if ($cartItemsResult->num_rows > 0) {
                ?>
                    <br>
                    <div class="form-box">
                    <h3>User ID: <?php echo $userId; ?> - Username: <?php echo $username; ?></h3>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                        </tr>
                <?php
                    $total_price = 0;
                    while ($cartRow = $cartItemsResult->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $cartRow['product_name']; ?></td>
                            <td>₱<?php echo $cartRow['price']; ?></td>
                            <td><?php echo $cartRow['quantity']; ?></td>
                            <td><img src='productimage/<?php echo $cartRow['img']; ?>' alt='Product Image' class='product-image' style='max-width: 100px; max-height: 100px;'></td>
                        </tr>
                <?php
                        $subtotal_price = $cartRow['price'];
                        $total_price += $subtotal_price;
                    }
                ?>
                    </table><br>
                    <p class="total-price">Total: ₱<?php echo $total_price; ?></p>
                </div>
                <?php
                    
                } else {
                    echo "<p>No items in the cart for user ID: $userId - Username: $username.</p>";
                }
            }
        } else {
            echo "No user carts found.";
        }
        $conn->close();
        ?>
    </div>
    <div id="reportsModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closereportsModal()">&times;</span>
                <h2 style="color:#222">Customer Reports</h2>
                <div id="suggestionMessages">
                </div>
            </div>
        </div>
        <button class="reports-button" onclick="openreportsModal()">Reports</button>

    </div>

<script>
    function openreportsModal() {
        var modal = document.getElementById("reportsModal");
        modal.style.display = "block";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("suggestionMessages").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "view_reports.php", true);
        xhttp.send();
    }

    function closereportsModal() {
        var modal = document.getElementById("reportsModal");
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        var modal = document.getElementById("reportsModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>
