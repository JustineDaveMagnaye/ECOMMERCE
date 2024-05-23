<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
        // User is not logged in, redirect to login page
        header("Location: login.php");
        exit();
    }

    // Validate admin suggestion input
    $adminSuggestion = $_POST['adminSuggestion'];

    // Validate input to prevent SQL injection
    $adminSuggestion = htmlspecialchars($adminSuggestion);

    // Database connection
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "ecommerce";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO suggestion (message, username, date_added) VALUES (?, ?, CURRENT_TIMESTAMP)");

    // Get username from session
    $username = $_SESSION['username'];

    $stmt->bind_param("ss", $adminSuggestion, $username);

    if ($stmt->execute()) {
        header("Location: homepage.php");
        exit();
    } 

    $stmt->close();
    $conn->close();
} 
?>
