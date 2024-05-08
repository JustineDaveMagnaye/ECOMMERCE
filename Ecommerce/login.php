<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Protein Shake Store</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('./img/background.png');
            background-size: 250vh;
            background-repeat: no-repeat;
            background-position:50% 10%;
            background-color: #333;
            color: #fff;
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
            margin: 20px auto 20px;
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
            width: 320px;
            margin: 0 auto;
            text-align: center;
        }

        .container .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
        }

        h2 {
            margin-bottom: 30px;
            color: #fff;
        }

        label {
            color: #ccc;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .forgot-create {
            color: #ccc;
            font-size: 14px;
            margin-top: 10px;
        }

        .forgot-create a {
            color: #fff;
            text-decoration: underline;
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
    <div class="header-motto">JDave's Protein Store</div>
    <div class="container">
        <img class="logo" src="./img/logo.jpg" alt="Protein Shake Store Logo">
        <h2>Login</h2>
        <form action="process_login.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Login">
            <?php
            if (isset($_SESSION['login_error'])) {
                echo "<p class='error'>{$_SESSION['login_error']}</p>";
                unset($_SESSION['login_error']);
            }
            ?>
        </form>
        <div class="forgot-create">
            <a href="#">Forgot Password?</a><br>
            <a href="#">Create Account</a>
        </div>
    </div>
</body>
</html>
