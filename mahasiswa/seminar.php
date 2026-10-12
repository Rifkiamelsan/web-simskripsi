<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['mahasiswa', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$pageTitle = "Seminar Proposal - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Seminar Proposal', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Seminar Proposal Skripsi</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Informasi pendaftaran, syarat berkas, dan jadwal ujian seminar proposal</p>
    </div>

    <!-- Syarat Checklist & Jadwal Card -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <!-- Syarat -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px;">
        <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
          Persyaratan Seminar Proposal
        </div>
        <div style="display: flex; flex-direction: column; gap: 12px; font-size: 0.86rem;">
          <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle" style="color: #10b981; font-size: 1.1rem;"></i>
            <span>Telah menempuh minimal 110 SKS (Terpenuhi: 138 SKS)</span>
          </div>
          <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle" style="color: #10b981; font-size: 1.1rem;"></i>
            <span>KRS Aktif Semester Ganjil 2026/2027</span>
          </div>
          <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle" style="color: #10b981; font-size: 1.1rem;"></i>
            <span>Persetujuan Dosen Pembimbing (Dr. Ahmad, M.Kom)</span>
          </div>
          <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-clock" style="color: #f59e0b; font-size: 1.1rem;"></i>
            <span>Pelaksanaan Seminar: <strong>25 Oktober 2026</strong></span>
          </div>
        </div>
      </div>

      <!-- Jadwal -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px;">
        <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
          Jadwal &amp; Dewan Penguji
        </div>
        <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 16px; margin-bottom: 14px;">
          <div style="font-weight: 700; color: #1e40af; font-size: 0.92rem; margin-bottom: 4px;">Ujian Seminar Proposal</div>
          <div style="font-size: 0.82rem; color: #1d4ed8; line-height: 1.6;">
            &bull; Waktu: <strong>Selasa, 25 Oktober 2026 (09:30 - 11:30 WIB)</strong><br>
            &bull; Ruangan: <strong>Ruang Seminar FT Lt. 2</strong>
          </div>
        </div>
        <div style="font-size: 0.82rem; color: #334155; line-height: 1.6;">
          <strong>Dosen Pembimbing:</strong> Dr. Ahmad, M.Kom<br>
          <strong>Dosen Penguji 1:</strong> Prof. Dr. Ir. Hendra, M.T<br>
          <strong>Dosen Penguji 2:</strong> Dr. Budi Santoso, M.M
        </div>
      </div>
    </div>
  </div>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>