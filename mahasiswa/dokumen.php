<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['mahasiswa', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$pageTitle = "Dokumen Skripsi - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Dokumen', 'url' => '']
];

$docs = [
    ['name' => 'Buku Panduan Skripsi 2026.pdf', 'size' => '4.2 MB', 'cat' => 'Panduan Resmi'],
    ['name' => 'Template Proposal Skripsi TI.docx', 'size' => '540 KB', 'cat' => 'Format Penulisan'],
    ['name' => 'Lembar Persetujuan Pembimbing.docx', 'size' => '120 KB', 'cat' => 'Administrasi'],
    ['name' => 'Kartu Logbook Bimbingan.pdf', 'size' => '250 KB', 'cat' => 'Logbook'],
    ['name' => 'Formulir Pendaftaran Seminar Proposal.pdf', 'size' => '180 KB', 'cat' => 'Formulir'],
    ['name' => 'Surat Bebas Pustaka Perpustakaan.pdf', 'size' => '110 KB', 'cat' => 'Syarat Kelulusan']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Pusat Dokumen &amp; Template Skripsi</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Unduh template resmi, panduan penyusunan naskah, dan formulir administrasi</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
      <?php foreach ($docs as $d): ?>
        <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px; display: flex; flex-direction: column; justify-content: space-between;">
          <div style="display: flex; align-items: flex-start; gap: 14px; margin-bottom: 16px;">
            <div style="width: 44px; height: 44px; border-radius: 10px; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
              <i class="fas fa-file-pdf"></i>
            </div>
            <div>
              <div style="font-weight: 700; color: #0f172a; font-size: 0.88rem; line-height: 1.3; margin-bottom: 4px;"><?= htmlspecialchars($d['name']) ?></div>
              <div style="font-size: 0.75rem; color: #64748b;"><?= $d['cat'] ?> &bull; <?= $d['size'] ?></div>
            </div>
          </div>
          <button onclick="showToast('Mengunduh <?= $d['name'] ?>...', 'success')" class="btn btn-outline" style="width: 100%; justify-content: center; font-size: 0.8rem; padding: 8px;">
            <i class="fas fa-download"></i> Unduh Berkas
          </button>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>