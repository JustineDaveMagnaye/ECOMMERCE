<?php
session_start();
if ($_SESSION['username'] == "") {
    header("Location: login.php");
    exit();
}
?>
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
        background-size: cover;
        background-position: center;
        background-color: #333;
        color: #000; 
        }

        .topnav {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #222;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 20px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        opacity: 0.9;
        z-index: 1000; 
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
            background-color: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
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
            color: #666; 
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
        .product h4 {
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: center;
            font-size: 16px; 
            color: #666; 
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
        #addToCartButton {
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
        #addToCartButton:hover {
            background-color: #45a049;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .view-cart-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 9999;
        }

        .modal {
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

        .modal-content {
            background-color: #222;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .modal-content1 {
            background-color: #222;
            color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .close, .close1 {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus , .close1:hover, .close1:focus,  {
            color: black;
            text-decoration: none;
        }
        #cartItems table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        }

        #cartItems th,
        #cartItems td {
        background-color: white;
        padding: 10px;
        text-align: center; 
        border-bottom: 1px solid #666;
        }

        #cartItems th {
        background-color: #4CAF50;
        color: #fff;
        }

        #cartItems .product-image {
        max-width: 100px;
        max-height: 100px;
        }
        #cartItems .checkout-button, .delete-button {
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
        #cartItems .checkout-button:hover, .delete-button:hover {
            background-color: #45a049;
        }
        
        #modalProductImage {
            max-width: 300px;
            max-height: 300px;
        }
        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container input[type=text] {
            padding: 8px;
            margin: 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            width: 250px;
            transition: width 0.3s ease-in-out;
        }

        .search-container button {
            background-color: transparent;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 8px;
        }

        .search-container button:hover {
            color: #ccc;
        }
        .suggestion-button {
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
        #suggestionModal {
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
        #suggestionModal .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #suggestionModal .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        #suggestionModal .close:hover,
        #suggestionModal .close:focus {
            color: black;
            text-decoration: none;
        }

        #suggestionModal h2 {
            margin-bottom: 20px;
            color: #fff;
            text-align: center;
        }

        #suggestionModal label {
            display: block;
            margin-bottom: 10px;
        }

        #suggestionModal textarea {
            width: 95%;
            max-width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #suggestionModal button[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #suggestionModal button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header class="topnav">
        <img class="logo" src="./img/logo.jpg" alt="Protein Shake Store Logo">
        
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="login.php">Login</a>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search...">
            </div>
            <button class="view-cart-button" onclick="openCartModal()">VIEW CART</button>
        
    </header>
        <br>
        <br>
        <br>
        <div class="container">
        <h2>WELCOME TO JDAVE'S PROTEIN STORE!</h2>
        </div>
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

                $sql = "SELECT id, name, price, quantity, image FROM products"; 
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="product">
                            <h3><?php echo $row['name']; ?></h3>
                            <p>₱<?php echo $row['price']; ?></p>
                            <h4>Stock:<?php echo $row['quantity']; ?></h4>
                            <img src="productimage/<?php echo $row['image']; ?>" class="product-image">

                            <button class="buy-button">Add to Cart</button>
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
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Add to cart successfully!</p>
        </div>
    </div>
    <div id="myModal" class="modal">
    <div class="modal-content1">
        <span class="close1">&times;</span>
        <center><h2>Add to Cart</h2></center>
        <div class="product-info">
            <center>
            <img src="" alt="Product Image" id="modalProductImage">
            <h3 id="modalProductName"></h3>
            <p id="modalProductPrice"></p>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1">
            <p>Total Price: <span id="totalPrice"></span></p>
            <button id="addToCartButton">Add to Cart</button>
            </center>
        </div>
    </div>
