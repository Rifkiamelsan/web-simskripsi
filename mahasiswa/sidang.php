<?php
/**
 * MAHASISWA - PENDAFTARAN & JADWAL SIDANG SKRIPSI (MUNAQASYAH)
 * SIMSKRIPSI Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['mahasiswa', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$pageTitle = "Sidang Skripsi - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Sidang Skripsi', 'url' => '']
];

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Sidang Skripsi (Munaqasyah)</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Tahap akhir evaluasi karya ilmiah dan penentuan gelar kesarjanaan Anda</p>
      </div>
      <button onclick="openModalDaftarSidang()" class="btn btn-primary" style="background: #16a34a; padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; color: white; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fas fa-file-signature"></i> Daftar Sidang Skripsi
      </button>
    </div>

    <!-- Stepper Status Card -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; margin-bottom: 24px;">
      <h3 style="font-size: 0.95rem; font-weight: 700; color: #0f172a; margin-bottom: 16px;">Alur &amp; Milestone Menuju Sidang Skripsi</h3>
      
      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px;">
        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 16px;">
          <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
            <span style="width: 24px; height: 24px; border-radius: 50%; background: #16a34a; color: white; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;"><i class="fas fa-check"></i></span>
            <span style="font-weight: 700; font-size: 0.88rem; color: #15803d;">1. Seminar Proposal</span>
          </div>
          <div style="font-size: 0.78rem; color: #166534;">Lulus Ujian Sempro &bull; Nilai: 82.5 (A-)</div>
        </div>

        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 16px;">
          <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
            <span style="width: 24px; height: 24px; border-radius: 50%; background: #16a34a; color: white; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;"><i class="fas fa-check"></i></span>
            <span style="font-weight: 700; font-size: 0.88rem; color: #15803d;">2. Logbook Bimbingan</span>
          </div>
          <div style="font-size: 0.78rem; color: #166534;">8 Sesi Bimbingan Selesai &bull; ACC Pembimbing</div>
        </div>

        <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 16px;">
          <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
            <span style="width: 24px; height: 24px; border-radius: 50%; background: #0284c7; color: white; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">3</span>
            <span style="font-weight: 700; font-size: 0.88rem; color: #0284c7;">3. Berkas Pendaftaran</span>
          </div>
          <div style="font-size: 0.78rem; color: #0369a1;" id="step3Status">Formulir pendaftaran sidang dibuka</div>
        </div>

        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px;">
          <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
            <span style="width: 24px; height: 24px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">4</span>
            <span style="font-weight: 700; font-size: 0.88rem; color: #64748b;">4. Pelaksanaan Sidang</span>
          </div>
          <div style="font-size: 0.78rem; color: #94a3b8;">Menunggu penetapan dewan penguji</div>
        </div>
      </div>
    </div>

    <!-- Requirements Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <!-- Syarat Dokumen Checklist -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px;">
        <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
          <i class="fas fa-clipboard-check" style="color: #16a34a;"></i> Checklist Persyaratan Sidang
        </h3>
        
        <div style="display: flex; flex-direction: column; gap: 12px; font-size: 0.85rem;">
          <div style="display: flex; align-items: center; gap: 12px; padding: 10px; background: #f8fafc; border-radius: 8px;">
            <i class="fas fa-check-circle" style="color: #16a34a; font-size: 1.1rem;"></i>
            <div style="flex: 1;">
              <div style="font-weight: 600; color: #0f172a;">Lulus Ujian Seminar Proposal</div>
              <div style="font-size: 0.75rem; color: #64748b;">Nilai seminar terverifikasi di SIAKAD</div>
            </div>
            <span class="badge badge-disetujui">Lengkap</span>
          </div>

          <div style="display: flex; align-items: center; gap: 12px; padding: 10px; background: #f8fafc; border-radius: 8px;">
            <i class="fas fa-check-circle" style="color: #16a34a; font-size: 1.1rem;"></i>
            <div style="flex: 1;">
              <div style="font-weight: 600; color: #0f172a;">SKS Tempuh &ge; 138 SKS</div>
              <div style="font-size: 0.75rem; color: #64748b;">Total 138 SKS telah diselesaikan (IPK 3.82)</div>
            </div>
            <span class="badge badge-disetujui">Lengkap</span>
          </div>

          <div style="display: flex; align-items: center; gap: 12px; padding: 10px; background: #f8fafc; border-radius: 8px;">
            <i class="fas fa-check-circle" style="color: #16a34a; font-size: 1.1rem;"></i>
            <div style="flex: 1;">
              <div style="font-weight: 600; color: #0f172a;">Bebas Plagiasi Turnitin &le; 20%</div>
              <div style="font-size: 0.75rem; color: #64748b;">Hasil similarity check: 14% (Lolos standar)</div>
            </div>
            <span class="badge badge-disetujui">Lengkap</span>
          </div>

          <div style="display: flex; align-items: center; gap: 12px; padding: 10px; background: #f8fafc; border-radius: 8px;">
            <i class="fas fa-check-circle" style="color: #16a34a; font-size: 1.1rem;"></i>
            <div style="flex: 1;">
              <div style="font-weight: 600; color: #0f172a;">ACC Naskah Lengkap (Bab 1 - 5)</div>
              <div style="font-size: 0.75rem; color: #64748b;">Disetujui oleh Dosen Pembimbing Dr. Ahmad, M.Kom</div>
            </div>
            <span class="badge badge-disetujui">Lengkap</span>
          </div>
        </div>
      </div>

      <!-- Panduan Pelaksanaan Sidang -->
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
          <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-info-circle" style="color: #0284c7;"></i> Panduan Pelaksanaan Sidang
          </h3>
          
          <ul style="list-style: none; padding: 0; margin: 0; font-size: 0.85rem; color: #334155; display: flex; flex-direction: column; gap: 10px;">
            <li style="display: flex; gap: 10px;">
              <i class="fas fa-user-tie" style="color: #0284c7; margin-top: 3px;"></i>
              <div><strong>Tata Busana:</strong> Kemeja putih lengan panjang, dasi hitam, jas almamater UMB, celana/rok kain hitam.</div>
            </li>
            <li style="display: flex; gap: 10px;">
              <i class="fas fa-clock" style="color: #0284c7; margin-top: 3px;"></i>
              <div><strong>Durasi Sidang:</strong> 60 - 90 menit (20 menit presentasi hasil, 50 menit tanya jawab dewan penguji, 10 menit rekapitulasi nilai).</div>
            </li>
            <li style="display: flex; gap: 10px;">
              <i class="fas fa-file-powerpoint" style="color: #0284c7; margin-top: 3px;"></i>
              <div><strong>Slide Presentasi:</strong> Maksimal 15 slide ringkas meliputi latar belakang, metodologi, implementasi sistem, dan hasil evaluasi.</div>
            </li>
            <li style="display: flex; gap: 10px;">
              <i class="fas fa-laptop-code" style="color: #0284c7; margin-top: 3px;"></i>
              <div><strong>Demo Program:</strong> Siapkan prototipe sistem yang sudah berjalan pada laptop Anda sebelum sidang dimulai.</div>
            </li>
          </ul>
        </div>

        <button onclick="openModalDaftarSidang()" class="btn" style="width: 100%; margin-top: 20px; background: #eff6ff; color: #0284c7; border: 1px solid #bfdbfe; padding: 10px; border-radius: 8px; font-weight: 600; font-size: 0.84rem; cursor: pointer;">
          <i class="fas fa-arrow-right"></i> Lanjut Isi Formulir Pendaftaran Sidang
        </button>
      </div>
    </div>
  </div>

  <!-- MODAL FORMULIR DAFTAR SIDANG -->
  <div id="modalDaftarSidang" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 560px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-file-signature" style="color: #16a34a; margin-right: 8px;"></i> Formulir Pendaftaran Sidang Skripsi</h3>
        <button type="button" onclick="closeModal('modalDaftarSidang')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form onsubmit="submitDaftarSidang(event)" style="padding: 24px;">
        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Judul Skripsi Lengkap</label>
          <input type="text" value="Implementasi Web Service dan Web Semantik pada Sistem Informasi Akademik" readonly style="width: 100%; padding: 9px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.86rem; color: #334155; font-weight: 600;">
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Unggah Naskah Skripsi Final (Bab 1 s/d Bab 5 PDF)</label>
          <input type="file" required accept=".pdf" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.82rem;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px;">
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Lembar ACC Pembimbing (PDF)</label>
            <input type="file" required accept=".pdf" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.82rem;">
          </div>
          <div>
            <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Sertifikat Bebas Turnitin (PDF)</label>
            <input type="file" required accept=".pdf" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.82rem;">
          </div>
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Periode Yudisium yang Dituju</label>
          <select style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem; background: white;">
            <option value="1">Ganjil Gelombang I (Oktober 2026)</option>
            <option value="2">Ganjil Gelombang II (Desember 2026)</option>
          </select>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalDaftarSidang')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #16a34a; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">
            <i class="fas fa-check"></i> Ajukan Berkas Sidang
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModalDaftarSidang() {
      document.getElementById('modalDaftarSidang').style.display = 'flex';
    }

    function closeModal(id) {
      document.getElementById(id).style.display = 'none';
    }

    function submitDaftarSidang(e) {
      e.preventDefault();
      closeModal('modalDaftarSidang');
      document.getElementById('step3Status').innerHTML = '<span style="color: #16a34a; font-weight: 600;"><i class="fas fa-check"></i> Berkas Diajukan &bull; Menunggu Verifikasi</span>';
      showToast('Pendaftaran sidang skripsi berhasil diajukan! Menunggu jadwal dari Kaprodi.', 'success');
    }

    window.onclick = function(e) {
      if (e.target.classList.contains('modal-overlay')) {
        e.target.style.display = 'none';
      }
    };
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
