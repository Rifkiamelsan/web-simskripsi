<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$proposals = getProposalList();
$pageTitle = "Monitoring Bimbingan - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Bimbingan', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Monitoring Bimbingan Skripsi</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Pantau progres konsultasi bimbingan mahasiswa dan dosen pembimbing</p>
    </div>

    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px;">
      <div class="table-wrapper">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #fafafa;">
              <th style="padding: 12px 14px;">NPM</th>
              <th style="padding: 12px 14px;">Nama Mahasiswa</th>
              <th style="padding: 12px 14px; width: 35%;">Judul Skripsi</th>
              <th style="padding: 12px 14px;">Dosen Pembimbing</th>
              <th style="padding: 12px 14px;">Status</th>
              <th style="padding: 12px 14px; text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($proposals as $p): ?>
              <tr style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 14px; color: #64748b;"><?= htmlspecialchars($p['npm']) ?></td>
                <td style="padding: 14px; font-weight: 600; color: #0f172a;"><?= htmlspecialchars($p['nama']) ?></td>
                <td style="padding: 14px; color: #334155; line-height: 1.4;"><?= htmlspecialchars($p['judul']) ?></td>
                <td style="padding: 14px; color: #2563eb; font-weight: 500;"><?= htmlspecialchars($p['dosen']) ?></td>
                <td style="padding: 14px;"><span class="badge badge-bimbingan"><?= htmlspecialchars($p['status']) ?></span></td>
                <td style="padding: 14px; text-align: center;">
                  <a href="detail_proposal.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; color: white; text-decoration: none;">
                    <i class="fas fa-eye"></i> Detail Log
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>