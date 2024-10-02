<?php
session_start(); // Oturumu başlatıyoruz, böylece kullanıcı bilgilerine erişebiliriz.
include 'db_conn.php'; // Veritabanı bağlantı dosyasını dahil ediyoruz.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alıyoruz.
    $todoName = trim($_POST['todo']); // Girilen todo adını boşluklardan temizleyip alıyoruz.
    $priority = $_POST['priority']; // Seçilen öncelik durumu
    $tags = $_POST['tags']; // Seçilen etiket
    $userId = $_SESSION['user_id']; // Oturumdan kullanıcı ID'sini alıyoruz.


    // Veriyi veritabanına eklemek için sorguyu oluşturuyoruz.
    $sql = "INSERT INTO todos (user_id, todo_name, todo_priority, todo_tag) 
            VALUES ('$userId', '$todoName', '$priority', '$tags')";
    $result = mysqli_query($conn, $sql); // Sorguyu çalıştırıyoruz.

    if ($result) {
        header("Location: todo.php");
    } else {
        header("Location: todo.php");
    }
}
?>

