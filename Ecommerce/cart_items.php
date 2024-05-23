<?php
session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo "User is not logged in.";
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

$user_id = $_SESSION['user_id'];
$sql = "SELECT id, product_name, price, quantity, img FROM cart WHERE user_id = '$user_id'";
$result = $conn->query($sql);

$total_price = 0;

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Image</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $subtotal_price = $row['price'];
        $total_price += $subtotal_price;
        ?>
        <tr>
            <td><?= $row['product_name'] ?></td>
            <td>₱<?= $row['price'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><img src="productimage/<?= $row['img'] ?>" alt="Product Image" class="product-image"></td>
            <td>
                <form method="post" action="delete_product.php">
                    <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </td>
        </tr>
        <?php
    }
    echo "</table>";

    echo "<p>Total: ₱" . $total_price . "</p>";
    echo '<form method="post" action="checkout.php">
              <button type="submit" class="checkout-button" name="checkout">Checkout</button>
          </form>';
} else {
    echo "<p>Your cart is empty.</p>";
}

$conn->close();
?>
