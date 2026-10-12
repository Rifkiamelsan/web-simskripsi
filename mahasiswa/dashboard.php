<?php
/**
 * SCREEN 6 - DASHBOARD MAHASISWA
 * Sistem Informasi Skripsi Mahasiswa (SIMSKRIPSI)
 * Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['mahasiswa', 'admin']);
$user = getAuthUser();

$mhsName = ($user['role'] === 'mahasiswa' && !empty($user['nama'])) ? $user['nama'] : 'Siti Rahmawati';
$mhsNpm  = $_SESSION['simskripsi_nim'] ?? '221010002';

require_once dirname(__DIR__) . '/includes/sample_data.php';
$proposal = getProposalByMahasiswa($mhsNpm);

$pageTitle = "Dashboard Mahasiswa - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'SIMSKRIPSI', 'url' => 'dashboard.php'],
    ['label' => 'Dashboard Mahasiswa', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <!-- Header -->
    <div class="page-header" style="margin-bottom: 24px;">
      <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Dashboard Mahasiswa</h1>
      <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Selamat datang, <strong><?= htmlspecialchars($mhsName) ?></strong></p>
    </div>

    <!-- Status Skripsi Saya (Horizontal Step Progress Tracker) -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); margin-bottom: 24px;">
      <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 20px;">
        Status Skripsi Saya
      </div>

      <div class="horizontal-stepper">
        <!-- Step 1: Diajukan -->
        <div class="step-node completed">
          <div class="step-circle" style="background: #0ea5e9; color: white;">
            <i class="fas fa-check" style="font-size: 0.75rem;"></i>
          </div>
          <div class="step-node-title">Diajukan</div>
          <div class="step-node-date">01-10-2026</div>
        </div>

        <!-- Step 2: Disetujui -->
        <div class="step-node completed">
          <div class="step-circle" style="background: #0ea5e9; color: white;">
            <i class="fas fa-check" style="font-size: 0.75rem;"></i>
          </div>
          <div class="step-node-title">Disetujui</div>
          <div class="step-node-date">03-10-2026</div>
        </div>

        <!-- Step 3: Bimbingan -->
        <div class="step-node active">
          <div class="step-circle" style="background: #0284c7; color: white;">
            <i class="fas fa-circle" style="font-size: 0.5rem;"></i>
          </div>
          <div class="step-node-title" style="color: #0284c7;">Bimbingan</div>
          <div class="step-node-date" style="color: #0284c7; font-weight: 600;">Sedang berjalan</div>
        </div>

        <!-- Step 4: Seminar -->
        <div class="step-node">
          <div class="step-circle" style="background: #f1f5f9; color: #94a3b8;">4</div>
          <div class="step-node-title" style="color: #64748b;">Seminar</div>
          <div class="step-node-date">-</div>
        </div>

        <!-- Step 5: Sidang -->
        <div class="step-node">
          <div class="step-circle" style="background: #f1f5f9; color: #94a3b8;">5</div>
          <div class="step-node-title" style="color: #64748b;">Sidang</div>
          <div class="step-node-date">-</div>
        </div>

        <!-- Step 6: Selesai -->
        <div class="step-node">
          <div class="step-circle" style="background: #f1f5f9; color: #94a3b8;">6</div>
          <div class="step-node-title" style="color: #64748b;">Selesai</div>
          <div class="step-node-date">-</div>
        </div>
      </div>
    </div>

    <!-- 2 Columns: Informasi Proposal & Menu Cepat -->
    <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 20px;">
      
      <!-- Card Informasi Proposal -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
          Informasi Proposal
        </div>
        
        <table class="info-table" style="width: 100%; border-collapse: collapse;">
          <tbody>
            <tr>
              <td style="width: 150px; padding: 10px 0; color: #64748b; font-size: 0.86rem; vertical-align: top;">Judul</td>
              <td style="width: 20px; padding: 10px 0; color: #64748b; vertical-align: top;">:</td>
              <td style="padding: 10px 0; font-weight: 600; color: #0f172a; font-size: 0.88rem; line-height: 1.5;">
                <?= htmlspecialchars($proposal['judul']) ?>
              </td>
            </tr>
            <tr>
              <td style="padding: 10px 0; color: #64748b; font-size: 0.86rem;">Dosen Pembimbing</td>
              <td style="padding: 10px 0; color: #64748b;">:</td>
              <td style="padding: 10px 0; font-weight: 600; color: #0284c7; font-size: 0.88rem;">
                <?= htmlspecialchars($proposal['dosen']) ?>
              </td>
            </tr>
            <tr>
              <td style="padding: 10px 0; color: #64748b; font-size: 0.86rem;">Program Studi</td>
              <td style="padding: 10px 0; color: #64748b;">:</td>
              <td style="padding: 10px 0; font-weight: 600; color: #0f172a; font-size: 0.88rem;">
                Teknik Informatika
              </td>
            </tr>
            <tr>
              <td style="padding: 10px 0; color: #64748b; font-size: 0.86rem;">Tanggal Pengajuan</td>
              <td style="padding: 10px 0; color: #64748b;">:</td>
              <td style="padding: 10px 0; font-weight: 600; color: #0f172a; font-size: 0.88rem;">
                01 Oktober 2026
              </td>
            </tr>
            <tr>
              <td style="padding: 10px 0; color: #64748b; font-size: 0.86rem;">Status</td>
              <td style="padding: 10px 0; color: #64748b;">:</td>
              <td style="padding: 10px 0;">
                <span class="badge badge-bimbingan">Bimbingan</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Card Menu Cepat -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
          Menu Cepat
        </div>

        <div style="display: flex; flex-direction: column; gap: 12px;">
          <!-- 1: Lihat Proposal Saya -->
          <a href="../admin/detail_proposal.php?id=2" class="quick-menu-card">
            <div class="quick-menu-icon" style="background: #eff6ff; color: #2563eb;">
              <i class="fas fa-file-alt"></i>
            </div>
            <div style="flex: 1;">
              <div style="font-size: 0.88rem; font-weight: 600; color: #0f172a;">Lihat Proposal Saya</div>
              <div style="font-size: 0.75rem; color: #64748b;">Detail naskah dan status persetujuan</div>
            </div>
            <i class="fas fa-chevron-right" style="color: #94a3b8; font-size: 0.8rem;"></i>
          </a>

          <!-- 2: Catatan Bimbingan -->
          <a href="../admin/detail_proposal.php?id=2#tab-bimbingan" class="quick-menu-card">
            <div class="quick-menu-icon" style="background: #f0fdf4; color: #16a34a;">
              <i class="fas fa-comments"></i>
            </div>
            <div style="flex: 1;">
              <div style="font-size: 0.88rem; font-weight: 600; color: #0f172a;">Catatan Bimbingan</div>
              <div style="font-size: 0.75rem; color: #64748b;">Lihat arahan &amp; revisi dari dosen</div>
            </div>
            <i class="fas fa-chevron-right" style="color: #94a3b8; font-size: 0.8rem;"></i>
          </a>

          <!-- 3: Upload Revisi -->
          <a href="#" onclick="openModalUpload(); return false;" class="quick-menu-card">
            <div class="quick-menu-icon" style="background: #fff7ed; color: #ea580c;">
              <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <div style="flex: 1;">
              <div style="font-size: 0.88rem; font-weight: 600; color: #0f172a;">Upload Revisi</div>
              <div style="font-size: 0.75rem; color: #64748b;">Kirim berkas draft bab perbaikan</div>
            </div>
            <i class="fas fa-chevron-right" style="color: #94a3b8; font-size: 0.8rem;"></i>
          </a>

          <!-- 4: Jadwal Seminar -->
          <a href="#" onclick="openModalJadwal(); return false;" class="quick-menu-card">
            <div class="quick-menu-icon" style="background: #faf5ff; color: #9333ea;">
              <i class="fas fa-calendar-alt"></i>
            </div>
            <div style="flex: 1;">
              <div style="font-size: 0.88rem; font-weight: 600; color: #0f172a;">Jadwal Seminar</div>
              <div style="font-size: 0.75rem; color: #64748b;">Lihat jadwal seminar proposal &amp; sidang</div>
            </div>
            <i class="fas fa-chevron-right" style="color: #94a3b8; font-size: 0.8rem;"></i>
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- Modal 1: Upload Revisi -->
  <div class="modal-overlay" id="modalUpload">
    <div class="modal-box">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-cloud-upload-alt" style="color:#ea580c;margin-right:8px;"></i> Unggah Berkas Revisi Skripsi</h3>
        <button class="modal-close" onclick="closeModalUpload()">&times;</button>
      </div>
      <form onsubmit="handleUploadSubmit(event)">
        <div class="form-group">
          <label class="form-label">Bab / Bagian Revisi</label>
          <select id="uploadBab" class="form-control" required>
            <option value="Bab 1 - Pendahuluan">Bab 1 - Pendahuluan</option>
            <option value="Bab 2 - Tinjauan Pustaka">Bab 2 - Tinjauan Pustaka</option>
            <option value="Bab 3 - Metodologi" selected>Bab 3 - Metodologi</option>
            <option value="Bab 1-3 Full Proposal">Bab 1-3 Full Proposal</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Catatan Tambahan untuk Dosen Pembimbing</label>
          <textarea id="uploadCatatan" class="form-control" rows="3" placeholder="Tuliskan ringkasan perbaikan atau pertanyaan kepada dosen..."></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Pilih Dokumen (PDF, max 10MB)</label>
          <input type="file" id="uploadFile" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalUpload()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background: #0284c7;">Unggah Sekarang</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal 2: Jadwal Seminar & Sidang (REAL WORKING MODAL) -->
  <div class="modal-overlay" id="modalJadwal">
    <div class="modal-box" style="max-width: 600px;">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-calendar-alt" style="color:#9333ea;margin-right:8px;"></i> Informasi Jadwal Seminar Proposal</h3>
        <button class="modal-close" onclick="closeModalJadwal()">&times;</button>
      </div>
      <div style="background: #faf5ff; border: 1px solid #f3e8ff; border-radius: 10px; padding: 18px; margin-bottom: 16px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <strong style="color: #6b21a8; font-size: 0.95rem;">Seminar Proposal Skripsi</strong>
          <span class="badge badge-seminar">Dijadwalkan</span>
        </div>
        <table class="info-table" style="width: 100%;">
          <tr>
            <td style="width: 140px; color: #64748b; font-size: 0.85rem;">Tanggal</td>
            <td style="font-weight: 600; color: #0f172a; font-size: 0.85rem;"><i class="fas fa-calendar-day" style="color:#9333ea;"></i> 25 Oktober 2026</td>
          </tr>
          <tr>
            <td style="color: #64748b; font-size: 0.85rem;">Waktu</td>
            <td style="font-weight: 600; color: #0f172a; font-size: 0.85rem;"><i class="fas fa-clock" style="color:#9333ea;"></i> 09:30 - 11:30 WIB</td>
          </tr>
          <tr>
            <td style="color: #64748b; font-size: 0.85rem;">Ruangan</td>
            <td style="font-weight: 600; color: #0f172a; font-size: 0.85rem;"><i class="fas fa-map-marker-alt" style="color:#9333ea;"></i> Ruang Seminar Fakultas Teknik Lt. 2</td>
          </tr>
          <tr>
            <td style="color: #64748b; font-size: 0.85rem;">Dosen Pembimbing</td>
            <td style="font-weight: 600; color: #2563eb; font-size: 0.85rem;">Dr. Ahmad, M.Kom</td>
          </tr>
          <tr>
            <td style="color: #64748b; font-size: 0.85rem;">Dosen Penguji</td>
            <td style="font-weight: 600; color: #0f172a; font-size: 0.85rem;">Prof. Dr. Ir. Hendra, M.T &bull; Dr. Budi Santoso, M.M</td>
          </tr>
        </table>
      </div>
      <div style="font-size: 0.8rem; color: #64748b; line-height: 1.5; margin-bottom: 20px;">
        <i class="fas fa-info-circle" style="color: #0284c7;"></i> Harap hadir 15 menit sebelum acara dan menyiapkan slide presentasi serta naskah proposal rangkap 3.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" style="background: #9333ea;" onclick="closeModalJadwal()">Tutup</button>
      </div>
    </div>
  </div>

  <script>
  function openModalUpload() { document.getElementById('modalUpload').classList.add('open'); }
  function closeModalUpload() { document.getElementById('modalUpload').classList.remove('open'); }
  function handleUploadSubmit(e) {
    e.preventDefault();
    const bab = document.getElementById('uploadBab').value;
    closeModalUpload();
    showToast(`Berkas <strong>${bab}</strong> berhasil diunggah! Dosen pembimbing akan segera menerima notifikasi.`, 'success');
  }

  function openModalJadwal() { document.getElementById('modalJadwal').classList.add('open'); }
  function closeModalJadwal() { document.getElementById('modalJadwal').classList.remove('open'); }
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>