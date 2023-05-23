<?php
$host = "localhost";
$user = "root";
$password = ""; // Password dikosongkan
$database = "mahasiswa";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ubah tipe data kolom 'nim' menjadi BIGINT
mysqli_query($conn, "ALTER TABLE data_mahasiswa MODIFY nim BIGINT AUTO_INCREMENT");

?>
