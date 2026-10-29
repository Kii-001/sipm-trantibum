<?php
// config/koneksi.php — Koneksi PDO
$host = "localhost";
$user = "root";
$pass = "";                    // default XAMPP kosong
$db   = "sipm_trantibum";

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // lempar exception jika error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // hasil fetch = array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // pakai prepared statement asli
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Mulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>