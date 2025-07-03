<?php
// Kredensial database yang diperlukan

$host = 'localhost';
$uname = 'root';
$pass = '';
$database = 'perpustakaan';
// $port1 = 3307;
$port2 = 3306;

$connect = mysqli_connect($host, $uname, $pass, $database, $port2);

if (!$connect) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
