<?php
$servername = "localhost"; // atau alamat server basis data Anda
$username = "root"; // username MySQL Anda
$password = ""; // password MySQL Anda
$dbname = "monitoringserver";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>