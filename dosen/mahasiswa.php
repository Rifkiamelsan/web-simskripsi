<?php
/**
 * DOSEN - DAFTAR MAHASISWA BIMBINGAN
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['dosen', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$dosenName = ($user['role'] === 'dosen' && !empty($user['nama'])) ? $user['nama'] : 'Dr. Ahmad, M.Kom';
$proposals = getProposalList();

$pageTitle = "Mahasiswa Bimbingan - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Mahasiswa Bimbingan', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Mahasiswa Bimbingan</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Data mahasiswa yang berada di bawah bimbingan Anda</p>
    </div>

    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      <div class="table-wrapper">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #fafafa;">
              <th style="padding: 12px 14px;">NPM</th>
              <th style="padding: 12px 14px;">Nama Mahasiswa</th>
              <th style="padding: 12px 14px;">Program Studi</th>
              <th style="padding: 12px 14px; width: 35%;">Judul Skripsi</th>
              <th style="padding: 12px 14px;">Status</th>
              <th style="padding: 12px 14px; text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 14px; color: #64748b;">221010002</td>
              <td style="padding: 14px; font-weight: 600; color: #0f172a;">Siti Rahmawati</td>
              <td style="padding: 14px; color: #64748b;">Teknik Informatika</td>
              <td style="padding: 14px; color: #334155; line-height: 1.4;">Implementasi Web Service dan Web Semantik pada Sistem Informasi Akademik</td>
              <td style="padding: 14px;"><span class="badge badge-bimbingan">Bimbingan</span></td>
              <td style="padding: 14px; text-align: center;">
                <a href="../admin/detail_proposal.php?id=2" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; color: white; text-decoration: none;">
                  <i class="fas fa-eye"></i> Detail
                </a>
              </td>
            </tr>
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 14px; color: #64748b;">221010005</td>
              <td style="padding: 14px; font-weight: 600; color: #0f172a;">Rizky Maulana</td>
              <td style="padding: 14px; color: #64748b;">Teknik Informatika</td>
              <td style="padding: 14px; color: #334155; line-height: 1.4;">Implementasi Web Semantik untuk Pencarian Repositori Karya Ilmiah</td>
              <td style="padding: 14px;"><span class="badge badge-ditolak">Perlu Revisi</span></td>
              <td style="padding: 14px; text-align: center;">
                <a href="../admin/detail_proposal.php?id=5" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; color: white; text-decoration: none;">
                  <i class="fas fa-eye"></i> Detail
                </a>
              </td>
            </tr>
            <tr>
              <td style="padding: 14px; color: #64748b;">221010006</td>
              <td style="padding: 14px; font-weight: 600; color: #0f172a;">Fajar Nugraha</td>
              <td style="padding: 14px; color: #64748b;">Sistem Informasi</td>
              <td style="padding: 14px; color: #334155; line-height: 1.4;">Audit Tata Kelola Teknologi Informasi Menggunakan Framework COBIT 2019</td>
              <td style="padding: 14px;"><span class="badge badge-sidang">Sidang Selesai</span></td>
              <td style="padding: 14px; text-align: center;">
                <a href="../admin/detail_proposal.php?id=6" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; color: white; text-decoration: none;">
                  <i class="fas fa-eye"></i> Detail
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>