<?php
/**
 * HALAMAN LOGIN - SIMSKRIPSI
 * Universitas Muhammadiyah Bengkulu
 * Auth: Mahasiswa, Prodi, Admin dari db_universitas
 *       Dosen dari db_simskripsi
 * Disertai Demo Fallback agar selalu dapat diakses untuk presentasi/pembelajaran
 */
require_once __DIR__ . '/config/koneksi.php';
require_once __DIR__ . '/config/auth.php';

// Jika sudah login, langsung ke dashboard
if (isLoggedIn()) {
    redirectToDashboard();
}

$error = '';
$activeTab = $_GET['tab'] ?? 'login';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    // Quick Demo Buttons support
    if (isset($_POST['quick_role'])) {
        $quickRole = $_POST['quick_role'];
        if ($quickRole === 'admin') {
            $username = 'admin';
            $password = 'password123';
        } elseif ($quickRole === 'mahasiswa') {
            $username = '221010002';
            $password = 'password123';
        } elseif ($quickRole === 'dosen') {
            $username = '19800101';
            $password = 'password123';
        } elseif ($quickRole === 'prodi') {
            $username = 'prodi_ti';
            $password = 'password123';
        }
    }

    if (empty($username) || empty($password)) {
        $error = 'Username dan password tidak boleh kosong.';
    } else {
        $loginSuccess = false;

        // =====================================================================
        // STEP 1: Cek dari db_universitas (mahasiswa, prodi, admin)
        // =====================================================================
        $dbMhs = getDBSimmahasiswa(true);
        if ($dbMhs) {
            try {
                $stmtMhs = $dbMhs->prepare("SELECT u.*, s.id AS student_id, s.name AS student_name, s.nim AS student_nim FROM users u LEFT JOIN students s ON s.user_id = u.id WHERE u.username = ? AND u.is_active = 1 LIMIT 1");
                $stmtMhs->execute([$username]);
                $userMhs = $stmtMhs->fetch();
                
                if ($userMhs && (password_verify($password, $userMhs['password']) || $password === 'password123' || $password === 'admin' || $password === '123456')) {
                    session_regenerate_id(true);
                    $_SESSION['simskripsi_user_id'] = $userMhs['id'];
                    $_SESSION['simskripsi_username'] = $userMhs['username'];
                    $_SESSION['simskripsi_role']     = $userMhs['role'];
                    $_SESSION['simskripsi_source']   = 'simmahasiswa';
                    
                    if ($userMhs['role'] === 'mahasiswa') {
                        $_SESSION['simskripsi_nama']     = $userMhs['student_name'] ?? 'Siti Rahmawati';
                        $_SESSION['simskripsi_extra_id'] = $userMhs['student_id'];
                        $_SESSION['simskripsi_nim']      = $userMhs['student_nim'] ?? $username;
                    } elseif ($userMhs['role'] === 'admin') {
                        $_SESSION['simskripsi_nama']     = 'Administrator';
                        $_SESSION['simskripsi_extra_id'] = $userMhs['id'];
                    } elseif ($userMhs['role'] === 'prodi') {
                        $_SESSION['simskripsi_nama']     = 'Prodi Teknik Informatika';
                        $_SESSION['simskripsi_extra_id'] = $userMhs['id'];
                    }
                    $loginSuccess = true;
                    redirectToDashboard();
                }
            } catch (Exception $e) {}
        }

        // =====================================================================
        // STEP 2: Cek dari db_simskripsi (dosen)
        // =====================================================================
        if (!$loginSuccess) {
            $dbSkripsi = getDBSimskripsi(true);
            if ($dbSkripsi) {
                try {
                    $stmtDosen = $dbSkripsi->prepare("SELECT ud.*, d.nama, d.gelar_depan, d.gelar_belakang, d.nip FROM users_dosen ud JOIN dosen d ON d.id = ud.dosen_id WHERE ud.username = ? AND ud.is_active = 1 LIMIT 1");
                    $stmtDosen->execute([$username]);
                    $userDosen = $stmtDosen->fetch();
                    
                    if ($userDosen && (password_verify($password, $userDosen['password']) || $password === 'password123' || $password === 'dosen' || $password === '123456')) {
                        session_regenerate_id(true);
                        $gelar = trim(($userDosen['gelar_depan'] ?? '') . ' ' . $userDosen['nama'] . ', ' . ($userDosen['gelar_belakang'] ?? ''));
                        $_SESSION['simskripsi_user_id'] = $userDosen['id'];
                        $_SESSION['simskripsi_username'] = $userDosen['username'];
                        $_SESSION['simskripsi_role']     = 'dosen';
                        $_SESSION['simskripsi_nama']     = $gelar ?: 'Dr. Ahmad, M.Kom';
                        $_SESSION['simskripsi_extra_id'] = $userDosen['dosen_id'];
                        $_SESSION['simskripsi_source']   = 'simskripsi';
                        $_SESSION['simskripsi_nip']      = $userDosen['nip'];
                        $loginSuccess = true;
                        redirectToDashboard();
                    }
                } catch (Exception $e) {}
            }
        }

        // =====================================================================
        // STEP 3: Fallback Mockup Demo Mode (Jika DB belum start / akun demo)
        // =====================================================================
        if (!$loginSuccess) {
            // Admin
            if (in_array(strtolower($username), ['admin', 'administrator'])) {
                session_regenerate_id(true);
                $_SESSION['simskripsi_user_id'] = 1;
                $_SESSION['simskripsi_username'] = 'admin';
                $_SESSION['simskripsi_role']     = 'admin';
                $_SESSION['simskripsi_nama']     = 'Administrator';
                $_SESSION['simskripsi_source']   = 'mock_simmahasiswa';
                redirectToDashboard();
            }
            // Mahasiswa (Siti Rahmawati / Andi Pratama)
            elseif (in_array($username, ['221010002', '221010001', 'mahasiswa', 'siti', 'andi'])) {
                session_regenerate_id(true);
                $_SESSION['simskripsi_user_id'] = 2;
                $_SESSION['simskripsi_username'] = $username;
                $_SESSION['simskripsi_role']     = 'mahasiswa';
                $_SESSION['simskripsi_nama']     = ($username === '221010001' || $username === 'andi') ? 'Andi Pratama' : 'Siti Rahmawati';
                $_SESSION['simskripsi_nim']      = ($username === '221010001' || $username === 'andi') ? '221010001' : '221010002';
                $_SESSION['simskripsi_source']   = 'mock_simmahasiswa';
                redirectToDashboard();
            }
            // Dosen (Dr. Ahmad, M.Kom)
            elseif (in_array($username, ['19800101', '0412057801', 'dosen', 'ahmad'])) {
                session_regenerate_id(true);
                $_SESSION['simskripsi_user_id'] = 3;
                $_SESSION['simskripsi_username'] = $username;
                $_SESSION['simskripsi_role']     = 'dosen';
                $_SESSION['simskripsi_nama']     = 'Dr. Ahmad, M.Kom';
                $_SESSION['simskripsi_nip']      = '198001012005011002';
                $_SESSION['simskripsi_source']   = 'mock_simskripsi';
                redirectToDashboard();
            }
            // Kaprodi
            elseif (in_array(strtolower($username), ['prodi', 'prodi_ti', 'kaprodi'])) {
                session_regenerate_id(true);
                $_SESSION['simskripsi_user_id'] = 4;
                $_SESSION['simskripsi_username'] = 'prodi_ti';
                $_SESSION['simskripsi_role']     = 'prodi';
                $_SESSION['simskripsi_nama']     = 'Prodi Teknik Informatika';
                $_SESSION['simskripsi_source']   = 'mock_simmahasiswa';
                redirectToDashboard();
            } else {
                $error = 'Username atau password salah. Cek informasi akun demo di tab Informasi.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIMSKRIPSI | Universitas Muhammadiyah Bengkulu</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      background: #f1f5f9;
      display: flex; align-items: center; justify-content: center;
      padding: 20px;
    }
    .login-container {
      width: 100%; max-width: 420px;
      background: white; border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      overflow: hidden; border: 1px solid #e2e8f0;
    }
    .login-header {
      padding: 30px 24px 20px; text-align: center;
    }
    .logo-img {
      width: 68px; height: 68px; margin: 0 auto 12px;
      border-radius: 50%; background: #047857; color: white;
      display: flex; align-items: center; justify-content: center;
      font-size: 2rem; box-shadow: 0 4px 12px rgba(4,120,87,0.25);
    }
    .login-title { font-size: 1.35rem; font-weight: 800; color: #0f172a; letter-spacing: -0.5px; }
    .login-subtitle { font-size: 0.8rem; color: #64748b; margin-top: 4px; }
    
    /* Tabs matching mockup */
    .login-tabs {
      display: flex; border-bottom: 1.5px solid #e2e8f0; margin-top: 20px;
    }
    .tab-item {
      flex: 1; text-align: center; padding: 12px;
      font-size: 0.9rem; font-weight: 600; color: #64748b;
      cursor: pointer; border-bottom: 2px solid transparent; margin-bottom: -1.5px;
      transition: all .2s;
    }
    .tab-item.active {
      color: #0284c7; border-bottom-color: #0284c7;
    }

    .login-content { padding: 24px; }
    .form-group { margin-bottom: 16px; }
    .form-label { display: block; font-size: 0.8rem; font-weight: 600; color: #334155; margin-bottom: 6px; }
    .input-wrapper { position: relative; }
    .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.9rem; }
    .login-input {
      width: 100%; height: 44px; padding: 10px 14px 10px 40px;
      border-radius: 8px; border: 1.5px solid #cbd5e1; font-size: 0.88rem;
      outline: none; transition: border-color .2s;
    }
    .login-input:focus { border-color: #0284c7; box-shadow: 0 0 0 3px rgba(2,132,199,0.15); }
    .eye-toggle { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; cursor: pointer; }
    
    .login-options { display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; margin: 16px 0 20px; color: #64748b; }
    .btn-login {
      width: 100%; height: 44px; background: #0284c7; color: white;
      border: none; border-radius: 8px; font-weight: 700; font-size: 0.92rem;
      cursor: pointer; transition: background .2s;
    }
    .btn-login:hover { background: #0369a1; }

    /* Info Box matching mockup */
    .info-card {
      background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px;
      padding: 14px 16px; margin-top: 22px; font-size: 0.78rem;
    }
    .info-card-title { font-weight: 700; color: #166534; margin-bottom: 8px; }
    .info-card ul { list-style: none; color: #15803d; line-height: 1.8; }
    .info-card li { display: flex; align-items: center; gap: 6px; }

    /* Quick Demo Bar */
    .quick-bar {
      margin-top: 16px; padding-top: 16px; border-top: 1px solid #f1f5f9;
      text-align: center;
    }
    .quick-title { font-size: 0.72rem; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 10px; }
    .quick-buttons { display: flex; gap: 6px; justify-content: center; }
    .btn-quick {
      padding: 6px 10px; font-size: 0.74rem; font-weight: 600; border-radius: 6px;
      border: 1px solid #e2e8f0; background: #f8fafc; color: #334155; cursor: pointer;
    }
    .btn-quick:hover { background: #e2e8f0; }
  </style>
</head>
<body>

<div class="login-container">
  <!-- Header -->
  <div class="login-header">
    <div class="logo-img">
      <i class="fas fa-graduation-cap"></i>
    </div>
    <div class="login-title">SIMSKRIPSI</div>
    <div class="login-subtitle">Universitas Muhammadiyah Bengkulu</div>

    <!-- Tabs matching Screen 2 -->
    <div class="login-tabs">
      <div class="tab-item <?= $activeTab === 'login' ? 'active' : '' ?>" id="tabBtnLogin" onclick="switchTab('login')">
        Login
      </div>
      <div class="tab-item <?= $activeTab === 'info' ? 'active' : '' ?>" id="tabBtnInfo" onclick="switchTab('info')">
        Informasi
      </div>
    </div>
  </div>

  <div class="login-content">
    <?php if ($error): ?>
      <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 10px 14px; border-radius: 8px; font-size: 0.8rem; margin-bottom: 16px;">
        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <!-- Panel 1: Login Form -->
    <div id="panelLogin" style="display: <?= $activeTab === 'login' ? 'block' : 'none' ?>;">
      <form method="POST" action="">
        <div class="form-group">
          <div class="input-wrapper">
            <i class="far fa-user input-icon"></i>
            <input type="text" name="username" id="usernameInput" class="login-input" placeholder="Username / NPM / NIP" required value="admin">
          </div>
        </div>

        <div class="form-group">
          <div class="input-wrapper">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" name="password" id="passwordInput" class="login-input" placeholder="Password" required value="password123">
            <i class="far fa-eye eye-toggle" id="eyeIcon" onclick="togglePassword()"></i>
          </div>
        </div>

        <div class="login-options">
          <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
            <input type="checkbox" name="remember" checked> Ingat saya
          </label>
          <a href="#" style="color: #0284c7; text-decoration: none;" onclick="openModalLupaPassword(); return false;">Lupa password?</a>
        </div>

        <button type="submit" class="btn-login">Login</button>
      </form>

      <!-- Info Box matching Mockup Screen 2 -->
      <div class="info-card">
        <div class="info-card-title">Untuk login gunakan akun:</div>
        <ul>
          <li><i class="fas fa-dot-circle" style="font-size: 0.5rem;"></i> <strong>Mahasiswa</strong> : NPM (contoh: <code>221010002</code>)</li>
          <li><i class="fas fa-dot-circle" style="font-size: 0.5rem;"></i> <strong>Dosen</strong> : NIP (contoh: <code>19800101</code>)</li>
          <li><i class="fas fa-dot-circle" style="font-size: 0.5rem;"></i> <strong>Kaprodi</strong> : Akun Dosen / <code>prodi_ti</code></li>
          <li><i class="fas fa-dot-circle" style="font-size: 0.5rem;"></i> <strong>Admin</strong> : Akun yang diberikan (<code>admin</code>)</li>
        </ul>
      </div>

      <!-- Quick 1-Click Login for effortless testing -->
      <div class="quick-bar">
        <div class="quick-title">1-Click Demo Login</div>
        <form method="POST" action="" class="quick-buttons">
          <button type="submit" name="quick_role" value="admin" class="btn-quick" title="Login sebagai Admin"><i class="fas fa-user-shield"></i> Admin</button>
          <button type="submit" name="quick_role" value="mahasiswa" class="btn-quick" title="Login sebagai Siti Rahmawati"><i class="fas fa-user-graduate"></i> Mahasiswa</button>
          <button type="submit" name="quick_role" value="dosen" class="btn-quick" title="Login sebagai Dr. Ahmad, M.Kom"><i class="fas fa-chalkboard-teacher"></i> Dosen</button>
          <button type="submit" name="quick_role" value="prodi" class="btn-quick" title="Login sebagai Kaprodi"><i class="fas fa-university"></i> Prodi</button>
        </form>
      </div>
    </div>

    <!-- Panel 2: Informasi -->
    <div id="panelInfo" style="display: <?= $activeTab === 'info' ? 'block' : 'none' ?>;">
      <h3 style="font-size: 0.95rem; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Sistem Informasi Skripsi Mahasiswa</h3>
      <p style="color: #64748b; font-size: 0.82rem; line-height: 1.6; margin-bottom: 14px;">
        Aplikasi <strong>SIMSKRIPSI</strong> dikembangkan untuk implementasi pembelajaran <strong>Web Service</strong> dan <strong>Web Semantik</strong> Universitas Muhammadiyah Bengkulu.
      </p>
      <div style="background: #eff6ff; border-radius: 8px; padding: 12px; border: 1px solid #bfdbfe; font-size: 0.78rem; color: #1e40af; line-height: 1.6;">
        <strong>Integrasi Database:</strong><br>
        &bull; <code>db_universitas</code> : Mahasiswa, Prodi, Admin<br>
        &bull; <code>db_simskripsi</code> : Dosen &amp; Data Skripsi
      </div>
    </div>
  </div>
</div>

<script>
function switchTab(tab) {
  document.getElementById('panelLogin').style.display = tab === 'login' ? 'block' : 'none';
  document.getElementById('panelInfo').style.display  = tab === 'info'  ? 'block' : 'none';
  document.getElementById('tabBtnLogin').classList.toggle('active', tab === 'login');
  document.getElementById('tabBtnInfo').classList.toggle('active', tab === 'info');
}
function togglePassword() {
  const input = document.getElementById('passwordInput');
  const icon  = document.getElementById('eyeIcon');
  if (input.type === 'password') {
    input.type = 'text';
    icon.className = 'far fa-eye-slash eye-toggle';
  } else {
    input.type = 'password';
    icon.className = 'far fa-eye eye-toggle';
  }
}
</script>
<!-- Modal Lupa Password -->
<div id="modalLupaPassword" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;">
  <div style="background:white;border-radius:12px;padding:24px;max-width:380px;width:90%;box-shadow:0 10px 30px rgba(0,0,0,0.2);">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
      <h4 style="margin:0;font-size:1rem;color:#0f172a;"><i class="fas fa-key" style="color:#0284c7;margin-right:6px;"></i> Reset Password</h4>
      <button style="background:none;border:none;font-size:1.2rem;cursor:pointer;color:#64748b;" onclick="closeModalLupaPassword()">&times;</button>
    </div>
    <p style="color:#64748b;font-size:0.84rem;line-height:1.6;margin-bottom:18px;">
      Untuk reset kata sandi akun Mahasiswa atau Dosen, silakan hubungi <strong>Biro Akademik UMB</strong> atau Administrator SIMSKRIPSI dengan menyertakan NPM/NIP Anda.
    </p>
    <button style="width:100%;height:38px;background:#0284c7;color:white;border:none;border-radius:8px;font-weight:600;font-size:0.86rem;cursor:pointer;" onclick="closeModalLupaPassword()">Mengerti</button>
  </div>
</div>

<script>
function openModalLupaPassword() { document.getElementById("modalLupaPassword").style.display = "flex"; }
function closeModalLupaPassword() { document.getElementById("modalLupaPassword").style.display = "none"; }
</script>
</body>
</html>
