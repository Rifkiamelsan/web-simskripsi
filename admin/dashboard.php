<?php
/**
 * SCREEN 3 - DASHBOARD ADMIN
 * Sistem Informasi Skripsi Mahasiswa (SIMSKRIPSI)
 * Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['admin']);
$user = getAuthUser();

require_once dirname(__DIR__) . '/includes/sample_data.php';

$pageTitle = "Dashboard Admin - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'SIMSKRIPSI', 'url' => 'dashboard.php'],
    ['label' => 'Dashboard', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <!-- Header -->
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700;">Dashboard</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Selamat datang di Sistem Informasi Skripsi</p>
    </div>

    <!-- 4 Stat Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #2563eb; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">128</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Total Mahasiswa</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #16a34a; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-file-alt"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">86</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Proposal</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #f59e0b; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-chalkboard-teacher"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">45</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Sedang Bimbingan</div>
        </div>
      </div>

      <div class="stat-card" style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div class="stat-icon" style="width: 48px; height: 48px; border-radius: 10px; background: #dc2626; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <div>
          <div class="stat-number" style="font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1.1;">28</div>
          <div class="stat-label" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">Sidang Selesai</div>
        </div>
      </div>
    </div>

    <!-- Row: Status Proposal Chart & Aktivitas Terbaru -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
      <!-- Chart Card -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 16px;">Status Proposal</div>
        <div style="display: flex; align-items: center; justify-content: space-around; gap: 20px;">
          <!-- Canvas with Donut -->
          <div style="position: relative; width: 170px; height: 170px;">
            <canvas id="proposalChart"></canvas>
            <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; pointer-events: none;">
              <span style="font-size: 1.3rem; font-weight: 800; color: #0f172a;">128</span>
              <span style="font-size: 0.7rem; color: #64748b;">Proposal</span>
            </div>
          </div>
          <!-- Legend matching Mockup -->
          <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.82rem;">
            <div style="display: flex; align-items: center; gap: 8px;">
              <span style="width: 10px; height: 10px; border-radius: 50%; background: #2563eb; display: inline-block;"></span>
              <span style="color: #334155; min-width: 80px;">Diajukan</span>
              <strong style="color: #0f172a;">25</strong>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
              <span style="width: 10px; height: 10px; border-radius: 50%; background: #16a34a; display: inline-block;"></span>
              <span style="color: #334155; min-width: 80px;">Disetujui</span>
              <strong style="color: #0f172a;">40</strong>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
              <span style="width: 10px; height: 10px; border-radius: 50%; background: #f59e0b; display: inline-block;"></span>
              <span style="color: #334155; min-width: 80px;">Bimbingan</span>
              <strong style="color: #0f172a;">45</strong>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
              <span style="width: 10px; height: 10px; border-radius: 50%; background: #0284c7; display: inline-block;"></span>
              <span style="color: #334155; min-width: 80px;">Seminar</span>
              <strong style="color: #0f172a;">12</strong>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
              <span style="width: 10px; height: 10px; border-radius: 50%; background: #dc2626; display: inline-block;"></span>
              <span style="color: #334155; min-width: 80px;">Ditolak</span>
              <strong style="color: #0f172a;">6</strong>
            </div>
          </div>
        </div>
      </div>

      <!-- Aktivitas Terbaru Card -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
          <span style="font-size: 1rem; font-weight: 700; color: #0f172a;">Aktivitas Terbaru</span>
          <a href="#" style="font-size: 0.78rem; color: #2563eb; text-decoration: none; font-weight: 600;">Lihat Semua</a>
        </div>
        <div class="activity-list" style="display: flex; flex-direction: column; gap: 14px;">
          <div style="display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0;">
              <i class="fas fa-file-alt"></i>
            </div>
            <div style="flex: 1;">
              <div style="font-size: 0.84rem; color: #1e293b;"><strong style="font-weight: 600;">Andi Pratama</strong> mengajukan proposal</div>
              <div style="font-size: 0.72rem; color: #94a3b8; margin-top: 2px;">10 Okt 2026 08:15</div>
            </div>
          </div>

          <div style="display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #f0fdf4; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0;">
              <i class="fas fa-upload"></i>
            </div>
            <div style="flex: 1;">
              <div style="font-size: 0.84rem; color: #1e293b;"><strong style="font-weight: 600;">Siti Rahmawati</strong> mengunggah revisi</div>
              <div style="font-size: 0.72rem; color: #94a3b8; margin-top: 2px;">9 Okt 2026 14:20</div>
            </div>
          </div>

          <div style="display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0;">
              <i class="fas fa-check-circle"></i>
            </div>
            <div style="flex: 1;">
              <div style="font-size: 0.84rem; color: #1e293b;"><strong style="font-weight: 600;">Dosen</strong> menyetujui proposal</div>
              <div style="font-size: 0.72rem; color: #94a3b8; margin-top: 2px;">9 Okt 2026 10:05</div>
            </div>
          </div>

          <div style="display: flex; align-items: flex-start; gap: 12px;">
            <div style="width: 32px; height: 32px; border-radius: 8px; background: #fdf2f8; color: #db2777; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0;">
              <i class="fas fa-calendar-check"></i>
            </div>
            <div style="flex: 1;">
              <div style="font-size: 0.84rem; color: #1e293b;"><strong style="font-weight: 600;">Jadwal seminar</strong> ditambahkan</div>
              <div style="font-size: 0.72rem; color: #94a3b8; margin-top: 2px;">8 Okt 2026 16:30</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Proposal Terbaru Table Card -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
        <span style="font-size: 1rem; font-weight: 700; color: #0f172a;">Proposal Terbaru</span>
        <a href="proposal.php" style="font-size: 0.78rem; color: #2563eb; text-decoration: none; font-weight: 600;">Lihat Semua</a>
      </div>
      <div class="table-wrapper">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left;">
              <th style="padding: 10px 12px; color: #64748b; font-weight: 600; width: 45px;">No</th>
              <th style="padding: 10px 12px; color: #64748b; font-weight: 600;">Nama</th>
              <th style="padding: 10px 12px; color: #64748b; font-weight: 600;">Judul Proposal</th>
              <th style="padding: 10px 12px; color: #64748b; font-weight: 600;">Prodi</th>
              <th style="padding: 10px 12px; color: #64748b; font-weight: 600;">Status</th>
              <th style="padding: 10px 12px; color: #64748b; font-weight: 600;">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 12px;">1</td>
              <td style="padding: 12px; font-weight: 600;">Andi Pratama</td>
              <td style="padding: 12px; color: #334155;">Analisis Sistem Informasi Manajemen Rumah Sakit...</td>
              <td style="padding: 12px; color: #64748b;">Manajemen</td>
              <td style="padding: 12px;"><span class="badge badge-diajukan">Diajukan</span></td>
              <td style="padding: 12px; color: #64748b;">10-10-2026</td>
            </tr>
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 12px;">2</td>
              <td style="padding: 12px; font-weight: 600;">Siti Rahmawati</td>
              <td style="padding: 12px; color: #334155;">Implementasi Web Service dan Web Semantik pada Sistem...</td>
              <td style="padding: 12px; color: #64748b;">TI</td>
              <td style="padding: 12px;"><span class="badge badge-disetujui">Disetujui</span></td>
              <td style="padding: 12px; color: #64748b;">09-10-2026</td>
            </tr>
            <tr>
              <td style="padding: 12px;">3</td>
              <td style="padding: 12px; font-weight: 600;">Budi Santoso</td>
              <td style="padding: 12px; color: #334155;">Pengaruh Digital Marketing terhadap Keputusan Pembelian...</td>
              <td style="padding: 12px; color: #64748b;">Manajemen</td>
              <td style="padding: 12px;"><span class="badge badge-bimbingan">Bimbingan</span></td>
              <td style="padding: 12px; color: #64748b;">08-10-2026</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
  // Render Chart Status Proposal
  const ctx = document.getElementById('proposalChart');
  if (ctx) {
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Diajukan', 'Disetujui', 'Bimbingan', 'Seminar', 'Ditolak'],
        datasets: [{
          data: [25, 40, 45, 12, 6],
          backgroundColor: ['#2563eb', '#16a34a', '#f59e0b', '#0284c7', '#dc2626'],
          borderWidth: 0,
          cutout: '72%'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: function(ctx) { return ' ' + ctx.label + ': ' + ctx.raw + ' Proposal'; }
            }
          }
        }
      }
    });
  }
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
