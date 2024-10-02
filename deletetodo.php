<?php
include 'db_conn.php';

$id=$_GET['id'];
   
$sql = "DELETE FROM todos WHERE todo_id = $id";
$result= mysqli_query($conn, $sql);



header("Location:todo.php");


?>
