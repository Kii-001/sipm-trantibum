<?php
// admin/dashboard.php
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../auth/cek_role.php';
cekRole(['admin']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin — SIPM Trantibum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include __DIR__ . '/../auth/navbar.php'; ?>

<div class="container mt-4">
    <h3>Dashboard Admin</h3>
    <p class="text-muted">Selamat datang, <strong><?= htmlspecialchars($_SESSION['nama']) ?></strong></p>

    <div class="alert alert-info">
        Placeholder dashboard Admin. Modul selanjutnya akan diisi di Tahap 3.
    </div>
</div>
</body>
</html>