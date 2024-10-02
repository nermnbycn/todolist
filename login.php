<?php
session_start();
include "db_conn.php";

$username = $_POST['name'];
$password = $_POST['password'];

if (empty($username)) {
    $_SESSION['message'] ="User Name is required";
    header("Location: index.php");
    exit();
} else if (empty($password)) {
    $_SESSION['message'] ="Password is required";
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM kayit_olanlar WHERE user_name='$username' OR user_password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['user_name'] === $username && $row['user_password'] === $password) {
        $_SESSION['user_id'] = $row['user_id']; 
        header("Location: todo.php");
        exit();
    } 
    else if ($row['user_name'] === $username && $row['user_password'] != $password) {
        $_SESSION['message'] ="Incorrect Password";
        header("Location: index.php");
        exit();
    }
    else{
        $_SESSION['message'] ="User name and password don't match";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['message'] ="There is no user";
    header("Location: index.php");
    exit();
}
?>

