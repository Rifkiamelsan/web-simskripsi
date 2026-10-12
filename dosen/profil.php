<?php
/**
 * DOSEN - PROFIL PENGGUNA
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['dosen', 'admin']);
$user = getAuthUser();

$dosenName = ($user['role'] === 'dosen' && !empty($user['nama'])) ? $user['nama'] : 'Dr. Ahmad, M.Kom';
$dosenNip  = $_SESSION['simskripsi_nip'] ?? '198001012005011002';

$pageTitle = "Profil Dosen - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Profil', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Profil Dosen</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Informasi akun dan data akademik dosen pembimbing</p>
    </div>

    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px; max-width: 650px;">
      <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
        <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: white; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700;">
          A
        </div>
        <div>
          <h2 style="font-size: 1.2rem; font-weight: 700; color: #0f172a;"><?= htmlspecialchars($dosenName) ?></h2>
          <div style="color: #64748b; font-size: 0.85rem; margin-top: 2px;">NIP: <?= htmlspecialchars($dosenNip) ?></div>
          <span class="badge badge-disetujui" style="margin-top: 6px; display: inline-block;">Dosen Pembimbing Aktif</span>
        </div>
      </div>

      <table class="info-table" style="width: 100%;">
        <tr>
          <td style="width: 160px; color: #64748b;">Program Studi</td>
          <td style="font-weight: 600; color: #0f172a;">Teknik Informatika</td>
        </tr>
        <tr>
          <td style="color: #64748b;">Fakultas</td>
          <td style="font-weight: 600; color: #0f172a;">Fakultas Teknik</td>
        </tr>
        <tr>
          <td style="color: #64748b;">Email Akademik</td>
          <td style="font-weight: 600; color: #2563eb;">ahmad@umb.ac.id</td>
        </tr>
        <tr>
          <td style="color: #64748b;">Basis Autentikasi</td>
          <td style="font-weight: 600; color: #16a34a;"><i class="fas fa-database"></i> Database: db_simskripsi</td>
        </tr>
      </table>
    </div>
  </div>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>