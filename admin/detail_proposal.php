<?php
/**
 * SCREEN 5 - DETAIL PROPOSAL DAN BIMBINGAN
 * Sistem Informasi Skripsi Mahasiswa (SIMSKRIPSI)
 * Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireLogin();
$user = getAuthUser();

require_once dirname(__DIR__) . '/includes/sample_data.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 2;
$proposal = getProposalById($id);
$bimbinganLogs = getMockBimbinganLogs($id);

$pageTitle = "Detail Proposal - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Proposal', 'url' => 'proposal.php'],
    ['label' => 'Detail Proposal', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <!-- Header with Top Actions -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Detail Proposal</h1>
        <div class="topbar-breadcrumb" style="margin-top: 4px;">
          <a href="dashboard.php" class="bc-link">Dashboard</a>
          <span class="bc-sep"><i class="fas fa-chevron-right"></i></span>
          <a href="proposal.php" class="bc-link">Proposal</a>
          <span class="bc-sep"><i class="fas fa-chevron-right"></i></span>
          <span class="bc-current">Detail Proposal</span>
        </div>
      </div>
      <div style="display: flex; gap: 8px; flex-wrap: wrap;">
        <a href="proposal.php" class="btn" style="background: #64748b; color: white; padding: 8px 16px; border-radius: 8px; font-size: 0.82rem; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 6px;">
          <i class="fas fa-chevron-left" style="font-size: 0.75rem;"></i> Kembali
        </a>
        <?php if (in_array($user['role'] ?? '', ['admin', 'prodi', 'dosen'])): ?>
        <button class="btn" onclick="openModalStatusCustom()" style="background: #0284c7; color: white; padding: 8px 16px; border-radius: 8px; font-size: 0.82rem; font-weight: 600; display: flex; align-items: center; gap: 6px; border: none;">
          <i class="fas fa-tasks" style="font-size: 0.75rem;"></i> Ubah Status Skripsi
        </button>
        <button class="btn" onclick="openModalEditDetail()" style="background: #16a34a; color: white; padding: 8px 16px; border-radius: 8px; font-size: 0.82rem; font-weight: 600; display: flex; align-items: center; gap: 6px; border: none;">
          <i class="fas fa-pen" style="font-size: 0.75rem;"></i> Edit Data
        </button>
        <?php endif; ?>
      </div>
    </div>

    <!-- Top Section: 2 Cards -->
    <div style="display: grid; grid-template-columns: 1.15fr 1fr; gap: 20px; margin-bottom: 24px;">
      
      <!-- Card Informasi Mahasiswa -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
        <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
          <span>Informasi Mahasiswa</span>
          <?php if (in_array($user['role'] ?? '', ['admin', 'prodi', 'dosen'])): ?>
          <button onclick="openModalEditDetail()" class="btn btn-sm btn-outline" style="padding: 4px 10px; font-size: 0.75rem;"><i class="fas fa-edit"></i> Edit</button>
          <?php endif; ?>
        </div>
        <table class="info-table" style="width: 100%; border-collapse: collapse;">
          <tbody>
            <tr>
              <td style="width: 140px; padding: 8px 0; color: #64748b; font-size: 0.86rem;">Nama</td>
              <td style="width: 20px; padding: 8px 0; color: #64748b;">:</td>
              <td id="viewNama" style="padding: 8px 0; font-weight: 600; color: #0f172a; font-size: 0.88rem;"><?= htmlspecialchars($proposal['nama']) ?></td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #64748b; font-size: 0.86rem;">NPM</td>
              <td style="padding: 8px 0; color: #64748b;">:</td>
              <td id="viewNpm" style="padding: 8px 0; font-weight: 600; color: #0f172a; font-size: 0.88rem;"><?= htmlspecialchars($proposal['npm']) ?></td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #64748b; font-size: 0.86rem;">Program Studi</td>
              <td style="padding: 8px 0; color: #64748b;">:</td>
              <td id="viewProdi" style="padding: 8px 0; font-weight: 600; color: #0f172a; font-size: 0.88rem;">Teknik Informatika</td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #64748b; font-size: 0.86rem; vertical-align: top;">Judul Proposal</td>
              <td style="padding: 8px 0; color: #64748b; vertical-align: top;">:</td>
              <td id="viewJudul" style="padding: 8px 0; font-weight: 600; color: #0f172a; font-size: 0.88rem; line-height: 1.5;"><?= htmlspecialchars($proposal['judul']) ?></td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #64748b; font-size: 0.86rem;">Dosen Pembimbing</td>
              <td style="padding: 8px 0; color: #64748b;">:</td>
              <td id="viewDosen" style="padding: 8px 0; font-weight: 600; color: #2563eb; font-size: 0.88rem;"><?= htmlspecialchars($proposal['dosen']) ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Card Status Proposal (Vertical Stepper + Action Control) -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); display: flex; flex-direction: column;">
        <div style="font-size: 1rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
          <span>Status Proposal</span>
          <span id="currentStatusBadge" class="badge badge-bimbingan">Sedang Bimbingan</span>
        </div>
        
        <!-- Interactive Vertical Stepper -->
        <div class="vertical-stepper" id="verticalStepper" style="flex: 1;">
          <!-- Rendered dynamically -->
        </div>

        <!-- Tombol Aksi Persetujuan Dosen / Kaprodi — HANYA untuk dosen, prodi, admin -->
        <?php if (in_array($user['role'] ?? '', ['admin', 'prodi', 'dosen'])): ?>
        <div style="margin-top: 18px; padding-top: 16px; border-top: 1.5px solid #f1f5f9;">
          <div style="font-size: 0.78rem; font-weight: 700; color: #64748b; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
            Aksi Keputusan Pembimbing / Penguji:
          </div>
          
          <div id="actionButtonContainer" style="display: flex; gap: 8px; flex-wrap: wrap;">
            <!-- Tombol 1: Setujui Maju Seminar Proposal -->
            <button type="button" class="btn btn-sm" id="btnMajuSeminar" onclick="setujuiMajuSeminar()" style="background: #10b981; color: white; padding: 8px 14px; border-radius: 8px; font-weight: 600; font-size: 0.82rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
              <i class="fas fa-check-double"></i> Setujui Maju Seminar Proposal
            </button>

            <!-- Tombol 2: Maju ke Sidang Skripsi -->
            <button type="button" class="btn btn-sm" id="btnMajuSidang" onclick="setujuiMajuSidang()" style="display: none; background: #0284c7; color: white; padding: 8px 14px; border-radius: 8px; font-weight: 600; font-size: 0.82rem; border: none; cursor: pointer; align-items: center; gap: 6px;">
              <i class="fas fa-gavel"></i> Setujui Maju Sidang Skripsi
            </button>

            <!-- Tombol 3: Nyatakan Lulus / Selesai -->
            <button type="button" class="btn btn-sm" id="btnSelesai" onclick="nyatakanSelesai()" style="display: none; background: #059669; color: white; padding: 8px 14px; border-radius: 8px; font-weight: 600; font-size: 0.82rem; border: none; cursor: pointer; align-items: center; gap: 6px;">
              <i class="fas fa-graduation-cap"></i> Nyatakan Lulus &amp; Selesai
            </button>

            <!-- Tombol Tolak / Revisi -->
            <button type="button" class="btn btn-sm" onclick="mintaRevisi()" style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 8px 14px; border-radius: 8px; font-weight: 600; font-size: 0.82rem; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
              <i class="fas fa-undo"></i> Minta Revisi
            </button>

            <!-- Tombol Tolak Total -->
            <button type="button" class="btn btn-sm" onclick="tolakProposal()" style="background: #ef4444; color: white; padding: 8px 14px; border-radius: 8px; font-weight: 600; font-size: 0.82rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
              <i class="fas fa-times-circle"></i> Tolak
            </button>
          </div>
        </div>
        <?php else: ?>
        <!-- Mahasiswa: hanya lihat status, tidak ada tombol aksi -->
        <div style="margin-top: 18px; padding-top: 16px; border-top: 1.5px solid #f1f5f9;">
          <div style="font-size: 0.82rem; color: #64748b; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-info-circle" style="color: #94a3b8;"></i>
            Keputusan persetujuan dilakukan oleh Dosen Pembimbing / Kaprodi.
          </div>
        </div>
        <?php endif; ?>
      </div>

    </div>

    <!-- Bottom Section: Tabs & Bimbingan Table -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      
      <!-- Nav Tabs -->
      <div style="display: flex; gap: 24px; border-bottom: 2px solid #f1f5f9; margin-bottom: 20px;">
        <button class="tab-link active" onclick="switchDetailTab(event, 'tab-bimbingan')" style="padding: 10px 4px; border: none; background: none; font-weight: 700; color: #0284c7; border-bottom: 2px solid #0284c7; cursor: pointer; font-size: 0.9rem;">
          Bimbingan
        </button>
        <button class="tab-link" onclick="switchDetailTab(event, 'tab-revisi')" style="padding: 10px 4px; border: none; background: none; font-weight: 600; color: #64748b; cursor: pointer; font-size: 0.9rem;">
          Revisi
        </button>
        <button class="tab-link" onclick="switchDetailTab(event, 'tab-dokumen')" style="padding: 10px 4px; border: none; background: none; font-weight: 600; color: #64748b; cursor: pointer; font-size: 0.9rem;">
          Dokumen
        </button>
        <button class="tab-link" onclick="switchDetailTab(event, 'tab-riwayat')" style="padding: 10px 4px; border: none; background: none; font-weight: 600; color: #64748b; cursor: pointer; font-size: 0.9rem;">
          Riwayat
        </button>
      </div>

      <!-- Tab Content: Bimbingan -->
      <div id="tab-bimbingan" class="tab-content-panel">
        <div class="table-wrapper">
          <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
            <thead>
              <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #fafafa;">
                <th style="padding: 12px 14px; color: #64748b; font-weight: 600; width: 45px;">No</th>
                <th style="padding: 12px 14px; color: #64748b; font-weight: 600; width: 120px;">Tanggal</th>
                <th style="padding: 12px 14px; color: #64748b; font-weight: 600;">Catatan Bimbingan</th>
                <th style="padding: 12px 14px; color: #64748b; font-weight: 600; width: 150px;">File</th>
                <?php if (in_array($user['role'] ?? '', ['admin', 'prodi', 'dosen'])): ?>
                <th style="padding: 12px 14px; color: #64748b; font-weight: 600; text-align: center; width: 80px;">Aksi</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody id="bimbinganTableBody">
              <?php foreach ($bimbinganLogs as $log): ?>
                <tr style="border-bottom: 1px solid #f1f5f9;">
                  <td style="padding: 14px; color: #64748b;"><?= $log['no'] ?></td>
                  <td style="padding: 14px; color: #64748b; font-weight: 500;"><?= $log['tanggal'] ?></td>
                  <td style="padding: 14px; color: #1e293b; line-height: 1.4;"><?= htmlspecialchars($log['catatan']) ?></td>
                  <td style="padding: 14px;">
                    <button type="button" onclick="previewDocument('<?= $log['file'] ?>', 'Catatan Bimbingan Mahasiswa')" style="display: inline-flex; align-items: center; gap: 6px; background: #eff6ff; color: #2563eb; padding: 5px 10px; border-radius: 6px; font-size: 0.8rem; border: none; cursor: pointer; font-weight: 500;">
                      <i class="fas fa-file-pdf"></i> <?= $log['file'] ?>
                    </button>
                  </td>
                  <?php if (in_array($user['role'] ?? '', ['admin', 'prodi', 'dosen'])): ?>
                  <td style="padding: 14px; text-align: center;">
                    <button class="btn-act btn-act-del" onclick="deleteBimbinganRow(this)" title="Hapus Catatan">
                      <i class="fas fa-trash"></i>
                    </button>
                  </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <?php if (in_array($user['role'] ?? '', ['admin', 'prodi', 'dosen'])): ?>
        <div style="margin-top: 20px;">
          <button class="btn btn-primary" onclick="openModalCatatan()" style="background: #0284c7; padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px; border: none; color: white;">
            <i class="fas fa-plus"></i> Tambah Catatan Bimbingan
          </button>
        </div>
        <?php endif; ?>
      </div>

      <!-- Tab Content: Revisi -->
      <div id="tab-revisi" class="tab-content-panel" style="display: none; padding: 20px 0;">
        <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 24px; text-align: center;">
          <i class="fas fa-history" style="font-size: 2rem; color: #94a3b8; margin-bottom: 10px;"></i>
          <h4 style="color: #334155; margin-bottom: 6px;">Riwayat Revisi Proposal &amp; Skripsi</h4>
          <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 16px;">Revisi draft bab 1 s/d bab 3 terakhir diunggah pada 09-10-2026 oleh Siti Rahmawati.</p>
          <button class="btn btn-primary" onclick="previewDocument('Draft_Revisi_Bab1_3.pdf', 'Berkas Revisi Terakhir')" style="background: #0284c7; padding: 8px 16px; border-radius: 6px; font-size: 0.82rem; border: none; color: white;">
            <i class="fas fa-eye"></i> Pratinjau Berkas Revisi Terakhir
          </button>
        </div>
      </div>

      <!-- Tab Content: Dokumen -->
      <div id="tab-dokumen" class="tab-content-panel" style="display: none; padding: 20px 0;">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
          <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 12px;">
              <i class="fas fa-file-pdf" style="font-size: 1.8rem; color: #dc2626;"></i>
              <div>
                <div style="font-weight: 600; font-size: 0.85rem;">Proposal_Lengkap.pdf</div>
                <div style="font-size: 0.75rem; color: #64748b;">1.8 MB &bull; 01-10-2026</div>
              </div>
            </div>
            <button onclick="previewDocument('Proposal_Lengkap.pdf', 'Proposal Skripsi Lengkap')" class="btn btn-sm btn-outline"><i class="fas fa-eye"></i></button>
          </div>

          <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 12px;">
              <i class="fas fa-file-pdf" style="font-size: 1.8rem; color: #dc2626;"></i>
              <div>
                <div style="font-weight: 600; font-size: 0.85rem;">Lembar_Persetujuan.pdf</div>
                <div style="font-size: 0.75rem; color: #64748b;">420 KB &bull; 03-10-2026</div>
              </div>
            </div>
            <button onclick="previewDocument('Lembar_Persetujuan.pdf', 'Lembar Persetujuan Pembimbing')" class="btn btn-sm btn-outline"><i class="fas fa-eye"></i></button>
          </div>
        </div>
      </div>

      <!-- Tab Content: Riwayat -->
      <div id="tab-riwayat" class="tab-content-panel" style="display: none; padding: 20px 0;">
        <div id="riwayatList" style="border-left: 2px solid #e2e8f0; padding-left: 18px; margin-left: 10px; display: flex; flex-direction: column; gap: 16px;">
          <div>
            <div style="font-weight: 700; color: #0f172a; font-size: 0.85rem;">Tahap Bimbingan Bab 1 - 3 Berlangsung</div>
            <div style="color: #64748b; font-size: 0.75rem;">08-10-2026 11:30 &bull; Dosen: Dr. Ahmad, M.Kom</div>
          </div>
          <div>
            <div style="font-weight: 700; color: #0f172a; font-size: 0.85rem;">Status Diperbarui ke "Bimbingan"</div>
            <div style="color: #64748b; font-size: 0.75rem;">03-10-2026 14:00 &bull; oleh Dr. Ahmad, M.Kom</div>
          </div>
          <div>
            <div style="font-weight: 700; color: #0f172a; font-size: 0.85rem;">Proposal Disetujui oleh Kaprodi TI</div>
            <div style="color: #64748b; font-size: 0.75rem;">03-10-2026 09:30 &bull; oleh Kaprodi TI</div>
          </div>
          <div>
            <div style="font-weight: 700; color: #0f172a; font-size: 0.85rem;">Pengajuan Proposal Awal</div>
            <div style="color: #64748b; font-size: 0.75rem;">01-10-2026 10:15 &bull; oleh Siti Rahmawati</div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Modal 1: Edit Data Mahasiswa & Proposal -->
  <div class="modal-overlay" id="modalEditDetail">
    <div class="modal-box">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-edit" style="color:#16a34a;margin-right:8px;"></i> Edit Informasi Mahasiswa &amp; Proposal</h3>
        <button class="modal-close" onclick="closeModalEditDetail()">&times;</button>
      </div>
      <form onsubmit="handleSaveDetail(event)">
        <div class="form-group">
          <label class="form-label">Nama Mahasiswa</label>
          <input type="text" id="detailFormNama" class="form-control" required value="<?= htmlspecialchars($proposal['nama']) ?>">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">NPM</label>
            <input type="text" id="detailFormNpm" class="form-control" required value="<?= htmlspecialchars($proposal['npm']) ?>">
          </div>
          <div class="form-group">
            <label class="form-label">Program Studi</label>
            <select id="detailFormProdi" class="form-control" required>
              <option value="Teknik Informatika" selected>Teknik Informatika</option>
              <option value="Sistem Informasi">Sistem Informasi</option>
              <option value="Manajemen">Manajemen</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Judul Proposal Skripsi</label>
          <textarea id="detailFormJudul" class="form-control" rows="3" required><?= htmlspecialchars($proposal['judul']) ?></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Dosen Pembimbing</label>
          <select id="detailFormDosen" class="form-control">
            <option value="Dr. Ahmad, M.Kom" selected>Dr. Ahmad, M.Kom</option>
            <option value="Dr. Budi Santoso, M.M">Dr. Budi Santoso, M.M</option>
            <option value="Prof. Dr. Ir. Hendra, M.T">Prof. Dr. Ir. Hendra, M.T</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalEditDetail()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background: #16a34a;">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal 2: Modal Ubah Status Custom -->
  <div class="modal-overlay" id="modalStatusCustom">
    <div class="modal-box">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-sliders-h" style="color:#0284c7;margin-right:8px;"></i> Pilih Tahapan / Status Skripsi</h3>
        <button class="modal-close" onclick="closeModalStatusCustom()">&times;</button>
      </div>
      <form onsubmit="handleApplyCustomStatus(event)">
        <div class="form-group">
          <label class="form-label">Pilih Tahap Skripsi yang Dituju</label>
          <select id="selectTahapSkripsi" class="form-control" required>
            <option value="1">1. Diajukan (Usulan Masuk)</option>
            <option value="2">2. Disetujui (Judul Diterima)</option>
            <option value="3">3. Bimbingan (Sedang Konsultasi)</option>
            <option value="4" selected>4. Seminar Proposal (Siap / Lolos Bimbingan)</option>
            <option value="5">5. Sidang Skripsi (Naskah Akhir Siap Diuji)</option>
            <option value="6">6. Selesai (Lulus Yudisium)</option>
            <option value="tolak">7. Ditolak (Perlu Pengajuan Judul Baru)</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Catatan Keputusan / Alasan</label>
          <textarea id="catatanKeputusan" class="form-control" rows="3" placeholder="Masukkan catatan resmi dosen/prodi..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalStatusCustom()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background: #0284c7;">Terapkan Status</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal 3: Tambah Catatan Bimbingan -->
  <div class="modal-overlay" id="modalCatatan">
    <div class="modal-box">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-plus-circle" style="color:#0284c7;margin-right:8px;"></i> Tambah Catatan Bimbingan</h3>
        <button class="modal-close" onclick="closeModalCatatan()">&times;</button>
      </div>
      <form onsubmit="handleAddCatatan(event)">
        <div class="form-group">
          <label class="form-label">Tanggal Bimbingan</label>
          <input type="date" id="inputTgl" class="form-control" required value="<?= date('Y-m-d') ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Catatan Bimbingan / Saran Dosen</label>
          <textarea id="inputCatatan" class="form-control" rows="4" required placeholder="Masukkan arahan perbaikan atau catatan bimbingan..."></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Upload File Pendukung (PDF/DOC)</label>
          <input type="file" id="inputFile" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalCatatan()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background: #0284c7;">Simpan Catatan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal 4: Pratinjau Dokumen PDF -->
  <div class="modal-overlay" id="modalDocPreview">
    <div class="modal-box" style="max-width: 600px;">
      <div class="modal-header">
        <h3 class="modal-title" id="previewDocTitle"><i class="fas fa-file-pdf" style="color:#dc2626;margin-right:8px;"></i> Pratinjau Dokumen</h3>
        <button class="modal-close" onclick="closeDocPreview()">&times;</button>
      </div>
      <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; text-align: center; margin-bottom: 20px;">
        <i class="fas fa-file-pdf" style="font-size: 3.5rem; color: #dc2626; margin-bottom: 12px;"></i>
        <h4 id="previewDocName" style="color: #0f172a; margin-bottom: 6px;">catatan1.pdf</h4>
        <p id="previewDocDesc" style="color: #64748b; font-size: 0.85rem;">Berkas tersimpan di repositori SIMSKRIPSI Universitas Muhammadiyah Bengkulu</p>
      </div>
      <div class="modal-footer" style="justify-content: space-between;">
        <span style="font-size: 0.78rem; color: #64748b; display: flex; align-items: center; gap: 6px;"><i class="fas fa-check-circle" style="color:#10b981;"></i> Terverifikasi Digital</span>
        <button type="button" class="btn btn-outline" onclick="closeDocPreview()">Tutup</button>
      </div>
    </div>
  </div>

  <script>
  let currentStep = 3; 

  const stageDefinitions = [
    { num: 1, name: 'Diajukan', defaultDate: '01-10-2026' },
    { num: 2, name: 'Disetujui', defaultDate: '03-10-2026' },
    { num: 3, name: 'Bimbingan', defaultDate: '08-10-2026' },
    { num: 4, name: 'Seminar Proposal', defaultDate: '<?= date("d-m-Y") ?>' },
    { num: 5, name: 'Sidang Skripsi', defaultDate: '10-11-2026' },
    { num: 6, name: 'Selesai', defaultDate: '25-11-2026' }
  ];

  function renderVerticalStepper() {
    const container = document.getElementById('verticalStepper');
    if (!container) return;

    if (currentStep === -1) {
      container.innerHTML = `
        <div class="vstep-item" style="padding-bottom:10px;">
          <div class="vstep-dot" style="background:#dc2626;color:white;"><i class="fas fa-times"></i></div>
          <div class="vstep-content">
            <div class="vstep-title"><span style="color:#dc2626;">Proposal Ditolak</span><span class="vstep-date"><?= date('d-m-Y') ?></span></div>
            <div class="vstep-desc" style="color:#dc2626;">Mahasiswa diminta mengajukan usulan judul baru.</div>
          </div>
        </div>
      `;
      document.getElementById('currentStatusBadge').className = 'badge badge-ditolak';
      document.getElementById('currentStatusBadge').innerText = 'Ditolak';
      updateActionButtons();
      return;
    }

    let html = '';
    stageDefinitions.forEach(stage => {
      let itemClass = '';
      let dotHtml = '';
      let titleHtml = '';
      let descHtml = '';

      if (stage.num < currentStep) {
        itemClass = 'vstep-item completed';
        dotHtml = `<div class="vstep-dot" style="background:#16a34a;color:white;cursor:pointer;" onclick="setStepDirect(${stage.num})" title="Klik untuk pilih tahap ini"><i class="fas fa-check" style="font-size:0.72rem;"></i></div>`;
        titleHtml = `<span style="color:#16a34a;">${stage.name}</span><span class="vstep-date">${stage.defaultDate}</span>`;
      } else if (stage.num === currentStep) {
        itemClass = 'vstep-item active';
        dotHtml = `<div class="vstep-dot" style="background:#0284c7;color:white;box-shadow:0 0 0 4px rgba(2,132,199,0.25);"><i class="fas fa-circle" style="font-size:0.5rem;"></i></div>`;
        titleHtml = `<span style="color:#0284c7;font-weight:700;">${stage.name}</span><span class="vstep-date" style="color:#0284c7;font-weight:600;"><?= date('d-m-Y') ?></span>`;
        descHtml = `<div class="vstep-desc" style="color:#0284c7;font-weight:600;"><i class="fas fa-spinner fa-spin" style="font-size:0.75rem;"></i> Sedang berjalan</div>`;
      } else {
        itemClass = 'vstep-item';
        dotHtml = `<div class="vstep-dot" style="cursor:pointer;" onclick="setStepDirect(${stage.num})" title="Klik untuk melompat ke tahap ${stage.name}"><i class="far fa-circle" style="font-size:0.65rem;"></i></div>`;
        titleHtml = `<span style="color:#64748b;">${stage.name}</span>`;
      }

      html += `
        <div class="${itemClass}">
          ${dotHtml}
          <div class="vstep-content">
            <div class="vstep-title">${titleHtml}</div>
            ${descHtml}
          </div>
        </div>
      `;
    });

    container.innerHTML = html;

    const badgeMap = {
      1: { text: 'Diajukan', cls: 'badge-diajukan' },
      2: { text: 'Disetujui', cls: 'badge-disetujui' },
      3: { text: 'Bimbingan', cls: 'badge-bimbingan' },
      4: { text: 'Seminar Proposal', cls: 'badge-seminar' },
      5: { text: 'Sidang Skripsi', cls: 'badge-sidang' },
      6: { text: 'Selesai Yudisium', cls: 'badge-selesai' }
    };
    const b = badgeMap[currentStep] || { text: 'Bimbingan', cls: 'badge-bimbingan' };
    const badgeEl = document.getElementById('currentStatusBadge');
    badgeEl.className = `badge ${b.cls}`;
    badgeEl.innerText = b.text;

    updateActionButtons();
  }

  function updateActionButtons() {
    const btnMajuSeminar = document.getElementById('btnMajuSeminar');
    const btnMajuSidang = document.getElementById('btnMajuSidang');
    const btnSelesai = document.getElementById('btnSelesai');

    if (currentStep < 4) {
      btnMajuSeminar.style.display = 'inline-flex';
      btnMajuSidang.style.display = 'none';
      btnSelesai.style.display = 'none';
    } else if (currentStep === 4) {
      btnMajuSeminar.style.display = 'none';
      btnMajuSidang.style.display = 'inline-flex';
      btnSelesai.style.display = 'none';
    } else if (currentStep >= 5) {
      btnMajuSeminar.style.display = 'none';
      btnMajuSidang.style.display = 'none';
      btnSelesai.style.display = 'inline-flex';
    }
  }

  function setujuiMajuSeminar() {
    currentStep = 4;
    renderVerticalStepper();
    addRiwayatItem('Disetujui Maju Seminar Proposal', 'Dr. Ahmad, M.Kom telah menyetujui naskah proposal untuk dijadwalkan seminar.');
    showToast('Proposal disetujui! Status berhasil dimajukan ke <strong>Seminar Proposal</strong>.', 'success');
  }

  function setujuiMajuSidang() {
    currentStep = 5;
    renderVerticalStepper();
    addRiwayatItem('Disetujui Maju Sidang Skripsi', 'Naskah skripsi lengkap telah memenuhi syarat untuk dijadwalkan Sidang Munaqasyah.');
    showToast('Seminar selesai! Status dimajukan ke <strong>Sidang Skripsi</strong>.', 'success');
  }

  function nyatakanSelesai() {
    currentStep = 6;
    renderVerticalStepper();
    addRiwayatItem('Lulus Yudisium & Selesai', 'Mahasiswa dinyatakan lulus sidang skripsi dan siap mengikuti yudisium.');
    showToast('Selamat! Mahasiswa dinyatakan <strong>Lulus &amp; Selesai</strong>.', 'success');
  }

  function mintaRevisi() {
    currentStep = 3;
    renderVerticalStepper();
    addRiwayatItem('Catatan Revisi Ditambahkan', 'Dosen meminta mahasiswa melakukan perbaikan draft sebelum dijadwalkan seminar.');
    showToast('Status ditetapkan: <strong>Perlu Bimbingan / Revisi</strong>.', 'info');
  }

  function tolakProposal() {
    if (confirm('Apakah Anda yakin ingin MENOLAK proposal skripsi ini?')) {
      currentStep = -1;
      renderVerticalStepper();
      addRiwayatItem('Proposal Ditolak', 'Dosen / Kaprodi menolak usulan judul skripsi.');
      showToast('Proposal skripsi telah <strong>Ditolak</strong>.', 'error');
    }
  }

  function setStepDirect(stepNum) {
    currentStep = stepNum;
    renderVerticalStepper();
    showToast(`Tahap skripsi dialihkan ke: <strong>${stageDefinitions[stepNum - 1].name}</strong>`, 'info');
  }

  function addRiwayatItem(title, note) {
    const riwayatList = document.getElementById('riwayatList');
    if (!riwayatList) return;
    const newItem = document.createElement('div');
    newItem.innerHTML = `
      <div style="font-weight: 700; color: #0284c7; font-size: 0.85rem;"><i class="fas fa-check-circle"></i> ${title}</div>
      <div style="color: #64748b; font-size: 0.75rem;"><?= date('d-m-Y H:i') ?> &bull; ${note}</div>
    `;
    riwayatList.insertBefore(newItem, riwayatList.firstChild);
  }

  function openModalStatusCustom() { document.getElementById('modalStatusCustom').classList.add('open'); }
  function closeModalStatusCustom() { document.getElementById('modalStatusCustom').classList.remove('open'); }
  function handleApplyCustomStatus(e) {
    e.preventDefault();
    const val = document.getElementById('selectTahapSkripsi').value;
    const note = document.getElementById('catatanKeputusan').value.trim() || 'Status diperbarui oleh Dosen/Admin.';
    
    if (val === 'tolak') {
      currentStep = -1;
      addRiwayatItem('Proposal Ditolak', note);
    } else {
      currentStep = parseInt(val);
      const stageName = stageDefinitions[currentStep - 1].name;
      addRiwayatItem(`Status Diubah ke: ${stageName}`, note);
    }

    renderVerticalStepper();
    closeModalStatusCustom();
    showToast('Status skripsi berhasil diperbarui!', 'success');
  }

  function switchDetailTab(evt, tabId) {
    document.querySelectorAll('.tab-content-panel').forEach(p => p.style.display = 'none');
    document.querySelectorAll('.tab-link').forEach(btn => {
      btn.style.color = '#64748b';
      btn.style.borderBottom = 'none';
      btn.classList.remove('active');
    });
    document.getElementById(tabId).style.display = 'block';
    evt.currentTarget.style.color = '#0284c7';
    evt.currentTarget.style.borderBottom = '2px solid #0284c7';
    evt.currentTarget.classList.add('active');
  }

  function openModalEditDetail() { document.getElementById('modalEditDetail').classList.add('open'); }
  function closeModalEditDetail() { document.getElementById('modalEditDetail').classList.remove('open'); }
  function handleSaveDetail(e) {
    e.preventDefault();
    const nama = document.getElementById('detailFormNama').value.trim();
    const npm = document.getElementById('detailFormNpm').value.trim();
    const prodi = document.getElementById('detailFormProdi').value;
    const judul = document.getElementById('detailFormJudul').value.trim();
    const dosen = document.getElementById('detailFormDosen').value;

    document.getElementById('viewNama').innerText = nama;
    document.getElementById('viewNpm').innerText = npm;
    document.getElementById('viewProdi').innerText = prodi;
    document.getElementById('viewJudul').innerText = judul;
    document.getElementById('viewDosen').innerText = dosen;

    closeModalEditDetail();
    showToast('Data mahasiswa & proposal berhasil diperbarui!', 'success');
  }

  function openModalCatatan() { document.getElementById('modalCatatan').classList.add('open'); }
  function closeModalCatatan() { document.getElementById('modalCatatan').classList.remove('open'); }
  function handleAddCatatan(e) {
    e.preventDefault();
    const tgl = document.getElementById('inputTgl').value;
    const cat = document.getElementById('inputCatatan').value.trim();
    const tbody = document.getElementById('bimbinganTableBody');
    const no = tbody.children.length + 1;
    const fileName = `catatan${no}.pdf`;

    const newRow = document.createElement('tr');
    newRow.style.borderBottom = '1px solid #f1f5f9';
    newRow.innerHTML = `
      <td style="padding: 14px; color: #64748b;">${no}</td>
      <td style="padding: 14px; color: #64748b; font-weight: 500;">${tgl}</td>
      <td style="padding: 14px; color: #1e293b; line-height: 1.4;">${cat}</td>
      <td style="padding: 14px;">
        <button type="button" onclick="previewDocument('${fileName}', 'Catatan Bimbingan Mahasiswa')" style="display: inline-flex; align-items: center; gap: 6px; background: #eff6ff; color: #2563eb; padding: 5px 10px; border-radius: 6px; font-size: 0.8rem; border: none; cursor: pointer; font-weight: 500;">
          <i class="fas fa-file-pdf"></i> ${fileName}
        </button>
      </td>
      <td style="padding: 14px; text-align: center;">
        <button class="btn-act btn-act-del" onclick="deleteBimbinganRow(this)"><i class="fas fa-trash"></i></button>
      </td>
    `;
    tbody.appendChild(newRow);
    closeModalCatatan();
    document.getElementById('inputCatatan').value = '';
    showToast(`Catatan bimbingan log #${no} berhasil ditambahkan!`, 'success');
  }

  function deleteBimbinganRow(btn) {
    if (confirm('Hapus catatan bimbingan ini?')) {
      btn.closest('tr').remove();
      showToast('Catatan bimbingan dihapus.', 'info');
    }
  }

  function previewDocument(fileName, title) {
    document.getElementById('previewDocTitle').innerHTML = `<i class="fas fa-file-pdf" style="color:#dc2626;margin-right:8px;"></i> ${title}`;
    document.getElementById('previewDocName').innerText = fileName;
    document.getElementById('previewDocDesc').innerText = `Berkas "${fileName}" tersimpan di repositori bimbingan SIMSKRIPSI`;
    document.getElementById('modalDocPreview').classList.add('open');
  }
  function closeDocPreview() {
    document.getElementById('modalDocPreview').classList.remove('open');
  }

  document.addEventListener('DOMContentLoaded', () => {
    renderVerticalStepper();
  });
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>