<?php
/**
 * DASHBOARD PROGRAM STUDI - SIMSKRIPSI
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['prodi', 'admin']);
$user = getAuthUser();

$prodiName = ($user['role'] === 'prodi' && !empty($user['nama'])) ? $user['nama'] : 'Prodi Teknik Informatika';

require_once dirname(__DIR__) . '/includes/sample_data.php';
$proposals = getProposalList();

$pageTitle = "Dashboard Prodi - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'SIMSKRIPSI', 'url' => 'dashboard.php'],
    ['label' => 'Dashboard Prodi', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Dashboard Program Studi</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Panel Pengelolaan Skripsi - <strong><?= htmlspecialchars($prodiName) ?></strong></p>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #2563eb; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-file-signature"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">18</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Usulan Proposal Baru</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #16a34a; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-user-check"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">34</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Dosen Ditugaskan</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #f59e0b; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">6</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Jadwal Seminar Minggu Ini</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #9333ea; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-award"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">12</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Siap Yudisium</div>
        </div>
      </div>
    </div>

    <!-- Table Validasi Proposal Prodi -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <span style="font-size: 1rem; font-weight: 700; color: #0f172a;">Daftar Pengajuan Proposal Mahasiswa TI</span>
        <a href="../admin/proposal.php" style="font-size: 0.78rem; color: #2563eb; text-decoration: none; font-weight: 600;">Lihat Semua Proposal</a>
      </div>

      <div class="table-wrapper">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #fafafa;">
              <th style="padding: 12px;">NPM</th>
              <th style="padding: 12px;">Nama Mahasiswa</th>
              <th style="padding: 12px;">Judul Skripsi</th>
              <th style="padding: 12px;">Status</th>
              <th style="padding: 12px; text-align: center;">Aksi Validasi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($proposals as $p): ?>
              <?php if ($p['prodi'] === 'TI'): ?>
                <tr style="border-bottom: 1px solid #f1f5f9;">
                  <td style="padding: 14px; color: #64748b;"><?= htmlspecialchars($p['npm']) ?></td>
                  <td style="padding: 14px; font-weight: 600; color: #0f172a;"><?= htmlspecialchars($p['nama']) ?></td>
                  <td style="padding: 14px; color: #334155; line-height: 1.4;"><?= htmlspecialchars($p['judul']) ?></td>
                  <td style="padding: 14px;"><span class="badge badge-diajukan"><?= htmlspecialchars($p['status']) ?></span></td>
                  <td style="padding: 14px; text-align: center;">
                    <a href="../admin/detail_proposal.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; color: white; text-decoration: none;">
                      <i class="fas fa-check-double"></i> Review &amp; Plotting
                    </a>
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
