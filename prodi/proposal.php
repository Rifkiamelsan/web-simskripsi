<?php
/**
 * PRODI - VALIDASI & PLOTTING PROPOSAL SKRIPSI
 * SIMSKRIPSI Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['prodi', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$proposals = getProposalList();
$pageTitle = "Validasi Usulan Proposal - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Proposal', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Validasi &amp; Plotting Proposal Skripsi</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Persetujuan usulan judul skripsi, revisi topik riset, dan penetapan dosen pembimbing</p>
      </div>
      <div style="display: flex; gap: 10px;">
        <button onclick="showToast('Data usulan proposal disinkronisasi ulang', 'info')" class="btn" style="background: white; border: 1px solid #cbd5e1; color: #475569; padding: 9px 16px; border-radius: 8px; font-weight: 600; font-size: 0.84rem; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
          <i class="fas fa-sync-alt"></i> Refresh Data
        </button>
      </div>
    </div>

    <!-- Stat Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Usulan Masuk</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin-top: 4px;"><?= count($proposals) ?></div>
        <div style="font-size: 0.78rem; color: #64748b; margin-top: 6px;">Total berkas pengajuan</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Menunggu Plotting</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #f59e0b; margin-top: 4px;">2</div>
        <div style="font-size: 0.78rem; color: #f59e0b; margin-top: 6px;">Perlu verifikasi &amp; SK</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Disetujui / Bimbingan</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #16a34a; margin-top: 4px;">3</div>
        <div style="font-size: 0.78rem; color: #16a34a; margin-top: 6px;">Dosen pembimbing aktif</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Perlu Revisi / Tolak</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #dc2626; margin-top: 4px;">1</div>
        <div style="font-size: 0.78rem; color: #dc2626; margin-top: 6px;">Judul tidak sesuai kajian</div>
      </div>
    </div>

    <!-- Table Card -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      <div class="table-wrapper" style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #f8fafc;">
              <th style="padding: 12px 14px; width: 45px; color: #475569;">No</th>
              <th style="padding: 12px 14px; color: #475569;">Mahasiswa</th>
              <th style="padding: 12px 14px; width: 32%; color: #475569;">Judul Proposal</th>
              <th style="padding: 12px 14px; color: #475569;">Dosen Pembimbing</th>
              <th style="padding: 12px 14px; text-align: center; color: #475569;">Status</th>
              <th style="padding: 12px 14px; text-align: center; color: #475569;">Aksi Kaprodi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1; 
            foreach ($proposals as $p): 
                $badgeClass = 'badge-diajukan';
                if ($p['status'] === 'Bimbingan') $badgeClass = 'badge-bimbingan';
                elseif ($p['status'] === 'Seminar') $badgeClass = 'badge-seminar';
                elseif ($p['status'] === 'Sidang') $badgeClass = 'badge-sidang';
                elseif ($p['status'] === 'Disetujui') $badgeClass = 'badge-disetujui';
                elseif ($p['status'] === 'Ditolak') $badgeClass = 'badge-ditolak';
            ?>
              <tr id="row-prop-<?= $p['id'] ?>" style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 14px; color: #64748b;"><?= $no++ ?></td>
                <td style="padding: 14px;">
                  <div style="font-weight: 700; color: #0f172a;"><?= htmlspecialchars($p['nama']) ?></div>
                  <div style="font-size: 0.78rem; color: #64748b; margin-top: 2px;">NPM: <?= htmlspecialchars($p['npm']) ?> &bull; <?= htmlspecialchars($p['prodi']) ?></div>
                </td>
                <td style="padding: 14px; color: #334155; line-height: 1.4;">
                  <?= htmlspecialchars($p['judul']) ?>
                </td>
                <td style="padding: 14px;">
                  <span id="propDosen-<?= $p['id'] ?>" style="color: #0284c7; font-weight: 600; font-size: 0.85rem;">
                    <?= htmlspecialchars($p['dosen']) ?>
                  </span>
                </td>
                <td style="padding: 14px; text-align: center;">
                  <span id="propBadge-<?= $p['id'] ?>" class="badge <?= $badgeClass ?>"><?= htmlspecialchars($p['status']) ?></span>
                </td>
                <td style="padding: 14px; text-align: center;">
                  <div style="display: inline-flex; gap: 6px; flex-wrap: wrap; justify-content: center;">
                    <button type="button" onclick="openModalSetujui(<?= $p['id'] ?>, '<?= htmlspecialchars($p['nama'], ENT_QUOTES) ?>', '<?= htmlspecialchars($p['npm'], ENT_QUOTES) ?>', '<?= htmlspecialchars($p['judul'], ENT_QUOTES) ?>')" class="btn btn-sm" style="background: #10b981; color: white; padding: 6px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;" title="Setujui & Plotting Dosen">
                      <i class="fas fa-check"></i> Setujui
                    </button>
                    <button type="button" onclick="openModalRevisi(<?= $p['id'] ?>, '<?= htmlspecialchars($p['nama'], ENT_QUOTES) ?>')" class="btn btn-sm" style="background: #fffbeb; color: #d97706; border: 1px solid #fde68a; padding: 6px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;" title="Minta Revisi Proposal">
                      <i class="fas fa-undo"></i> Revisi
                    </button>
                    <a href="../admin/detail_proposal.php?id=<?= $p['id'] ?>" class="btn btn-sm" style="background: #eff6ff; color: #0284c7; border: 1px solid #bfdbfe; padding: 6px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;" title="Lihat Detail Naskah & Logbook">
                      <i class="fas fa-eye"></i> Detail
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- MODAL SETUJUI PROPOSAL -->
  <div id="modalSetujui" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 540px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-check-circle" style="color: #10b981; margin-right: 8px;"></i> Setujui &amp; Tetapkan Dosen</h3>
        <button type="button" onclick="closeModal('modalSetujui')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form id="formSetujui" onsubmit="submitSetujui(event)" style="padding: 24px;">
        <input type="hidden" id="setujuiPropId">
        
        <div style="background: #f8fafc; border-radius: 8px; padding: 14px; margin-bottom: 16px;">
          <div style="font-weight: 700; color: #0f172a; font-size: 0.92rem;" id="setujuiNamaDisplay">Nama Mahasiswa</div>
          <div style="color: #64748b; font-size: 0.8rem; margin-top: 4px;" id="setujuiJudulDisplay">Judul Proposal</div>
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Tetapkan Dosen Pembimbing 1 (Utama)</label>
          <select id="setujuiDosen1" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem; background: white;">
            <option value="Dr. Ahmad, M.Kom">Dr. Ahmad, M.Kom (Web Semantik)</option>
            <option value="Prof. Dr. Ir. Hendra, M.T">Prof. Dr. Ir. Hendra, M.T (Sistem Cerdas & AI)</option>
            <option value="Dr. Budi Santoso, M.M">Dr. Budi Santoso, M.M (Sistem Informasi Manajemen)</option>
            <option value="Bambang Trianto, M.Cs">Bambang Trianto, M.Cs (Jaringan & Cloud)</option>
          </select>
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Tetapkan Dosen Pembimbing 2 (Pendamping)</label>
          <select id="setujuiDosen2" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem; background: white;">
            <option value="">-- Dosen Pembimbing Tunggal --</option>
            <option value="Dr. Ahmad, M.Kom">Dr. Ahmad, M.Kom</option>
            <option value="Prof. Dr. Ir. Hendra, M.T">Prof. Dr. Ir. Hendra, M.T</option>
            <option value="Dr. Budi Santoso, M.M">Dr. Budi Santoso, M.M</option>
            <option value="Bambang Trianto, M.Cs">Bambang Trianto, M.Cs</option>
          </select>
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Catatan Persetujuan Kaprodi</label>
          <textarea id="setujuiCatatan" rows="3" placeholder="Catatan untuk mahasiswa atau pembimbing..." style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem; outline: none;"></textarea>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalSetujui')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #10b981; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">
            <i class="fas fa-check"></i> Setujui &amp; Mulai Bimbingan
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL REVISI PROPOSAL -->
  <div id="modalRevisi" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 500px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-undo" style="color: #d97706; margin-right: 8px;"></i> Minta Revisi Proposal</h3>
        <button type="button" onclick="closeModal('modalRevisi')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form id="formRevisi" onsubmit="submitRevisi(event)" style="padding: 24px;">
        <input type="hidden" id="revisiPropId">
        
        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Mahasiswa</label>
          <input type="text" id="revisiNamaDisplay" readonly style="width: 100%; padding: 9px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.86rem; color: #334155; font-weight: 600;">
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Poin-Poin Perbaikan Judul / Metodologi</label>
          <textarea id="revisiCatatan" required rows="4" placeholder="Tuliskan aspek yang perlu diperbaiki (contoh: batasan masalah terlalu luas, perbaiki metode evaluasi)..." style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem; outline: none;"></textarea>
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Batas Waktu Pengajuan Ulang (Deadline)</label>
          <input type="date" id="revisiDeadline" value="2026-10-25" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalRevisi')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #d97706; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">
            <i class="fas fa-paper-plane"></i> Kirim Revisi
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModalSetujui(id, nama, npm, judul) {
      document.getElementById('setujuiPropId').value = id;
      document.getElementById('setujuiNamaDisplay').innerText = nama + ' (' + npm + ')';
      document.getElementById('setujuiJudulDisplay').innerText = '"' + judul + '"';
      document.getElementById('modalSetujui').style.display = 'flex';
    }

    function openModalRevisi(id, nama) {
      document.getElementById('revisiPropId').value = id;
      document.getElementById('revisiNamaDisplay').value = nama;
      document.getElementById('modalRevisi').style.display = 'flex';
    }

    function closeModal(id) {
      document.getElementById(id).style.display = 'none';
    }

    function submitSetujui(e) {
      e.preventDefault();
      const id = document.getElementById('setujuiPropId').value;
      const dosen = document.getElementById('setujuiDosen1').value;
      
      const badge = document.getElementById('propBadge-' + id);
      if (badge) {
        badge.className = 'badge badge-bimbingan';
        badge.innerText = 'Bimbingan';
      }
      const dosenTxt = document.getElementById('propDosen-' + id);
      if (dosenTxt) {
        dosenTxt.innerText = dosen;
      }
      
      closeModal('modalSetujui');
      showToast('Proposal disetujui! Status dialihkan ke Bimbingan dengan pembimbing ' + dosen, 'success');
    }

    function submitRevisi(e) {
      e.preventDefault();
      const id = document.getElementById('revisiPropId').value;
      
      const badge = document.getElementById('propBadge-' + id);
      if (badge) {
        badge.className = 'badge badge-ditolak';
        badge.innerText = 'Perlu Revisi';
      }
      
      closeModal('modalRevisi');
      showToast('Catatan revisi proposal telah dikirimkan ke mahasiswa!', 'warning');
    }

    window.onclick = function(e) {
      if (e.target.classList.contains('modal-overlay')) {
        e.target.style.display = 'none';
      }
    };
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
