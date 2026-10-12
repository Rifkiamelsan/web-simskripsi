<?php
/**
 * ADMIN - DATA DOSEN PEMBIMBING & KUOTA
 * SIMSKRIPSI Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['admin']);
$user = getAuthUser();

$pageTitle = "Data Dosen Pembimbing - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Dosen Pembimbing', 'url' => '']
];

$lecturers = [
    ['nip' => '19800101', 'nama' => 'Dr. Ahmad, M.Kom', 'bidang' => 'Web Service & Web Semantik', 'bimbingan' => 5, 'kuota' => 10, 'email' => 'ahmad@umb.ac.id'],
    ['nip' => '0412057801', 'nama' => 'Prof. Dr. Ir. Hendra, M.T', 'bidang' => 'Sistem Cerdas & AI', 'bimbingan' => 6, 'kuota' => 10, 'email' => 'hendra@umb.ac.id'],
    ['nip' => '0420118503', 'nama' => 'Dr. Budi Santoso, M.M', 'bidang' => 'Sistem Informasi Manajemen', 'bimbingan' => 4, 'kuota' => 8, 'email' => 'budisantoso@umb.ac.id'],
    ['nip' => '0415088202', 'nama' => 'Bambang Trianto, M.Cs', 'bidang' => 'Jaringan & Keamanan Cloud', 'bimbingan' => 3, 'kuota' => 8, 'email' => 'bambang@umb.ac.id']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Data Dosen Pembimbing</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Kelola data dosen, kuota kapasitas bimbingan, dan riwayat tugas akhir mahasiswa</p>
      </div>
      <button onclick="openModalTambahDosen()" class="btn btn-primary" style="background: #0284c7; padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; color: white; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fas fa-user-plus"></i> Tambah Dosen
      </button>
    </div>

    <!-- Stat Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Total Dosen Pembimbing</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin-top: 4px;">4 Orang</div>
        <div style="font-size: 0.78rem; color: #64748b; margin-top: 6px;">Program Studi Informatika &amp; SI</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Bimbingan Aktif</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #0284c7; margin-top: 4px;">18 Mahasiswa</div>
        <div style="font-size: 0.78rem; color: #0284c7; margin-top: 6px;">Sedang menyusun skripsi</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Sisa Kuota Tersedia</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #16a34a; margin-top: 4px;">18 Slot</div>
        <div style="font-size: 0.78rem; color: #16a34a; margin-top: 6px;">Dapat menerima bimbingan baru</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Rasio Rata-Rata</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #f59e0b; margin-top: 4px;">4.5 Mhs</div>
        <div style="font-size: 0.78rem; color: #f59e0b; margin-top: 6px;">Per dosen pembimbing</div>
      </div>
    </div>

    <!-- Table Card -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      <div class="table-wrapper" style="overflow-x: auto;">
        <table id="tableDosen" style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #f8fafc;">
              <th style="padding: 12px 14px; color: #475569;">NIP</th>
              <th style="padding: 12px 14px; color: #475569;">Nama Dosen &amp; Gelar</th>
              <th style="padding: 12px 14px; color: #475569;">Bidang Keahlian</th>
              <th style="padding: 12px 14px; color: #475569; width: 22%;">Bimbingan &amp; Kapasitas</th>
              <th style="padding: 12px 14px; text-align: center; color: #475569;">Status Kuota</th>
              <th style="padding: 12px 14px; text-align: center; color: #475569;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($lecturers as $l): 
                $sisa = $l['kuota'] - $l['bimbingan'];
                $pct = round(($l['bimbingan'] / $l['kuota']) * 100);
            ?>
              <tr id="row-dosen-<?= $l['nip'] ?>" style="border-bottom: 1px solid #f1f5f9;">
                <td style="padding: 14px; color: #64748b; font-weight: 500;"><?= $l['nip'] ?></td>
                <td style="padding: 14px;">
                  <div style="font-weight: 700; color: #0f172a;" class="dosen-nama"><?= $l['nama'] ?></div>
                  <div style="font-size: 0.78rem; color: #64748b; margin-top: 2px;"><?= $l['email'] ?></div>
                </td>
                <td style="padding: 14px; color: #334155;" class="dosen-bidang"><?= $l['bidang'] ?></td>
                <td style="padding: 14px;">
                  <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 4px;">
                    <span style="font-weight: 600; color: #0284c7;"><?= $l['bimbingan'] ?> / <span class="dosen-kuota"><?= $l['kuota'] ?></span> Mahasiswa</span>
                    <span style="color: #64748b;"><?= $pct ?>%</span>
                  </div>
                  <div style="width: 100%; height: 6px; background: #e2e8f0; border-radius: 99px; overflow: hidden;">
                    <div style="width: <?= $pct ?>%; height: 100%; background: #0284c7; border-radius: 99px;"></div>
                  </div>
                </td>
                <td style="padding: 14px; text-align: center;">
                  <span class="badge badge-disetujui">Tersedia (<?= $sisa ?> sisa)</span>
                </td>
                <td style="padding: 14px; text-align: center;">
                  <div style="display: inline-flex; gap: 6px;">
                    <button type="button" onclick="openModalEditDosen('<?= $l['nip'] ?>', '<?= htmlspecialchars($l['nama'], ENT_QUOTES) ?>', '<?= htmlspecialchars($l['bidang'], ENT_QUOTES) ?>', <?= $l['kuota'] ?>)" class="btn btn-sm" style="background: #eff6ff; color: #0284c7; border: 1px solid #bfdbfe; padding: 6px 12px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                      <i class="fas fa-edit"></i> Edit Kuota
                    </button>
                    <a href="bimbingan.php" class="btn btn-sm" style="background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; padding: 6px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                      <i class="fas fa-list"></i> Bimbingan
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

  <!-- MODAL TAMBAH DOSEN -->
  <div id="modalTambahDosen" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 520px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-user-plus" style="color: #0284c7; margin-right: 8px;"></i> Tambah Dosen Pembimbing</h3>
        <button type="button" onclick="closeModal('modalTambahDosen')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form id="formTambahDosen" onsubmit="submitTambahDosen(event)" style="padding: 24px;">
        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">NIP / NIDN Dosen</label>
          <input type="text" id="addDosenNip" required placeholder="Contoh: 198503102010121001" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Nama Lengkap Beserta Gelar</label>
          <input type="text" id="addDosenNama" required placeholder="Contoh: Dr. Ir. Gunawan, M.Cs" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Bidang Keahlian / Fokus Riset</label>
          <input type="text" id="addDosenBidang" required placeholder="Contoh: Data Science & Machine Learning" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px;">
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Kuota Maksimal</label>
            <input type="number" id="addDosenKuota" required value="10" min="1" max="20" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
          </div>
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Email Akademik</label>
            <input type="email" id="addDosenEmail" placeholder="nama@umb.ac.id" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
          </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalTambahDosen')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #0284c7; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">
            <i class="fas fa-check"></i> Simpan Dosen
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT DOSEN & KUOTA -->
  <div id="modalEditDosen" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 480px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-edit" style="color: #0284c7; margin-right: 8px;"></i> Edit Kuota Dosen</h3>
        <button type="button" onclick="closeModal('modalEditDosen')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form id="formEditDosen" onsubmit="submitEditDosen(event)" style="padding: 24px;">
        <input type="hidden" id="editDosenNip">

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Dosen</label>
          <input type="text" id="editDosenNama" readonly style="width: 100%; padding: 9px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.86rem; color: #334155; font-weight: 600;">
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Bidang Keahlian</label>
          <input type="text" id="editDosenBidang" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Kuota Maksimal Bimbingan Mahasiswa</label>
          <input type="number" id="editDosenKuota" required min="1" max="25" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalEditDosen')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #0284c7; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">
            <i class="fas fa-save"></i> Perbarui Kuota
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModalTambahDosen() {
      document.getElementById('modalTambahDosen').style.display = 'flex';
    }

    function openModalEditDosen(nip, nama, bidang, kuota) {
      document.getElementById('editDosenNip').value = nip;
      document.getElementById('editDosenNama').value = nama;
      document.getElementById('editDosenBidang').value = bidang;
      document.getElementById('editDosenKuota').value = kuota;
      document.getElementById('modalEditDosen').style.display = 'flex';
    }

    function closeModal(id) {
      document.getElementById(id).style.display = 'none';
    }

    function submitTambahDosen(e) {
      e.preventDefault();
      const nama = document.getElementById('addDosenNama').value;
      closeModal('modalTambahDosen');
      showToast('Dosen pembimbing ' + nama + ' berhasil ditambahkan!', 'success');
    }

    function submitEditDosen(e) {
      e.preventDefault();
      const nip = document.getElementById('editDosenNip').value;
      const bidang = document.getElementById('editDosenBidang').value;
      const kuota = document.getElementById('editDosenKuota').value;

      const row = document.getElementById('row-dosen-' + nip);
      if (row) {
        row.querySelector('.dosen-bidang').innerText = bidang;
        row.querySelector('.dosen-kuota').innerText = kuota;
      }

      closeModal('modalEditDosen');
      showToast('Kuota dan bidang keahlian dosen berhasil diperbarui!', 'success');
    }

    window.onclick = function(e) {
      if (e.target.classList.contains('modal-overlay')) {
        e.target.style.display = 'none';
      }
    };
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
