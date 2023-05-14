<?php
require 'connect.php';

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    // Display a confirmation dialog
    echo "<script>
        var confirmed = confirm('Are you sure you want to delete this user?');
        if (confirmed) {
            window.location.href = 'delete.php?confirmdelete=true&id=$id';
        } else {
            window.location.href = 'show.php';
        }
    </script>";
    exit();
}

if (isset($_GET['confirmdelete']) && $_GET['confirmdelete'] === 'true') {
    $id = $_GET['id'];

    $stmt = $pdo->prepare('DELETE FROM user WHERE id = :id');
    $stmt->execute(['id' => $id]);

    $deleted = $stmt->rowCount();
    if ($deleted == 1) {
        echo "<script>alert('Delete Operation Successful')</script>";
    } else {
        echo "<script>alert('Delete Operation Unsuccessful')</script>";
    }
    header("Location: show.php");
    exit();
}
?>
