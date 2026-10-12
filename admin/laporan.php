<?php
/**
 * ADMIN - LAPORAN & REKAPITULASI KELULUSAN SKRIPSI
 * SIMSKRIPSI Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$proposals = getProposalList();

$pageTitle = "Laporan & Statistik - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Laporan', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Laporan &amp; Rekapitulasi Skripsi</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Statistik kelulusan mahasiswa, distribusi nilai, dan durasi penyelesaian tugas akhir</p>
      </div>
      <div style="display: flex; gap: 10px;">
        <button onclick="window.print()" class="btn" style="background: white; border: 1px solid #cbd5e1; color: #475569; padding: 9px 16px; border-radius: 8px; font-weight: 600; font-size: 0.84rem; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
          <i class="fas fa-print"></i> Cetak Laporan
        </button>
        <button onclick="showToast('Data rekapitulasi skripsi berhasil diekspor ke Excel (.xlsx)', 'success')" class="btn" style="background: #10b981; color: white; padding: 9px 16px; border-radius: 8px; font-weight: 600; font-size: 0.84rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
          <i class="fas fa-file-excel"></i> Export Excel
        </button>
      </div>
    </div>

    <!-- Stat Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Total Usulan Masuk</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin-top: 4px;">128 Mahasiswa</div>
        <div style="font-size: 0.78rem; color: #64748b; margin-top: 6px;">Tahun Akademik 2026/2027</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Seminar Proposal Selesai</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #0284c7; margin-top: 4px;">42 Mahasiswa</div>
        <div style="font-size: 0.78rem; color: #0284c7; margin-top: 6px;">Lulus ujian sempro</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Lulus Sidang / Yudisium</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #16a34a; margin-top: 4px;">28 Sarjana</div>
        <div style="font-size: 0.78rem; color: #16a34a; margin-top: 6px;">Siap wisuda periode ini</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Rata-Rata Masa Studi</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #f59e0b; margin-top: 4px;">4.5 Bulan</div>
        <div style="font-size: 0.78rem; color: #f59e0b; margin-top: 6px;">Sejak pengajuan judul</div>
      </div>
    </div>

    <!-- Progress Breakdown Card -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px; margin-bottom: 24px;">
      <h3 style="font-size: 0.95rem; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Distribusi Tahapan Skripsi Mahasiswa</h3>
      <div style="display: flex; height: 14px; border-radius: 99px; overflow: hidden; margin-bottom: 12px; background: #e2e8f0;">
        <div style="width: 22%; background: #16a34a;" title="Lulus Sidang (22%)"></div>
        <div style="width: 33%; background: #0284c7;" title="Seminar Proposal (33%)"></div>
        <div style="width: 35%; background: #f59e0b;" title="Bimbingan Aktif (35%)"></div>
        <div style="width: 10%; background: #ef4444;" title="Revisi / Usulan (10%)"></div>
      </div>
      <div style="display: flex; gap: 20px; font-size: 0.8rem; color: #64748b; flex-wrap: wrap;">
        <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 10px; height: 10px; border-radius: 2px; background: #16a34a;"></span> Lulus Sidang (28)</span>
        <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 10px; height: 10px; border-radius: 2px; background: #0284c7;"></span> Seminar Proposal (42)</span>
        <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 10px; height: 10px; border-radius: 2px; background: #f59e0b;"></span> Bimbingan Logbook (45)</span>
        <span style="display: flex; align-items: center; gap: 6px;"><span style="width: 10px; height: 10px; border-radius: 2px; background: #ef4444;"></span> Usulan Baru / Revisi (13)</span>
      </div>
    </div>

    <!-- Rekapitulasi Table -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
        <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a;">Data Rekapitulasi Hasil Skripsi</h3>
        <span style="font-size: 0.82rem; color: #64748b;">Semester Ganjil 2026/2027</span>
      </div>

      <div class="table-wrapper" style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #f8fafc;">
              <th style="padding: 12px 14px; width: 45px; color: #475569;">No</th>
              <th style="padding: 12px 14px; color: #475569;">NPM</th>
              <th style="padding: 12px 14px; color: #475569;">Nama Mahasiswa</th>
              <th style="padding: 12px 14px; width: 30%; color: #475569;">Judul Skripsi</th>
              <th style="padding: 12px 14px; color: #475569;">Dosen Pembimbing</th>
              <th style="padding: 12px 14px; text-align: center; color: #475569;">Nilai Akhir</th>
              <th style="padding: 12px 14px; text-align: center; color: #475569;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach ($proposals as $p): 
                $nilai = '-';
                if ($p['status'] === 'Sidang' || $p['status'] === 'Disetujui') $nilai = '86.5 (A)';
                elseif ($p['status'] === 'Seminar') $nilai = '82.0 (A-)';
                
                $badgeClass = 'badge-diajukan';
                if ($p['status'] === 'Bimbingan') $badgeClass = 'badge-bimbingan';
                elseif ($p['status'] === 'Seminar') $badgeClass = 'badge-seminar';
                elseif ($p['status'] === 'Sidang') $badgeClass = 'badge-sidang';
                elseif ($p['status'] === 'Disetujui') $badgeClass = 'badge-disetujui';
                elseif ($p['status'] === 'Ditolak') $badgeClass = 'badge-ditolak';
            ?>
              <tr style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 14px; color: #64748b;"><?= $no++ ?></td>
                <td style="padding: 14px; color: #64748b;"><?= htmlspecialchars($p['npm']) ?></td>
                <td style="padding: 14px; font-weight: 700; color: #0f172a;"><?= htmlspecialchars($p['nama']) ?></td>
                <td style="padding: 14px; color: #334155; line-height: 1.4;"><?= htmlspecialchars($p['judul']) ?></td>
                <td style="padding: 14px; color: #0284c7; font-weight: 600;"><?= htmlspecialchars($p['dosen']) ?></td>
                <td style="padding: 14px; text-align: center; font-weight: 700; color: #16a34a;"><?= $nilai ?></td>
                <td style="padding: 14px; text-align: center;">
                  <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($p['status']) ?></span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <style>
    @media print {
      .sidebar, .topbar, .btn { display: none !important; }
      .main-content { margin: 0 !important; padding: 0 !important; width: 100% !important; }
      .card { border: 1px solid #ccc !important; box-shadow: none !important; }
    }
  </style>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
