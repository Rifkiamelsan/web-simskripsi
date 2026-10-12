<?php
/**
 * DASHBOARD DOSEN PEMBIMBING - SIMSKRIPSI
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['dosen', 'admin']);
$user = getAuthUser();

$dosenName = ($user['role'] === 'dosen' && !empty($user['nama'])) ? $user['nama'] : 'Dr. Ahmad, M.Kom';
$dosenNip  = $_SESSION['simskripsi_nip'] ?? '198001012005011002';

require_once dirname(__DIR__) . '/includes/sample_data.php';
$proposals = getProposalList();

$pageTitle = "Dashboard Dosen - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'SIMSKRIPSI', 'url' => 'dashboard.php'],
    ['label' => 'Dashboard Dosen', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Dashboard Dosen Pembimbing</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Selamat datang, <strong><?= htmlspecialchars($dosenName) ?></strong> (NIP: <?= htmlspecialchars($dosenNip) ?>)</p>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #2563eb; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-users"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">12</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Mahasiswa Bimbingan</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #f59e0b; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-hourglass-half"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">5</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Menunggu Validasi</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #16a34a; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-calendar-check"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">4</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Siap Seminar</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #9333ea; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">8</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Lulus Yudisium</div>
        </div>
      </div>
    </div>

    <!-- Mahasiswa Bimbingan Aktif -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <span style="font-size: 1rem; font-weight: 700; color: #0f172a;">Daftar Mahasiswa Bimbingan Anda</span>
        <span class="badge badge-diajukan">Aktif Semester Ini</span>
      </div>

      <div class="table-wrapper">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #fafafa;">
              <th style="padding: 12px;">NPM</th>
              <th style="padding: 12px;">Nama Mahasiswa</th>
              <th style="padding: 12px;">Judul Skripsi</th>
              <th style="padding: 12px;">Tahap</th>
              <th style="padding: 12px;">Status</th>
              <th style="padding: 12px; text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 14px; color: #64748b;">221010002</td>
              <td style="padding: 14px; font-weight: 600; color: #0f172a;">Siti Rahmawati</td>
              <td style="padding: 14px; color: #334155;">Implementasi Web Service dan Web Semantik pada Sistem Informasi Akademik</td>
              <td style="padding: 14px; color: #0284c7; font-weight: 600;">Bab 3 Metodologi</td>
              <td style="padding: 14px;"><span class="badge badge-bimbingan">Bimbingan</span></td>
              <td style="padding: 14px; text-align: center;">
                <a href="../admin/detail_proposal.php?id=2" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; color: white; text-decoration: none;">
                  <i class="fas fa-edit"></i> Bimbing
                </a>
              </td>
            </tr>
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 14px; color: #64748b;">221010005</td>
              <td style="padding: 14px; font-weight: 600; color: #0f172a;">Rizky Maulana</td>
              <td style="padding: 14px; color: #334155;">Implementasi Web Semantik untuk Pencarian Repositori Karya Ilmiah</td>
              <td style="padding: 14px; color: #64748b;">Revisi Proposal</td>
              <td style="padding: 14px;"><span class="badge badge-ditolak">Perlu Revisi</span></td>
              <td style="padding: 14px; text-align: center;">
                <a href="../admin/detail_proposal.php?id=5" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; color: white; text-decoration: none;">
                  <i class="fas fa-edit"></i> Review
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
