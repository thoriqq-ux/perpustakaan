<?php
// Kredensial database yang diperlukan

$host = 'localhost';
$uname = 'root';
$pass = '';
$database = 'perpustakaan';
$port = 3306;

$connect = mysqli_connect($host, $uname, $pass, $database, $port);

if (!$connect) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
