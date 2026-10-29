<?php
// auth/login.php
require_once __DIR__ . '/../config/koneksi.php';

// Kalau sudah login, langsung redirect
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login sukses → set session
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['nama']     = $user['nama'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            header("Location: ../index.php");
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SIPM Trantibum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,.3);
            padding: 40px;
            width: 100%;
            max-width: 420px;
        }
        .login-card h3 {
            font-weight: 700;
            color: #1e3c72;
        }
        .login-card .subtitle {
            color: #666;
            font-size: .9rem;
            margin-bottom: 30px;
        }
        .btn-login {
            background: #1e3c72;
            border: none;
            font-weight: 600;
            padding: 10px;
        }
        .btn-login:hover { background: #2a5298; }
    </style>
</head>
<body>

<div class="login-card">
    <h3 class="text-center">SIPM Trantibum</h3>
    <p class="subtitle text-center">
        Sistem Informasi Pengaduan Masyarakat<br>
        Kecamatan Medan Petisah
    </p>

    <?php if ($error): ?>
        <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required autofocus
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 btn-login">Masuk</button>
    </form>

    <hr class="my-4">
    <div class="text-muted small">
        <strong>Akun demo:</strong><br>
        admin / 123456 &nbsp;|&nbsp; camat / 123456<br>
        kasi / 123456 &nbsp;|&nbsp; petugas / 123456
    </div>
</div>

</body>
</html>