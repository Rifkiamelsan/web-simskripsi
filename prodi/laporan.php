<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['prodi', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';
$proposals = getProposalList();
$pageTitle = "Laporan - SIMSKRIPSI UMB";
$breadcrumb = [['label' => 'Dashboard', 'url' => 'dashboard.php'], ['label' => 'Laporan', 'url' => '']];
require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;">
      <div>
        <h1 style="font-size:1.4rem;font-weight:700;color:#0f172a;">Laporan Akademik Skripsi</h1>
        <p style="color:#64748b;font-size:0.88rem;margin-top:4px;">Rekap statistik dan progres skripsi mahasiswa Teknik Informatika</p>
      </div>
      <button onclick="showToast('Laporan sedang diekspor ke PDF...','info')" style="background:#0284c7;padding:10px 18px;border-radius:8px;font-weight:600;font-size:0.85rem;color:white;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;">
        <i class="fas fa-file-pdf"></i> Export PDF
      </button>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
      <div style="background:white;border-radius:12px;padding:20px;border:1px solid #e2e8f0;text-align:center;">
        <div style="font-size:2rem;font-weight:800;color:#0284c7;"><?= count($proposals) ?></div>
        <div style="font-size:0.8rem;color:#64748b;margin-top:4px;">Total Mahasiswa Aktif</div>
      </div>
      <div style="background:white;border-radius:12px;padding:20px;border:1px solid #e2e8f0;text-align:center;">
        <div style="font-size:2rem;font-weight:800;color:#f59e0b;">3</div>
        <div style="font-size:0.8rem;color:#64748b;margin-top:4px;">Sedang Bimbingan</div>
      </div>
      <div style="background:white;border-radius:12px;padding:20px;border:1px solid #e2e8f0;text-align:center;">
        <div style="font-size:2rem;font-weight:800;color:#10b981;">2</div>
        <div style="font-size:0.8rem;color:#64748b;margin-top:4px;">Lulus Seminar</div>
      </div>
      <div style="background:white;border-radius:12px;padding:20px;border:1px solid #e2e8f0;text-align:center;">
        <div style="font-size:2rem;font-weight:800;color:#16a34a;">1</div>
        <div style="font-size:0.8rem;color:#64748b;margin-top:4px;">Lulus Sidang</div>
      </div>
    </div>
    <div class="card" style="background:white;border-radius:12px;border:1px solid #e2e8f0;padding:22px;box-shadow:0 2px 10px rgba(0,0,0,0.03);">
      <div style="font-weight:700;color:#0f172a;font-size:0.95rem;margin-bottom:16px;">Rekap Status Skripsi per Mahasiswa</div>
      <div class="table-wrapper">
        <table style="width:100%;border-collapse:collapse;font-size:0.86rem;">
          <thead>
            <tr style="border-bottom:2px solid #f1f5f9;text-align:left;background:#fafafa;">
              <th style="padding:12px 14px;">No</th>
              <th style="padding:12px 14px;">NPM</th>
              <th style="padding:12px 14px;">Nama Mahasiswa</th>
              <th style="padding:12px 14px;width:30%;">Judul Skripsi</th>
              <th style="padding:12px 14px;">Dosen Pembimbing</th>
              <th style="padding:12px 14px;">Log Bimbingan</th>
              <th style="padding:12px 14px;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($proposals as $p): ?>
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px;color:#64748b;"><?= $no++ ?></td>
              <td style="padding:14px;color:#64748b;"><?= htmlspecialchars($p['npm']) ?></td>
              <td style="padding:14px;font-weight:600;color:#0f172a;"><?= htmlspecialchars($p['nama']) ?></td>
              <td style="padding:14px;color:#334155;line-height:1.4;font-size:0.82rem;"><?= htmlspecialchars($p['judul']) ?></td>
              <td style="padding:14px;color:#2563eb;font-weight:500;"><?= htmlspecialchars($p['dosen']) ?></td>
              <td style="padding:14px;text-align:center;font-weight:700;color:#0284c7;"><?= rand(2,9) ?>x</td>
              <td style="padding:14px;"><span class="badge badge-bimbingan"><?= htmlspecialchars($p['status']) ?></span></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:20px;">
      <div class="card" style="background:white;border-radius:12px;border:1px solid #e2e8f0;padding:22px;">
        <div style="font-weight:700;color:#0f172a;font-size:0.95rem;margin-bottom:16px;">Distribusi Status Skripsi</div>
        <div style="display:flex;flex-direction:column;gap:12px;">
          <div><div style="display:flex;justify-content:space-between;font-size:0.82rem;margin-bottom:4px;"><span>Bimbingan Aktif</span><span style="font-weight:700;">3 mhs (50%)</span></div><div style="height:8px;background:#e2e8f0;border-radius:4px;"><div style="height:100%;width:50%;background:#0284c7;border-radius:4px;"></div></div></div>
          <div><div style="display:flex;justify-content:space-between;font-size:0.82rem;margin-bottom:4px;"><span>Siap / Lulus Seminar</span><span style="font-weight:700;">2 mhs (33%)</span></div><div style="height:8px;background:#e2e8f0;border-radius:4px;"><div style="height:100%;width:33%;background:#10b981;border-radius:4px;"></div></div></div>
          <div><div style="display:flex;justify-content:space-between;font-size:0.82rem;margin-bottom:4px;"><span>Lulus Sidang</span><span style="font-weight:700;">1 mhs (17%)</span></div><div style="height:8px;background:#e2e8f0;border-radius:4px;"><div style="height:100%;width:17%;background:#16a34a;border-radius:4px;"></div></div></div>
        </div>
      </div>
      <div class="card" style="background:white;border-radius:12px;border:1px solid #e2e8f0;padding:22px;">
        <div style="font-weight:700;color:#0f172a;font-size:0.95rem;margin-bottom:16px;">Info Semester Aktif</div>
        <div style="display:flex;flex-direction:column;gap:10px;font-size:0.86rem;">
          <div style="display:flex;justify-content:space-between;padding:10px;background:#f8fafc;border-radius:8px;"><span style="color:#64748b;">Semester</span><span style="font-weight:600;">Ganjil 2026/2027</span></div>
          <div style="display:flex;justify-content:space-between;padding:10px;background:#f8fafc;border-radius:8px;"><span style="color:#64748b;">Program Studi</span><span style="font-weight:600;">Teknik Informatika</span></div>
          <div style="display:flex;justify-content:space-between;padding:10px;background:#f8fafc;border-radius:8px;"><span style="color:#64748b;">Kaprodi</span><span style="font-weight:600;">Dr. Ir. Ahmad, M.Kom</span></div>
          <div style="display:flex;justify-content:space-between;padding:10px;background:#f8fafc;border-radius:8px;"><span style="color:#64748b;">Batas Naskah</span><span style="font-weight:600;color:#dc2626;">30 November 2026</span></div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
</main>
