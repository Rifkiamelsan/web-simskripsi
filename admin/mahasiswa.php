<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$proposals = getProposalList();
$pageTitle = "Data Mahasiswa - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Mahasiswa', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Data Mahasiswa Skripsi</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Data induk mahasiswa tersinkronisasi otomatis dari <strong>db_universitas</strong></p>
      </div>
      <span class="badge badge-disetujui" style="padding: 8px 14px; font-size: 0.85rem;"><i class="fas fa-users"></i> 128 Mahasiswa Terdaftar</span>
    </div>

    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px;">
      <div class="table-wrapper">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #fafafa;">
              <th style="padding: 12px 14px;">No</th>
              <th style="padding: 12px 14px;">NPM</th>
              <th style="padding: 12px 14px;">Nama Mahasiswa</th>
              <th style="padding: 12px 14px;">Program Studi</th>
              <th style="padding: 12px 14px;">Dosen Pembimbing</th>
              <th style="padding: 12px 14px;">Status Skripsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($proposals as $p): ?>
              <tr style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 14px; color: #64748b;"><?= $no++ ?></td>
                <td style="padding: 14px; color: #64748b;"><?= htmlspecialchars($p['npm']) ?></td>
                <td style="padding: 14px; font-weight: 600; color: #0f172a;"><?= htmlspecialchars($p['nama']) ?></td>
                <td style="padding: 14px; color: #64748b;"><?= htmlspecialchars($p['prodi']) ?></td>
                <td style="padding: 14px; color: #2563eb;"><?= htmlspecialchars($p['dosen']) ?></td>
                <td style="padding: 14px;"><span class="badge badge-bimbingan"><?= htmlspecialchars($p['status']) ?></span></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>