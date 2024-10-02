<?php
session_start();
include "db_conn.php";

$username = $_POST['name'];
$password = $_POST['password'];
$email=$_POST['email'];

if (empty($username)) {
    $_SESSION['message'] ="Username is required";
    header("Location:index.php");
    exit();
    
} else if (empty($password)) {
    $_SESSION['message'] ="Password is required";
    header("Location:index.php");
    exit();
  
}
else if (empty($email)) {
    $_SESSION['message'] ="Email is required";
    header("Location:index.php");
    exit();
}

$sql_check="SELECT * FROM kayit_olanlar WHERE user_name='$username' OR user_email='$email'";
$result= mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['user_name'] === $username) {
        $_SESSION['message'] ="This username is in use";
        header("Location:index.php");
        exit();
    } 
    else if ($row['user_email'] === $email ) {
        $_SESSION['message'] ="This email is in use";
        header("Location:index.php");
        exit();
    }
}

$sql = "INSERT INTO kayit_olanlar (user_name, user_email, user_password)
VALUES ('$username','$email', '$password');";
$result1=mysqli_query($conn,$sql);
$_SESSION['message'] ="Registration Successful";
header("Location:index.php");
exit();
?>



