<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['mahasiswa', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$mhsNpm = $_SESSION['simskripsi_nim'] ?? '221010002';
$proposal = getProposalByMahasiswa($mhsNpm);

$pageTitle = "Proposal Saya - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Proposal Saya', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Proposal Skripsi Saya</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Informasi usulan judul, pembimbing, dan berkas naskah proposal Anda</p>
      </div>
      <a href="../admin/detail_proposal.php?id=2" class="btn btn-primary" style="background: #0284c7; padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; color: white; text-decoration: none;">
        <i class="fas fa-search"></i> Buka Lembar Bimbingan
      </a>
    </div>

    <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 20px;">
      <!-- Card Detail -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px;">
        <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
          Naskah &amp; Usulan Judul
        </div>
        <table class="info-table" style="width: 100%;">
          <tr>
            <td style="width: 140px; color: #64748b; font-size: 0.86rem;">Judul Skripsi</td>
            <td style="font-weight: 600; color: #0f172a; font-size: 0.92rem; line-height: 1.5;"><?= htmlspecialchars($proposal['judul']) ?></td>
          </tr>
          <tr>
            <td style="color: #64748b; font-size: 0.86rem;">Bidang Kajian</td>
            <td style="font-weight: 600; color: #0284c7;">Web Service &amp; Web Semantik</td>
          </tr>
          <tr>
            <td style="color: #64748b; font-size: 0.86rem;">Dosen Pembimbing</td>
            <td style="font-weight: 600; color: #2563eb;"><?= htmlspecialchars($proposal['dosen']) ?></td>
          </tr>
          <tr>
            <td style="color: #64748b; font-size: 0.86rem;">Tanggal Pengajuan</td>
            <td style="font-weight: 600; color: #0f172a;">01 Oktober 2026</td>
          </tr>
          <tr>
            <td style="color: #64748b; font-size: 0.86rem;">Status Terkini</td>
            <td><span class="badge badge-bimbingan">Sedang Bimbingan Bab 3</span></td>
          </tr>
        </table>
      </div>

      <!-- Card Berkas Naskah -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px;">
        <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
          Berkas Proposal Terunggah
        </div>
        <div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
          <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-file-pdf" style="font-size: 2rem; color: #dc2626;"></i>
            <div>
              <div style="font-weight: 600; font-size: 0.86rem;">Draft_Proposal_SitiRahmawati.pdf</div>
              <div style="font-size: 0.74rem; color: #64748b;">1.8 MB &bull; Diperbarui 09-10-2026</div>
            </div>
          </div>
          <button onclick="showToast('Mengunduh draft proposal...', 'info')" class="btn btn-sm btn-outline"><i class="fas fa-download"></i></button>
        </div>

        <div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; display: flex; align-items: center; justify-content: space-between;">
          <div style="display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-file-pdf" style="font-size: 2rem; color: #16a34a;"></i>
            <div>
              <div style="font-weight: 600; font-size: 0.86rem;">Lembar_Persetujuan_Judul.pdf</div>
              <div style="font-size: 0.74rem; color: #64748b;">420 KB &bull; Disetujui Kaprodi TI</div>
            </div>
          </div>
          <button onclick="showToast('Mengunduh lembar persetujuan...', 'info')" class="btn btn-sm btn-outline"><i class="fas fa-download"></i></button>
        </div>
      </div>
    </div>
  </div>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>