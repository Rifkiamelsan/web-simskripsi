<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['mahasiswa', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$bimbinganLogs = getMockBimbinganLogs(2);
$pageTitle = "Logbook Bimbingan - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Catatan Bimbingan', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Catatan Bimbingan Skripsi</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Dosen Pembimbing: <strong>Dr. Ahmad, M.Kom</strong> &bull; Minimal 8x Bimbingan</p>
      </div>
      <button class="btn btn-primary" onclick="openModalTambahBimbingan()" style="background: #0284c7; padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; color: white; border: none;">
        <i class="fas fa-plus"></i> Tambah Log Bimbingan
      </button>
    </div>

    <!-- Stat Progress -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px; margin-bottom: 20px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
        <span style="font-weight: 700; color: #0f172a; font-size: 0.9rem;">Progres Konsultasi Bimbingan (2 dari 8 Selesai)</span>
        <span style="font-weight: 700; color: #0284c7; font-size: 0.85rem;">25%</span>
      </div>
      <div style="height: 8px; background: #e2e8f0; border-radius: 4px; overflow: hidden;">
        <div style="height: 100%; width: 25%; background: #0284c7; border-radius: 4px;"></div>
      </div>
    </div>

    <!-- Table Logs -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px;">
      <div class="table-wrapper">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #fafafa;">
              <th style="padding: 12px 14px; width: 50px;">No</th>
              <th style="padding: 12px 14px; width: 130px;">Tanggal</th>
              <th style="padding: 12px 14px;">Catatan Arahan &amp; Hasil Konsultasi</th>
              <th style="padding: 12px 14px; width: 140px;">Lampiran</th>
              <th style="padding: 12px 14px; width: 100px;">Status</th>
            </tr>
          </thead>
          <tbody id="mhsLogTableBody">
            <?php foreach ($bimbinganLogs as $log): ?>
              <tr style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 14px; color: #64748b;"><?= $log['no'] ?></td>
                <td style="padding: 14px; color: #64748b; font-weight: 500;"><?= $log['tanggal'] ?></td>
                <td style="padding: 14px; color: #1e293b; line-height: 1.4;"><?= htmlspecialchars($log['catatan']) ?></td>
                <td style="padding: 14px;">
                  <span style="display: inline-flex; align-items: center; gap: 6px; background: #eff6ff; color: #2563eb; padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 500;">
                    <i class="fas fa-file-pdf"></i> <?= $log['file'] ?>
                  </span>
                </td>
                <td style="padding: 14px;">
                  <span class="badge <?= $log['status'] === 'Selesai' ? 'badge-disetujui' : 'badge-bimbingan' ?>"><?= $log['status'] ?></span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Log -->
  <div class="modal-overlay" id="modalTambahLog">
    <div class="modal-box">
      <div class="modal-header">
        <h3 class="modal-title">Tambah Log Bimbingan Baru</h3>
        <button class="modal-close" onclick="closeModalTambahLog()">&times;</button>
      </div>
      <form onsubmit="handleMhsAddLog(event)">
        <div class="form-group">
          <label class="form-label">Tanggal Konsultasi</label>
          <input type="date" id="mhsTgl" class="form-control" required value="<?= date('Y-m-d') ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Bab / Topik Bahasan</label>
          <input type="text" id="mhsTopik" class="form-control" required placeholder="Contoh: Bab 3 - Perancangan Ontologi &amp; RDF">
        </div>
        <div class="form-group">
          <label class="form-label">Uraian Catatan &amp; Saran Dosen</label>
          <textarea id="mhsCatatan" class="form-control" rows="3" required placeholder="Tuliskan arahan revisi dari Dr. Ahmad, M.Kom..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalTambahLog()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background: #0284c7;">Simpan Logbook</button>
        </div>
      </form>
    </div>
  </div>

  <script>
  function openModalTambahBimbingan() { document.getElementById('modalTambahLog').classList.add('open'); }
  function closeModalTambahLog() { document.getElementById('modalTambahLog').classList.remove('open'); }
  function handleMhsAddLog(e) {
    e.preventDefault();
    const tgl = document.getElementById('mhsTgl').value;
    const cat = document.getElementById('mhsCatatan').value;
    const tbody = document.getElementById('mhsLogTableBody');
    const no = tbody.children.length + 1;
    const tr = document.createElement('tr');
    tr.style.borderBottom = '1px solid #f1f5f9';
    tr.innerHTML = `
      <td style="padding: 14px; color: #64748b;">${no}</td>
      <td style="padding: 14px; color: #64748b; font-weight: 500;">${tgl}</td>
      <td style="padding: 14px; color: #1e293b; line-height: 1.4;">${cat}</td>
      <td style="padding: 14px;"><span style="background:#eff6ff;color:#2563eb;padding:4px 8px;border-radius:4px;font-size:0.8rem;"><i class="fas fa-file-pdf"></i> catatan${no}.pdf</span></td>
      <td style="padding: 14px;"><span class="badge badge-bimbingan">Menunggu Verifikasi</span></td>
    `;
    tbody.appendChild(tr);
    closeModalTambahLog();
    showToast('Log bimbingan baru berhasil disimpan!', 'success');
  }
  </script>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>