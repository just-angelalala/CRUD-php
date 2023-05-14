<?php
require 'connect.php';

if (isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT username, password FROM user WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user) {
            // Username exists in the database
            if ($username === $user['username'] && $password === $user['password']) {
                // Username and password match, proceed with login
                header("Location: show.php");
                exit();
            } else {
                // Invalid username or password
                echo "<script>alert('Invalid username or password')</script>";
            }
        } else {
            // Invalid username
            echo "<script>alert('Enter a valid username and password')</script>";
        }
    } else {
        // Required fields are not filled in
        echo "<script>alert('Please complete the required fields')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="design/style.css">
    <style>
        .LRform {
            border: 3px solid rgba(0, 0, 0, 0.1);
            padding: 50px 100px;
            text-align: center;
            max-width: 400px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .LRform h1 {
            margin-bottom: 20px;
        }

        .LRform .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .LRform label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .LRform input[type="text"],
        .LRform input[type="password"] {
            width: 100%;
            padding: 5px;
        }

        .LRform .login-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post" class="LRform">
            <h1 class="mb-3">Login</h1>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button> 
            <p>don't have an account? <a href="register.php">register now</a></p>
        </form>
    </div>
</body>
</html>