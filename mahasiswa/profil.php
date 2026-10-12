<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['mahasiswa', 'admin']);
$user = getAuthUser();

$pageTitle = "Profil Saya - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Profil Saya', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Profil Mahasiswa</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Data akademik Anda yang terintegrasi langsung dari <strong>db_universitas</strong></p>
    </div>

    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px; max-width: 650px;">
      <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9;">
        <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #0284c7, #0ea5e9); color: white; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700;">
          S
        </div>
        <div>
          <h2 style="font-size: 1.2rem; font-weight: 700; color: #0f172a;">Siti Rahmawati</h2>
          <div style="color: #64748b; font-size: 0.85rem; margin-top: 2px;">NPM: <strong>221010002</strong></div>
          <span class="badge badge-disetujui" style="margin-top: 6px; display: inline-block;">Mahasiswa Aktif Semester 7</span>
        </div>
      </div>

      <table class="info-table" style="width: 100%;">
        <tr>
          <td style="width: 160px; color: #64748b;">Program Studi</td>
          <td style="font-weight: 600; color: #0f172a;">Teknik Informatika (S1)</td>
        </tr>
        <tr>
          <td style="color: #64748b;">Fakultas</td>
          <td style="font-weight: 600; color: #0f172a;">Fakultas Teknik</td>
        </tr>
        <tr>
          <td style="color: #64748b;">IPK Kumulatif</td>
          <td style="font-weight: 700; color: #16a34a;">3.82</td>
        </tr>
        <tr>
          <td style="color: #64748b;">SKS Tempuh</td>
          <td style="font-weight: 600; color: #0f172a;">138 SKS</td>
        </tr>
        <tr>
          <td style="color: #64748b;">Dosen Pembimbing</td>
          <td style="font-weight: 600; color: #2563eb;">Dr. Ahmad, M.Kom</td>
        </tr>
        <tr>
          <td style="color: #64748b;">Basis Autentikasi</td>
          <td style="font-weight: 600; color: #16a34a;"><i class="fas fa-database"></i> Database: db_universitas (SIMMAHASISWA)</td>
        </tr>
      </table>
    </div>
  </div>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>