<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "leads";
$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Connection failed";
    die("Connection failed: $conn->connect_error");
}

$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

$conn->query("CREATE TABLE IF NOT EXISTS produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL
)");

$conn->query("CREATE TABLE IF NOT EXISTS sales (
    id_sales INT AUTO_INCREMENT PRIMARY KEY,
    nama_sales VARCHAR(100) NOT NULL
)");

$conn->query("CREATE TABLE IF NOT EXISTS leads (
    id_leads INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE,
    id_sales INT,
    id_produk INT,
    no_wa VARCHAR(15),
    nama_lead VARCHAR(100),
    kota VARCHAR(100),
    id_user INT
)");

$produk_check = $conn->query("SELECT COUNT(*) as total FROM produk")->fetch_assoc();
if ($produk_check['total'] == 0) {
    $produk_seed = [
        'Cipta Residence 2', 'The Rich', 'Namorambe City',
        'Grand Banten', 'Turi Mansion', 'Cipta Residence 1'
    ];
    foreach ($produk_seed as $produk) {
        $conn->query("INSERT INTO produk (nama_produk) VALUES ('$produk')");
    }
}

$sales_check = $conn->query("SELECT COUNT(*) as total FROM sales")->fetch_assoc();
if ($sales_check['total'] == 0) {
    for ($i = 1; $i <= 3; $i++) {
        $conn->query("INSERT INTO sales (nama_sales) VALUES ('sales $i')");
    }
}