<?php
$servername = "sql105.infinityfree.com";
$username = "if0_37334974";
$password = "KJABIDvqOmLoby";
$dbname = "if0_37334974_kullanicilar";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası varsa, hata mesajı göster
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>