</div>


    <div id="cartModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCartModal()">&times;</span>
            <center><h2>Your Cart</h2></center>
            <div id="cartItems">
            </div>
        </div>
    </div>
    <div id="suggestionModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeSuggestionModal()">&times;</span>
            <h2 style="color:#222">Customer Suggestion</h2>
            <form id="suggestionForm" action="save_suggestion.php" method="POST">
                <label for="adminSuggestion">Your Suggestion:</label>
                <textarea id="adminSuggestion" name="adminSuggestion" rows="4" cols="50"></textarea>
                <br>
                <center><button type="submit">Submit</button></center>
            </form>
        </div>
    </div>

    <button class="suggestion-button" onclick="openSuggestionModal()">Suggest</button>

    <script>
    var modal = document.getElementById("myModal");
var successmodal = document.getElementById("successModal");
var buyButtons = document.querySelectorAll(".buy-button");
var closeBtn = document.querySelector(".close");
var closeBtn1 = document.querySelector(".close1");

buyButtons.forEach(function(btn) {
    btn.addEventListener("click", function() {
        var product = this.closest('.product');
        var productName = product.querySelector('h3').textContent;
        var productPrice = parseFloat(product.querySelector('p').textContent.replace('₱', ''));
        var productQuantity = parseInt(product.querySelector('h4').textContent.replace('Stock:', ''));
        var productImg = product.querySelector('.product-image').src;

        var modalProductName = document.getElementById("modalProductName");
        var modalProductPrice = document.getElementById("modalProductPrice");
        var modalProductImage = document.getElementById("modalProductImage");
        var quantityInput = document.getElementById("quantity");
        var totalPriceSpan = document.getElementById("totalPrice");

        modalProductName.textContent = productName;
        modalProductPrice.textContent = "Price: ₱" + productPrice.toFixed(2);
        modalProductImage.src = productImg;

        quantityInput.value = 1;
        totalPriceSpan.textContent = "₱" + productPrice.toFixed(2);

        quantityInput.addEventListener("input", function() {
            var quantity = parseInt(quantityInput.value);
            if (quantity > productQuantity) {
                quantityInput.value = productQuantity;
                quantity = productQuantity;
            }
            var totalPrice = productPrice * quantity;
            totalPriceSpan.textContent = totalPrice.toFixed(2);
        });

        modal.style.display = "block";
    });
});

    var addToCartButton = document.getElementById("addToCartButton");
    addToCartButton.addEventListener("click", function() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                modal.style.display = "none";
                successmodal.style.display = "block";
            }
        };
        var user_id = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>";
        var productName = document.getElementById("modalProductName").textContent;
        var productPrice = parseFloat(document.getElementById("modalProductPrice").textContent.replace('Price: ₱', ''));
        var quantity = parseInt(document.getElementById("quantity").value);
        var productImg = document.getElementById("modalProductImage").src;
        var temp = productPrice * quantity;
        xhr.send("name=" + productName + "&price=" + temp + "&quantity=" + quantity + "&image=" + productImg + "&user_id=" + user_id);
    });

    closeBtn.addEventListener("click", function() {
    modal.style.display = "none";
    successmodal.style.display = "none";
    });
        closeBtn1.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    });



    function openCartModal() {
        var modal = document.getElementById("cartModal");
        modal.style.display = "block";

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "cart_items.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("cartItems").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
        }

        function closeCartModal() {
            var modal = document.getElementById("cartModal");
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById("cartModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        function filterProducts() {
            var input, filter, products, product, productName;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            products = document.querySelectorAll('.product');

            products.forEach(function(product) {
                productName = product.querySelector('h3').textContent.toUpperCase();
                if (productName.indexOf(filter) > -1) {
                    product.style.display = "";
                } else {
                    product.style.display = "none";
                }
            });
        }
        document.getElementById('searchInput').addEventListener('input', filterProducts);
        function openSuggestionModal() {
        var modal = document.getElementById("suggestionModal");
        modal.style.display = "block";
        }

        function closeSuggestionModal() {
            var modal = document.getElementById("suggestionModal");
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById("suggestionModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

</script>
</body>
</html>
