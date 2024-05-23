<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "ecommerce";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$suggestionSql = "SELECT message, username, date_added FROM suggestion";
$suggestionResult = $conn->query($suggestionSql);

if ($suggestionResult->num_rows > 0) {
    while ($row = $suggestionResult->fetch_assoc()) {
        echo "<br>";
        echo "<p><strong>Username:</strong> {$row['username']}<br>";
        echo "<strong>Date Added:</strong> {$row['date_added']}<br>";
        echo "<strong>Message:</strong> {$row['message']}</p>";
    }
} else {
    echo "No suggestion messages found.";
}

$conn->close();
?>
