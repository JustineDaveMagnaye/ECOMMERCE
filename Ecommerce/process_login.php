<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

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
      // Query to check if user is admin
    $admin_username = "admin";
    $admin_password = "123";
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['email'] = ""; 
        header("Location: adminpage.php");
        exit();
    }
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) != 0) {
        $row = $result->fetch_assoc();
            $_SESSION['email'] = $row['email'];
            header("Location: homepage.php");
       
    } else {
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: login.php");
        exit();
    }

    $conn->close();
} else {
    header("Location: login.php");
    exit();
}
?>
