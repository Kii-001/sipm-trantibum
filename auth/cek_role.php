<?php
// auth/cek_role.php
// Cara pakai di halaman: 
//   require_once __DIR__ . '/../auth/cek_role.php';
//   cekRole(['admin']);             ← hanya admin
//   cekRole(['camat', 'kasi']);     ← camat atau kasi

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kalau belum login → tendang ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "auth/login.php");
    exit;
}

/**
 * Pastikan user yang login punya role yang diizinkan.
 * @param array $allowedRoles
 */
function cekRole(array $allowedRoles): void
{
    if (!in_array($_SESSION['role'], $allowedRoles, true)) {
        // Role tidak sesuai → tampilkan 403
        http_response_code(403);
        echo "<!DOCTYPE html><html><head><title>Akses Ditolak</title>
              <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
              </head><body class='d-flex align-items-center justify-content-center' style='min-height:100vh;background:#f8f9fa'>
              <div class='text-center'>
                <h1 class='display-4 text-danger'>403</h1>
                <p class='lead'>Anda tidak memiliki akses ke halaman ini.</p>
                <a href='" . BASE_URL . "index.php' class='btn btn-primary'>Kembali ke Dashboard</a>
              </div></body></html>";
        exit;
    }
}