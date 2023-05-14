<?php
    require("connect.php");

    $stmt = $pdo->query('SELECT * FROM user ORDER BY id');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            background: linear-gradient(120deg, #84fab0 0%, #8fd3f4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            border: 3px solid rgba(0, 0, 0, 0.1);
            padding: 50px 100px;
            text-align: center;
            max-width: 400px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .container table {
            width: 100%;
        }

        .container th,
        .container td {
            padding: 10px;
        }
        .container th {
            color: black;
        }

        .container tr:hover {
            background-color: #d6eaf8;
        }

        .container a {
            color: #ffffff;
            text-decoration: none;
        }

        .container .btn {
            padding: 5px 10px;
            color: #ffffff;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .container .btn-danger {
            background-color: #ff7675;
        }

        .container .btn-primary {
            background-color: #6495ed;
        }

        .container .btn_out {
            margin-top: 10px;
            margin-bottom: 10px;
            display: inline-block;
            padding: 5px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border: none;
            background-color: #ffcccc;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .btn_out:hover {
             background-color: #ff9999;
        }
    </style>
    <script>
        function confirmLogout() {
            return confirm("Do you really want to logout?");
        }

        function selectRow(link) {
            var row = link.parentNode.parentNode.parentNode;
            row.classList.add('selected-row');
        }
    </script>
</head>
<body>
    <div class="container mt-3">
    <h1 style="color: #<?php echo sprintf('%06X', mt_rand(0, 0xFFFFFF)); ?>">Welcome User!</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $stmt->fetch()) {
                        $id = $row['id'];
                        $username = $row['username'];
                        $password = $row['password'];

                        echo '
                            <tr>
                                <td>'.$id.'</td>
                                <td>'.$username.'</td>
                                <td>'.$password.'</td>
                                <td> 
                                    <button type="submit" class="btn btn-primary" name="updatebtn">
                                        <a href="update.php?updateid='.$id.'">Update</a>
                                    </button> 
                                    <button type="submit" class="btn btn-danger" name="deletebtn">
                                        <a href="delete.php?deleteid='.$id.'">Delete</a>
                                    </button> 
                                </td>
                            </tr>
                        ';
                    }
                ?>
            </tbody>
        </table>
        <button type="submit" class="btn_out">  
            <a href="logout.php" class="btn" onclick="return confirmLogout()">Logout</a>
        </button>
    </div>
</body>
</html>
