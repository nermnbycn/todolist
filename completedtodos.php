<?php
session_start(); 
include 'db_conn.php'; 
$user_id = $_SESSION['user_id'];
$id=$_GET['id']; //eklenen todonun id bilgisi


$sql = "SELECT * FROM todos WHERE todo_id = $id"; //secilen todo bilgilerini aliyoruz (checkmark tiklandginda)
$result= mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$completed_name = $row['todo_name'];
$completed_priority = $row['todo_priority'];
$completed_tag = $row['todo_tag'];


$insert_sql = "INSERT INTO completedtodo (completed_name, completed_priority, completed_tag, user_id) 
            VALUES ('$completed_name', '$completed_priority', '$completed_tag', '$user_id')";
$result2 = mysqli_query($conn, $insert_sql); 




$delete_sql="DELETE FROM todos WHERE todo_id = $id";
$result3=mysqli_query($conn,$delete_sql);

header("Location:todo.php");
?>