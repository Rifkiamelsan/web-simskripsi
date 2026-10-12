<?php
/**
 * DOSEN - JADWAL SEMINAR & SIDANG
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['dosen', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$dosenName = ($user['role'] === 'dosen' && !empty($user['nama'])) ? $user['nama'] : 'Dr. Ahmad, M.Kom';

$pageTitle = "Jadwal Saya - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Jadwal Saya', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Jadwal Seminar &amp; Sidang</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Jadwal bimbingan, seminar proposal, dan penguji sidang skripsi</p>
    </div>

    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      <div style="display: flex; flex-direction: column; gap: 14px;">
        <div style="border-left: 4px solid #0284c7; background: #f8fafc; padding: 16px 20px; border-radius: 0 8px 8px 0; display: flex; justify-content: space-between; align-items: center;">
          <div>
            <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Seminar Proposal - Dela Anggraini (NPM: 221010004)</div>
            <div style="color: #64748b; font-size: 0.82rem; margin-top: 4px;">Judul: Sistem Pendukung Keputusan Pemilihan Dosen Terbaik</div>
            <div style="color: #0284c7; font-size: 0.8rem; font-weight: 600; margin-top: 6px;"><i class="fas fa-calendar-alt"></i> 15 Oktober 2026 &bull; 09:00 - 11:00 WIB &bull; Ruang Seminar A Lt.2</div>
          </div>
          <span class="badge badge-seminar">Sebagai Penguji 1</span>
        </div>

        <div style="border-left: 4px solid #16a34a; background: #f8fafc; padding: 16px 20px; border-radius: 0 8px 8px 0; display: flex; justify-content: space-between; align-items: center;">
          <div>
            <div style="font-weight: 700; color: #0f172a; font-size: 0.95rem;">Sidang Skripsi / Munaqasyah - Fajar Nugraha (NPM: 221010006)</div>
            <div style="color: #64748b; font-size: 0.82rem; margin-top: 4px;">Judul: Audit Tata Kelola Teknologi Informasi Menggunakan Framework COBIT 2019</div>
            <div style="color: #16a34a; font-size: 0.8rem; font-weight: 600; margin-top: 6px;"><i class="fas fa-calendar-alt"></i> 10 November 2026 &bull; 10:00 - 12:00 WIB &bull; Ruang Sidang B Lt.3</div>
          </div>
          <span class="badge badge-disetujui">Sebagai Pembimbing</span>
        </div>
      </div>
    </div>
  </div>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>