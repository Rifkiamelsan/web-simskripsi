<?php
/**
 * ADMIN - JADWAL TERPADU SEMINAR & SIDANG
 * SIMSKRIPSI Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['admin']);
$user = getAuthUser();

$pageTitle = "Jadwal Seminar & Sidang - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Jadwal', 'url' => '']
];

$schedules = [
    [
        'id' => 1,
        'tipe' => 'Seminar Proposal',
        'nama' => 'Siti Rahmawati',
        'npm' => '221010002',
        'judul' => 'Implementasi Web Service dan Web Semantik pada Sistem Informasi Akademik',
        'waktu' => '25 Oktober 2026',
        'jam' => '09:30 - 11:30 WIB',
        'ruang' => 'Ruang Seminar FT Lt. 2',
        'penguji1' => 'Prof. Dr. Ir. Hendra, M.T',
        'penguji2' => 'Dr. Budi Santoso, M.M',
        'pembimbing' => 'Dr. Ahmad, M.Kom',
        'status' => 'Terjadwal'
    ],
    [
        'id' => 2,
        'tipe' => 'Seminar Proposal',
        'nama' => 'Dela Anggraini',
        'npm' => '221010004',
        'judul' => 'Sistem Pendukung Keputusan Pemilihan Dosen Terbaik Menggunakan Metode TOPSIS',
        'waktu' => '28 Oktober 2026',
        'jam' => '13:00 - 15:00 WIB',
        'ruang' => 'Ruang Seminar A Lt. 2',
        'penguji1' => 'Dr. Ahmad, M.Kom',
        'penguji2' => 'Bambang Trianto, M.Cs',
        'pembimbing' => 'Prof. Dr. Ir. Hendra, M.T',
        'status' => 'Terjadwal'
    ],
    [
        'id' => 3,
        'tipe' => 'Sidang Skripsi',
        'nama' => 'Fajar Nugraha',
        'npm' => '221010006',
        'judul' => 'Audit Tata Kelola Teknologi Informasi Menggunakan Framework COBIT 2019',
        'waktu' => '10 November 2026',
        'jam' => '10:00 - 12:00 WIB',
        'ruang' => 'Ruang Sidang B Lt. 3',
        'penguji1' => 'Prof. Dr. Ir. Hendra, M.T',
        'penguji2' => 'Dr. Budi Santoso, M.M',
        'pembimbing' => 'Dr. Ahmad, M.Kom',
        'status' => 'Terjadwal'
    ]
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Jadwal Terpadu Seminar &amp; Sidang</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Agenda lengkap seminar proposal dan sidang munaqasyah skripsi mahasiswa</p>
      </div>
      <button onclick="openModalAddJadwal()" class="btn btn-primary" style="background: #0284c7; padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; color: white; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fas fa-calendar-plus"></i> Tambah Jadwal Ujian
      </button>
    </div>

    <!-- Stat Cards -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Total Agenda Ujian</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin-top: 4px;" id="countTotalJadwal"><?= count($schedules) ?> Sesi</div>
        <div style="font-size: 0.78rem; color: #64748b; margin-top: 6px;">Bulan Oktober - November 2026</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Seminar Proposal</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #0284c7; margin-top: 4px;">2 Mahasiswa</div>
        <div style="font-size: 0.78rem; color: #0284c7; margin-top: 6px;">Penguji &amp; pembimbing siap</div>
      </div>
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Sidang Skripsi (Munaqasyah)</div>
        <div style="font-size: 1.6rem; font-weight: 800; color: #16a34a; margin-top: 4px;">1 Mahasiswa</div>
        <div style="font-size: 0.78rem; color: #16a34a; margin-top: 6px;">Tahap penentuan kelulusan</div>
      </div>
    </div>

    <!-- Schedules Container -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      <div id="jadwalList" style="display: flex; flex-direction: column; gap: 16px;">
        <?php foreach ($schedules as $s): 
            $isSeminar = ($s['tipe'] === 'Seminar Proposal');
            $badgeColor = $isSeminar ? '#0284c7' : '#16a34a';
            $badgeClass = $isSeminar ? 'badge-seminar' : 'badge-disetujui';
        ?>
          <div class="jadwal-item" style="border-left: 4px solid <?= $badgeColor ?>; background: #f8fafc; padding: 18px 22px; border-radius: 0 10px 10px 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
            <div style="flex: 1; min-width: 300px;">
              <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                <span class="badge <?= $badgeClass ?>"><?= $s['tipe'] ?></span>
                <span style="font-weight: 700; color: #0f172a; font-size: 1rem;"><?= htmlspecialchars($s['nama']) ?> (<?= htmlspecialchars($s['npm']) ?>)</span>
              </div>
              <div style="color: #475569; font-size: 0.86rem; line-height: 1.4; margin-bottom: 8px;">
                "<?= htmlspecialchars($s['judul']) ?>"
              </div>
              <div style="display: flex; gap: 18px; font-size: 0.8rem; color: #64748b; flex-wrap: wrap;">
                <span style="color: <?= $badgeColor ?>; font-weight: 600;"><i class="fas fa-calendar-alt"></i> <?= $s['waktu'] ?> &bull; <?= $s['jam'] ?></span>
                <span><i class="fas fa-map-marker-alt"></i> <?= $s['ruang'] ?></span>
                <span><i class="fas fa-user-tie"></i> Penguji: <?= $s['penguji1'] ?>, <?= $s['penguji2'] ?></span>
              </div>
            </div>
            <div style="display: flex; gap: 8px;">
              <button onclick="showToast('Mengunduh Berita Acara Ujian untuk <?= htmlspecialchars($s['nama'], ENT_QUOTES) ?>...', 'info')" class="btn btn-sm" style="background: white; border: 1px solid #cbd5e1; color: #475569; padding: 7px 12px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                <i class="fas fa-file-pdf"></i> Undangan &amp; BA
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- MODAL TAMBAH JADWAL -->
  <div id="modalAddJadwal" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 560px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-calendar-plus" style="color: #0284c7; margin-right: 8px;"></i> Tambah Jadwal Ujian Skripsi</h3>
        <button type="button" onclick="closeModal('modalAddJadwal')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form onsubmit="submitAddJadwal(event)" style="padding: 24px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px;">
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Jenis Ujian</label>
            <select id="jnsUjian" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem; background: white;">
              <option value="Seminar Proposal">Seminar Proposal</option>
              <option value="Sidang Skripsi">Sidang Skripsi</option>
            </select>
          </div>
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Ruangan Ujian</label>
            <select id="jnsRuang" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem; background: white;">
              <option value="Ruang Seminar FT Lt. 2">Ruang Seminar FT Lt. 2</option>
              <option value="Ruang Seminar A Lt. 2">Ruang Seminar A Lt. 2</option>
              <option value="Ruang Sidang B Lt. 3">Ruang Sidang B Lt. 3</option>
            </select>
          </div>
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Mahasiswa Peserta</label>
          <input type="text" id="jnsMhs" required placeholder="Nama Mahasiswa (NPM)" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Judul Skripsi</label>
          <input type="text" id="jnsJudul" required placeholder="Judul naskah..." style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px;">
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Tanggal Ujian</label>
            <input type="date" id="jnsTanggal" required value="2026-10-30" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
          </div>
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Waktu / Jam</label>
            <input type="text" id="jnsWaktu" required value="09:00 - 11:00 WIB" placeholder="09:00 - 11:00 WIB" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px;">
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Dosen Penguji 1</label>
            <input type="text" id="jnsPenguji1" value="Prof. Dr. Ir. Hendra, M.T" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
          </div>
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Dosen Penguji 2</label>
            <input type="text" id="jnsPenguji2" value="Dr. Budi Santoso, M.M" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
          </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalAddJadwal')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #0284c7; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">
            <i class="fas fa-calendar-check"></i> Publikasikan Jadwal
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModalAddJadwal() {
      document.getElementById('modalAddJadwal').style.display = 'flex';
    }

    function closeModal(id) {
      document.getElementById(id).style.display = 'none';
    }

    function submitAddJadwal(e) {
      e.preventDefault();
      const tipe = document.getElementById('jnsUjian').value;
      const ruang = document.getElementById('jnsRuang').value;
      const mhs = document.getElementById('jnsMhs').value;
      const judul = document.getElementById('jnsJudul').value;
      const tgl = document.getElementById('jnsTanggal').value;
      const jam = document.getElementById('jnsWaktu').value;
      const p1 = document.getElementById('jnsPenguji1').value;
      const p2 = document.getElementById('jnsPenguji2').value;

      const isSeminar = (tipe === 'Seminar Proposal');
      const badgeColor = isSeminar ? '#0284c7' : '#16a34a';
      const badgeClass = isSeminar ? 'badge-seminar' : 'badge-disetujui';

      const container = document.getElementById('jadwalList');
      const div = document.createElement('div');
      div.className = 'jadwal-item';
      div.style = 'border-left: 4px solid ' + badgeColor + '; background: #f8fafc; padding: 18px 22px; border-radius: 0 10px 10px 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;';
      div.innerHTML = '<div style="flex: 1; min-width: 300px;"><div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;"><span class="badge ' + badgeClass + '">' + tipe + '</span><span style="font-weight: 700; color: #0f172a; font-size: 1rem;">' + mhs + '</span></div><div style="color: #475569; font-size: 0.86rem; line-height: 1.4; margin-bottom: 8px;">"' + judul + '"</div><div style="display: flex; gap: 18px; font-size: 0.8rem; color: #64748b; flex-wrap: wrap;"><span style="color: ' + badgeColor + '; font-weight: 600;"><i class="fas fa-calendar-alt"></i> ' + tgl + ' &bull; ' + jam + '</span><span><i class="fas fa-map-marker-alt"></i> ' + ruang + '</span><span><i class="fas fa-user-tie"></i> Penguji: ' + p1 + ', ' + p2 + '</span></div></div><div style="display: flex; gap: 8px;"><button onclick="showToast(\'Mengunduh Berita Acara Ujian...\', \'info\')" class="btn btn-sm" style="background: white; border: 1px solid #cbd5e1; color: #475569; padding: 7px 12px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;"><i class="fas fa-file-pdf"></i> Undangan & BA</button></div>';
      
      container.insertBefore(div, container.firstChild);
      closeModal('modalAddJadwal');
      showToast('Jadwal ' + tipe + ' untuk ' + mhs + ' berhasil dipublikasikan!', 'success');
    }

    window.onclick = function(e) {
      if (e.target.classList.contains('modal-overlay')) {
        e.target.style.display = 'none';
      }
    };
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
