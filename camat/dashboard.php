<?php
// camat/dashboard.php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../auth/cek_role.php';
cekRole(['camat']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Camat — SIPM Trantibum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include __DIR__ . '/../auth/navbar.php'; ?>

<div class="container mt-4">
    <h3>Dashboard Camat</h3>
    <p class="text-muted">Selamat datang, <strong><?= htmlspecialchars($_SESSION['nama']) ?></strong></p>

    <div class="alert alert-info">
        Placeholder dashboard Camat. Modul disposisi akan diisi di Tahap 4.
    </div>
</div>
</body>
</html>