<?php
/**
 * DOSEN - HALAMAN BIMBINGAN SKRIPSI
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['dosen', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$dosenName = ($user['role'] === 'dosen' && !empty($user['nama'])) ? $user['nama'] : 'Dr. Ahmad, M.Kom';
$proposals = getProposalList();

$pageTitle = "Bimbingan Mahasiswa - SIMSKRIPSI UMB";
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
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Bimbingan Skripsi</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Kelola dan verifikasi catatan konsultasi bimbingan mahasiswa Anda</p>
    </div>

    <!-- Card Filter & Stats -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 20px;">
      <div class="stat-card" style="background: white; border-radius: 12px; padding: 18px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 44px; height: 44px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
          <i class="fas fa-user-friends"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.4rem; font-weight: 800; color: #0f172a;">5</div>
          <div class="stat-label" style="font-size: 0.75rem; color: #64748b;">Mahasiswa Aktif Bimbingan</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 18px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 44px; height: 44px; border-radius: 10px; background: #fff7ed; color: #ea580c; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
          <i class="fas fa-clock"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.4rem; font-weight: 800; color: #0f172a;">2</div>
          <div class="stat-label" style="font-size: 0.75rem; color: #64748b;">Menunggu Koreksi Revisi</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 18px; border: 1px solid #e2e8f0;">
        <div class="stat-icon" style="width: 44px; height: 44px; border-radius: 10px; background: #f0fdf4; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
          <i class="fas fa-check-double"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.4rem; font-weight: 800; color: #0f172a;">3</div>
          <div class="stat-label" style="font-size: 0.75rem; color: #64748b;">Disetujui Seminar Proposal</div>
        </div>
      </div>
    </div>

    <!-- Table Mahasiswa yang Dibimbing -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
        <span style="font-size: 1rem; font-weight: 700; color: #0f172a;">Daftar Mahasiswa Bimbingan</span>
        <span style="font-size: 0.8rem; color: #64748b;">Pembimbing: <strong><?= htmlspecialchars($dosenName) ?></strong></span>
      </div>

      <div class="table-wrapper">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #fafafa;">
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600;">NPM</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600;">Nama Mahasiswa</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600; width: 35%;">Judul Skripsi</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600;">Status Tahap</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600;">Log Terakhir</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600; text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 14px; color: #64748b;">221010002</td>
              <td style="padding: 14px; font-weight: 600; color: #0f172a;">Siti Rahmawati</td>
              <td style="padding: 14px; color: #334155; line-height: 1.4;">Implementasi Web Service dan Web Semantik pada Sistem Informasi Akademik</td>
              <td style="padding: 14px;"><span class="badge badge-bimbingan">Bimbingan Bab 3</span></td>
              <td style="padding: 14px; color: #64748b; font-size: 0.8rem;">08-10-2026 (Log #2)</td>
              <td style="padding: 14px; text-align: center;">
                <a href="../admin/detail_proposal.php?id=2" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 7px 14px; border-radius: 6px; font-size: 0.8rem; color: white; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                  <i class="fas fa-edit"></i> Buka Bimbingan
                </a>
              </td>
            </tr>
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 14px; color: #64748b;">221010005</td>
              <td style="padding: 14px; font-weight: 600; color: #0f172a;">Rizky Maulana</td>
              <td style="padding: 14px; color: #334155; line-height: 1.4;">Implementasi Web Semantik untuk Pencarian Repositori Karya Ilmiah</td>
              <td style="padding: 14px;"><span class="badge badge-revisi">Revisi Proposal</span></td>
              <td style="padding: 14px; color: #64748b; font-size: 0.8rem;">03-10-2026 (Log #1)</td>
              <td style="padding: 14px; text-align: center;">
                <a href="../admin/detail_proposal.php?id=5" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 7px 14px; border-radius: 6px; font-size: 0.8rem; color: white; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                  <i class="fas fa-edit"></i> Buka Bimbingan
                </a>
              </td>
            </tr>
            <tr>
              <td style="padding: 14px; color: #64748b;">221010006</td>
              <td style="padding: 14px; font-weight: 600; color: #0f172a;">Fajar Nugraha</td>
              <td style="padding: 14px; color: #334155; line-height: 1.4;">Audit Tata Kelola Teknologi Informasi Menggunakan Framework COBIT 2019</td>
              <td style="padding: 14px;"><span class="badge badge-sidang">Siap Sidang</span></td>
              <td style="padding: 14px; color: #64748b; font-size: 0.8rem;">01-10-2026 (Log #8)</td>
              <td style="padding: 14px; text-align: center;">
                <a href="../admin/detail_proposal.php?id=6" class="btn btn-sm btn-primary" style="background: #0284c7; padding: 7px 14px; border-radius: 6px; font-size: 0.8rem; color: white; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                  <i class="fas fa-edit"></i> Buka Bimbingan
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>