<?php
// auth/logout.php
require_once __DIR__ . '/../config/koneksi.php';

// Hapus semua session
$_SESSION = [];
session_unset();
session_destroy();

header("Location: login.php");
exit;
?>