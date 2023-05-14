<?php
require 'connect.php';

$usernameError = '';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {

        // Check if username is already taken
        $stmt_check = $pdo->prepare('SELECT COUNT(*) FROM user WHERE username = :username');
        $stmt_check->execute(['username' => $username]);

        if ($stmt_check->fetchColumn() > 0) {
            $usernameError = 'Username already taken';
        } else {
            // Insert user into the database
            $stmt = $pdo->prepare('INSERT INTO user (username, password) VALUES (:username, :password)');
            $stmt->execute(['username' => $username, 'password' => $password]);
            header("Location: login.php");
            exit();
        }
    } else {
        echo "<script>alert('Please complete the required fields!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New User</title>
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

        .LRform .error {
            color: red;
            margin-top: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post" class="LRform">
            <h1>Register New User</h1>
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <span class="error"><?php echo $usernameError; ?></span>
            </div>
            <div>
                <label for="pwd">Password:</label>
                <input type="password" id="pwd" name="password">
            </div>
            <button type="submit" name="register">Register</button>
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </form>
    </div>
</body>
</html>
