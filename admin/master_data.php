<?php
/**
 * ADMIN - MASTER DATA AKADEMIK SIMSKRIPSI
 * SIMSKRIPSI Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['admin']);
$user = getAuthUser();

$pageTitle = "Master Data - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Master Data', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Master Data SIMSKRIPSI</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Kelola referensi bidang penelitian, ketersediaan ruangan ujian, dan periode yudisium</p>
      </div>
    </div>

    <!-- 3 Sections Grid -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
      <!-- 1. Bidang Riset -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px;">
              <i class="fas fa-microscope" style="color: #0284c7;"></i> Bidang Kajian Riset
            </h3>
            <span class="badge badge-seminar" id="badgeCountRiset">5 Bidang</span>
          </div>
          <p style="color: #64748b; font-size: 0.82rem; margin-bottom: 14px;">Bidang keahlian penelitian untuk skripsi mahasiswa FT.</p>
          <ul id="listRiset" style="list-style: none; padding: 0; margin: 0; font-size: 0.85rem; color: #334155;">
            <li style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <span>&bull; Web Service &amp; Web Semantik</span>
              <button onclick="deleteMasterItem(this, 'Bidang Riset')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
            <li style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <span>&bull; Artificial Intelligence &amp; NLP</span>
              <button onclick="deleteMasterItem(this, 'Bidang Riset')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
            <li style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <span>&bull; Sistem Pendukung Keputusan (DSS)</span>
              <button onclick="deleteMasterItem(this, 'Bidang Riset')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
            <li style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <span>&bull; Tata Kelola IT &amp; Framework COBIT</span>
              <button onclick="deleteMasterItem(this, 'Bidang Riset')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
            <li style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center;">
              <span>&bull; Keamanan Siber &amp; Cloud Computing</span>
              <button onclick="deleteMasterItem(this, 'Bidang Riset')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
          </ul>
        </div>
        <button onclick="openModalMaster('modalAddRiset')" class="btn" style="width: 100%; margin-top: 18px; background: #eff6ff; color: #0284c7; border: 1px solid #bfdbfe; padding: 9px; border-radius: 8px; font-weight: 600; font-size: 0.82rem; cursor: pointer;">
          <i class="fas fa-plus"></i> Tambah Bidang Riset
        </button>
      </div>

      <!-- 2. Ruangan Ujian -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px;">
              <i class="fas fa-door-open" style="color: #10b981;"></i> Ruangan Ujian
            </h3>
            <span class="badge badge-disetujui" id="badgeCountRuang">4 Ruang</span>
          </div>
          <p style="color: #64748b; font-size: 0.82rem; margin-bottom: 14px;">Ruang seminar proposal dan sidang munaqasyah.</p>
          <ul id="listRuang" style="list-style: none; padding: 0; margin: 0; font-size: 0.85rem; color: #334155;">
            <li style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <div style="font-weight: 600;">Ruang Seminar FT Lt. 2</div>
                <div style="font-size: 0.76rem; color: #64748b;">Kapasitas: 40 Orang &bull; LCD &amp; AC</div>
              </div>
              <button onclick="deleteMasterItem(this, 'Ruangan')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
            <li style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <div style="font-weight: 600;">Ruang Seminar A Lt. 2</div>
                <div style="font-size: 0.76rem; color: #64748b;">Kapasitas: 30 Orang &bull; LCD &amp; AC</div>
              </div>
              <button onclick="deleteMasterItem(this, 'Ruangan')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
            <li style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <div style="font-weight: 600;">Ruang Sidang B Lt. 3</div>
                <div style="font-size: 0.76rem; color: #64748b;">Kapasitas: 20 Orang &bull; Khusus Sidang</div>
              </div>
              <button onclick="deleteMasterItem(this, 'Ruangan')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
            <li style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <div style="font-weight: 600;">Ruang Rapat Senat Lt. 4</div>
                <div style="font-size: 0.76rem; color: #64748b;">Kapasitas: 50 Orang &bull; VIP</div>
              </div>
              <button onclick="deleteMasterItem(this, 'Ruangan')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
          </ul>
        </div>
        <button onclick="openModalMaster('modalAddRuang')" class="btn" style="width: 100%; margin-top: 18px; background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; padding: 9px; border-radius: 8px; font-weight: 600; font-size: 0.82rem; cursor: pointer;">
          <i class="fas fa-plus"></i> Tambah Ruangan
        </button>
      </div>

      <!-- 3. Periode Yudisium -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px;">
              <i class="fas fa-calendar-check" style="color: #f59e0b;"></i> Periode Yudisium
            </h3>
            <span class="badge badge-bimbingan" id="badgeCountPeriode">3 Periode</span>
          </div>
          <p style="color: #64748b; font-size: 0.82rem; margin-bottom: 14px;">Gelombang kelulusan sarjana tahun akademik aktif.</p>
          <ul id="listPeriode" style="list-style: none; padding: 0; margin: 0; font-size: 0.85rem; color: #334155;">
            <li style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <div style="font-weight: 600;">Ganjil Gelombang I (Okt 2026)</div>
                <div style="font-size: 0.76rem; color: #16a34a;">Status: Sedang Berjalan</div>
              </div>
              <button onclick="deleteMasterItem(this, 'Periode')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
            <li style="padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <div style="font-weight: 600;">Ganjil Gelombang II (Des 2026)</div>
                <div style="font-size: 0.76rem; color: #64748b;">Batas Daftar: 15 Des 2026</div>
              </div>
              <button onclick="deleteMasterItem(this, 'Periode')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
            <li style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center;">
              <div>
                <div style="font-weight: 600;">Genap Gelombang I (Apr 2027)</div>
                <div style="font-size: 0.76rem; color: #64748b;">Mendatang</div>
              </div>
              <button onclick="deleteMasterItem(this, 'Periode')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>
            </li>
          </ul>
        </div>
        <button onclick="openModalMaster('modalAddPeriode')" class="btn" style="width: 100%; margin-top: 18px; background: #fffbeb; color: #d97706; border: 1px solid #fde68a; padding: 9px; border-radius: 8px; font-weight: 600; font-size: 0.82rem; cursor: pointer;">
          <i class="fas fa-plus"></i> Tambah Periode
        </button>
      </div>
    </div>
  </div>

  <!-- MODAL TAMBAH BIDANG RISET -->
  <div id="modalAddRiset" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 480px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-microscope" style="color: #0284c7; margin-right: 8px;"></i> Tambah Bidang Kajian Riset</h3>
        <button type="button" onclick="closeModal('modalAddRiset')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form onsubmit="submitAddRiset(event)" style="padding: 24px;">
        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Nama Bidang Riset</label>
          <input type="text" id="inputNamaRiset" required placeholder="Contoh: Internet of Things (IoT) & Embedded System" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>
        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Keterangan / Fokus Topik</label>
          <textarea id="inputDescRiset" rows="3" placeholder="Deskripsi ringkas fokus kajian..." style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;"></textarea>
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalAddRiset')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #0284c7; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL TAMBAH RUANGAN -->
  <div id="modalAddRuang" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 480px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-door-open" style="color: #10b981; margin-right: 8px;"></i> Tambah Ruangan Ujian</h3>
        <button type="button" onclick="closeModal('modalAddRuang')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form onsubmit="submitAddRuang(event)" style="padding: 24px;">
        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Nama Ruangan</label>
          <input type="text" id="inputNamaRuang" required placeholder="Contoh: Lab Komputer 3 Lt. 2" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>
        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Kapasitas &amp; Fasilitas</label>
          <input type="text" id="inputFasilitasRuang" placeholder="Contoh: Kapasitas 25 Orang, Smart TV, AC" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalAddRuang')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #10b981; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL TAMBAH PERIODE -->
  <div id="modalAddPeriode" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 480px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-calendar-check" style="color: #f59e0b; margin-right: 8px;"></i> Tambah Periode Yudisium</h3>
        <button type="button" onclick="closeModal('modalAddPeriode')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form onsubmit="submitAddPeriode(event)" style="padding: 24px;">
        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Nama Gelombang / Periode</label>
          <input type="text" id="inputNamaPeriode" required placeholder="Contoh: Genap Gelombang II (Juli 2027)" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>
        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Batas Waktu Pendaftaran</label>
          <input type="date" id="inputBatasPeriode" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalAddPeriode')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #d97706; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModalMaster(id) {
      document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
      document.getElementById(id).style.display = 'none';
    }

    function deleteMasterItem(btn, jenis) {
      const li = btn.closest('li');
      li.remove();
      showToast('Data ' + jenis + ' berhasil dihapus!', 'info');
    }

    function submitAddRiset(e) {
      e.preventDefault();
      const val = document.getElementById('inputNamaRiset').value;
      const ul = document.getElementById('listRiset');
      const li = document.createElement('li');
      li.style = 'padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;';
      li.innerHTML = '<span>&bull; ' + val + '</span><button onclick="deleteMasterItem(this, \'Bidang Riset\')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>';
      ul.appendChild(li);
      closeModal('modalAddRiset');
      showToast('Bidang riset "' + val + '" berhasil ditambahkan!', 'success');
      document.getElementById('inputNamaRiset').value = '';
    }

    function submitAddRuang(e) {
      e.preventDefault();
      const nama = document.getElementById('inputNamaRuang').value;
      const fas = document.getElementById('inputFasilitasRuang').value || 'Standar Ujian';
      const ul = document.getElementById('listRuang');
      const li = document.createElement('li');
      li.style = 'padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;';
      li.innerHTML = '<div><div style="font-weight: 600;">' + nama + '</div><div style="font-size: 0.76rem; color: #64748b;">' + fas + '</div></div><button onclick="deleteMasterItem(this, \'Ruangan\')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>';
      ul.appendChild(li);
      closeModal('modalAddRuang');
      showToast('Ruangan "' + nama + '" berhasil ditambahkan!', 'success');
      document.getElementById('inputNamaRuang').value = '';
    }

    function submitAddPeriode(e) {
      e.preventDefault();
      const nama = document.getElementById('inputNamaPeriode').value;
      const ul = document.getElementById('listPeriode');
      const li = document.createElement('li');
      li.style = 'padding: 10px 0; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;';
      li.innerHTML = '<div><div style="font-weight: 600;">' + nama + '</div><div style="font-size: 0.76rem; color: #16a34a;">Status: Baru Ditambahkan</div></div><button onclick="deleteMasterItem(this, \'Periode\')" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash-alt"></i></button>';
      ul.appendChild(li);
      closeModal('modalAddPeriode');
      showToast('Periode "' + nama + '" berhasil ditambahkan!', 'success');
      document.getElementById('inputNamaPeriode').value = '';
    }

    window.onclick = function(e) {
      if (e.target.classList.contains('modal-overlay')) {
        e.target.style.display = 'none';
      }
    };
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
