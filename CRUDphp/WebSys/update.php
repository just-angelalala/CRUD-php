<?php
require 'connect.php';

$id = $_GET['updateid'];

// Check if the form is submitted
if (isset($_POST['updatebtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('UPDATE user SET username = :username, password = :password WHERE id = :id');
    $stmt->execute(['id' => $id, 'username' => $username, 'password' => $password]);

    $updated = $stmt->rowCount();
    if ($updated == 1) {
        echo "<script>alert('Successfully Updated Operation')</script>";
        echo "<script>window.location.href = 'show.php?id=$id';</script>"; // Redirect to show page
        exit();
    } else {
        echo "<script>alert('Unsuccessfully Updated Operation')</script>";
    }
}

// Retrieve the user information for pre-filling the form
$stmt = $pdo->prepare('SELECT * FROM user WHERE id = :id');
$stmt->execute(['id' => $id]);
$row = $stmt->fetch();
if (!$row) {
    // User with the specified ID doesn't exist
    echo "<script>alert('User not found')</script>";
    echo "<script>window.location.href = 'show.php';</script>"; // Redirect to show page
    exit();
}

$username = $row['username'];
$password = $row['password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Info</title>
    <link rel="stylesheet" href="design/style.css">
    <style>    
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 30vh;
            border: 3px solid rgba(0, 0, 0, 0.1);
            padding: 50px 100px;
            text-align: center;
            max-width: 400px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-row {
            display: flex;
            flex-wrap:nowrap;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin-bottom: 10px;
        }

        .form-row label {
            width: 100px;
            font-weight: bold;
        }

        .form-row input[type="text"],
        .form-row input[type="password"] {
            width: 100%;
            padding: 5px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Update User Info</h1>
        <form action="" method="post">
            <div class="form-row">
                <label for="id">ID:</label>
                <input type="text" name="id" readonly value="<?php echo $id;?>">
            </div>
            <div class="form-row">
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo $username;?>">
            </div>
            <div class="form-row">
                <label for="password">Password:</label>
                <input type="text" name="password" value="<?php echo $password;?>">
            </div>
            
            <button type="submit" class="btn btn-primary" name="updatebtn">Update</button>
        </form>
        <script src="js/main.js"></script>
    </div>
</body>
</html>
