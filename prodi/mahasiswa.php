<?php
/**
 * PRODI - DATA MAHASISWA & PLOTTING PEMBIMBING
 * SIMSKRIPSI Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['prodi', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';

$pageTitle = "Data Mahasiswa Skripsi - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Mahasiswa', 'url' => '']
];

$proposals = getProposalList();

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Data Mahasiswa Skripsi</h1>
        <p class="page-desc" style="color: #64748b; font-size: 0.88rem; margin-top: 4px;">Pantau progres tugas akhir dan kelola penetapan dosen pembimbing Program Studi</p>
      </div>
      <div style="display: flex; gap: 10px;">
        <button onclick="showToast('Mengekspor daftar mahasiswa skripsi ke Excel...', 'info')" class="btn" style="background: #10b981; color: white; padding: 9px 16px; border-radius: 8px; font-weight: 600; font-size: 0.84rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
          <i class="fas fa-file-excel"></i> Export Excel
        </button>
      </div>
    </div>

    <!-- Stat Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
          <div>
            <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Total Mahasiswa Skripsi</div>
            <div style="font-size: 1.6rem; font-weight: 800; color: #0f172a; margin-top: 4px;"><?= count($proposals) ?></div>
          </div>
          <div style="width: 40px; height: 40px; border-radius: 10px; background: #eff6ff; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
            <i class="fas fa-user-graduate"></i>
          </div>
        </div>
        <div style="font-size: 0.78rem; color: #64748b; margin-top: 8px;">Aktif semester ganjil 2026/2027</div>
      </div>

      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
          <div>
            <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Tahap Bimbingan</div>
            <div style="font-size: 1.6rem; font-weight: 800; color: #0284c7; margin-top: 4px;">2</div>
          </div>
          <div style="width: 40px; height: 40px; border-radius: 10px; background: #f0f9ff; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
            <i class="fas fa-chalkboard-teacher"></i>
          </div>
        </div>
        <div style="font-size: 0.78rem; color: #16a34a; margin-top: 8px;">Konsultasi logbook aktif</div>
      </div>

      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
          <div>
            <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Siap Seminar / Sidang</div>
            <div style="font-size: 1.6rem; font-weight: 800; color: #f59e0b; margin-top: 4px;">2</div>
          </div>
          <div style="width: 40px; height: 40px; border-radius: 10px; background: #fffbeb; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
            <i class="fas fa-microphone"></i>
          </div>
        </div>
        <div style="font-size: 0.78rem; color: #64748b; margin-top: 8px;">Menunggu jadwal ujian</div>
      </div>

      <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 18px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
          <div>
            <div style="color: #64748b; font-size: 0.8rem; font-weight: 500;">Lulus / Yudisium</div>
            <div style="font-size: 1.6rem; font-weight: 800; color: #16a34a; margin-top: 4px;">1</div>
          </div>
          <div style="width: 40px; height: 40px; border-radius: 10px; background: #f0fdf4; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
            <i class="fas fa-award"></i>
          </div>
        </div>
        <div style="font-size: 0.78rem; color: #16a34a; margin-top: 8px;">Selesai masa studi skripsi</div>
      </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
        <div style="display: flex; gap: 12px; flex: 1; max-width: 600px;">
          <div style="position: relative; flex: 1;">
            <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.85rem;"></i>
            <input type="text" id="searchMhs" onkeyup="filterTable()" placeholder="Cari nama mahasiswa, NPM, atau judul..." style="width: 100%; padding: 9px 12px 9px 36px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.85rem; outline: none;">
          </div>
          <select id="filterStatus" onchange="filterTable()" style="padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.85rem; outline: none; background: white;">
            <option value="">Semua Status</option>
            <option value="Diajukan">Diajukan</option>
            <option value="Bimbingan">Bimbingan</option>
            <option value="Seminar">Seminar</option>
            <option value="Sidang">Sidang</option>
            <option value="Disetujui">Disetujui</option>
            <option value="Ditolak">Ditolak</option>
          </select>
        </div>
        <div style="font-size: 0.84rem; color: #64748b;">
          Total: <strong style="color: #0f172a;" id="rowCount"><?= count($proposals) ?></strong> Mahasiswa
        </div>
      </div>

      <div class="table-wrapper" style="overflow-x: auto;">
        <table id="mhsTable" style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #f8fafc;">
              <th style="padding: 12px 14px; width: 45px; color: #475569;">No</th>
              <th style="padding: 12px 14px; color: #475569;">Mahasiswa</th>
              <th style="padding: 12px 14px; width: 32%; color: #475569;">Judul Skripsi</th>
              <th style="padding: 12px 14px; color: #475569;">Dosen Pembimbing</th>
              <th style="padding: 12px 14px; text-align: center; color: #475569;">Tahapan</th>
              <th style="padding: 12px 14px; text-align: center; color: #475569;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach ($proposals as $idx => $p): 
                $badgeClass = 'badge-diajukan';
                if ($p['status'] === 'Bimbingan') $badgeClass = 'badge-bimbingan';
                elseif ($p['status'] === 'Seminar') $badgeClass = 'badge-seminar';
                elseif ($p['status'] === 'Sidang') $badgeClass = 'badge-sidang';
                elseif ($p['status'] === 'Disetujui') $badgeClass = 'badge-disetujui';
                elseif ($p['status'] === 'Ditolak') $badgeClass = 'badge-ditolak';
            ?>
              <tr class="mhs-row" style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                <td style="padding: 14px; color: #64748b;"><?= $no++ ?></td>
                <td style="padding: 14px;">
                  <div style="font-weight: 700; color: #0f172a;" class="col-nama"><?= htmlspecialchars($p['nama']) ?></div>
                  <div style="font-size: 0.78rem; color: #64748b; margin-top: 2px;" class="col-npm">NPM: <?= htmlspecialchars($p['npm']) ?> &bull; <?= htmlspecialchars($p['prodi']) ?></div>
                </td>
                <td style="padding: 14px; color: #334155; line-height: 1.4;" class="col-judul">
                  <?= htmlspecialchars($p['judul']) ?>
                </td>
                <td style="padding: 14px;" class="col-dosen">
                  <div style="color: #0284c7; font-weight: 600; font-size: 0.85rem;">
                    <i class="fas fa-user-tie" style="font-size: 0.8rem; margin-right: 4px;"></i>
                    <span class="txt-pembimbing"><?= htmlspecialchars($p['dosen']) ?></span>
                  </div>
                  <div style="font-size: 0.76rem; color: #94a3b8; margin-top: 3px;">Pembimbing Utama</div>
                </td>
                <td style="padding: 14px; text-align: center;" class="col-status">
                  <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($p['status']) ?></span>
                </td>
                <td style="padding: 14px; text-align: center;">
                  <div style="display: inline-flex; gap: 6px;">
                    <button type="button" onclick="openModalPlotting('<?= htmlspecialchars($p['npm'], ENT_QUOTES) ?>', '<?= htmlspecialchars($p['nama'], ENT_QUOTES) ?>', '<?= htmlspecialchars($p['dosen'], ENT_QUOTES) ?>')" class="btn btn-sm" style="background: #eff6ff; color: #0284c7; border: 1px solid #bfdbfe; padding: 6px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;" title="Plotting Dosen Pembimbing">
                      <i class="fas fa-user-edit"></i> Plotting
                    </button>
                    <button type="button" onclick="openModalProgres('<?= htmlspecialchars($p['nama'], ENT_QUOTES) ?>', '<?= htmlspecialchars($p['npm'], ENT_QUOTES) ?>', '<?= htmlspecialchars($p['judul'], ENT_QUOTES) ?>', '<?= htmlspecialchars($p['status'], ENT_QUOTES) ?>', '<?= htmlspecialchars($p['dosen'], ENT_QUOTES) ?>')" class="btn btn-sm" style="background: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; padding: 6px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;" title="Lihat Detail Progres">
                      <i class="fas fa-chart-line"></i> Progres
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- MODAL PLOTTING DOSEN PEMBIMBING -->
  <div id="modalPlotting" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 520px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-user-tie" style="color: #0284c7; margin-right: 8px;"></i> Plotting Pembimbing</h3>
        <button type="button" onclick="closeModal('modalPlotting')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <form id="formPlotting" onsubmit="submitPlotting(event)" style="padding: 24px;">
        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Mahasiswa</label>
          <input type="text" id="plotMhsDisplay" readonly style="width: 100%; padding: 9px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.86rem; color: #334155; font-weight: 600;">
          <input type="hidden" id="plotNpm">
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Dosen Pembimbing 1 (Utama)</label>
          <select id="plotPembimbing1" required style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem; background: white;">
            <option value="Dr. Ahmad, M.Kom">Dr. Ahmad, M.Kom (Web Semantik / Sistem Informasi)</option>
            <option value="Prof. Dr. Ir. Hendra, M.T">Prof. Dr. Ir. Hendra, M.T (Sistem Cerdas & AI)</option>
            <option value="Dr. Budi Santoso, M.M">Dr. Budi Santoso, M.M (Sistem Informasi Manajemen)</option>
            <option value="Bambang Trianto, M.Cs">Bambang Trianto, M.Cs (Jaringan & Cloud)</option>
          </select>
        </div>

        <div style="margin-bottom: 16px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Dosen Pembimbing 2 (Pendamping - Opsional)</label>
          <select id="plotPembimbing2" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem; background: white;">
            <option value="">-- Tidak Ada / Tunggal --</option>
            <option value="Dr. Ahmad, M.Kom">Dr. Ahmad, M.Kom</option>
            <option value="Prof. Dr. Ir. Hendra, M.T">Prof. Dr. Ir. Hendra, M.T</option>
            <option value="Dr. Budi Santoso, M.M">Dr. Budi Santoso, M.M</option>
            <option value="Bambang Trianto, M.Cs">Bambang Trianto, M.Cs</option>
          </select>
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 0.82rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Nomor Surat Keputusan (SK) Prodi</label>
          <input type="text" id="plotNomorSk" value="SK-FT/SKRIPSI/2026/042" placeholder="Contoh: SK-FT/SKRIPSI/2026/042" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.86rem;">
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" onclick="closeModal('modalPlotting')" style="padding: 9px 16px; border: 1px solid #cbd5e1; background: white; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Batal</button>
          <button type="submit" style="padding: 9px 18px; border: none; background: #0284c7; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: white; cursor: pointer;">
            <i class="fas fa-check"></i> Simpan Penetapan
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL DETAIL PROGRES MAHASISWA -->
  <div id="modalProgres" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.6); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="modal-box" style="background: white; border-radius: 14px; width: 100%; max-width: 600px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
      <div style="padding: 18px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a;"><i class="fas fa-tasks" style="color: #0284c7; margin-right: 8px;"></i> Tracking Progres Skripsi</h3>
        <button type="button" onclick="closeModal('modalProgres')" style="background: none; border: none; font-size: 1.2rem; color: #94a3b8; cursor: pointer;">&times;</button>
      </div>
      <div style="padding: 24px;">
        <div style="background: #f8fafc; border-radius: 10px; padding: 16px; margin-bottom: 20px;">
          <div style="font-weight: 700; font-size: 1rem; color: #0f172a;" id="progNama">Siti Rahmawati</div>
          <div style="font-size: 0.8rem; color: #64748b; margin-top: 2px;" id="progNpmDosen">NPM: 221010002 &bull; Pembimbing: Dr. Ahmad, M.Kom</div>
          <div style="font-size: 0.82rem; color: #334155; margin-top: 8px; font-style: italic;" id="progJudul">"Implementasi Web Service dan Web Semantik"</div>
        </div>

        <h4 style="font-size: 0.88rem; font-weight: 700; color: #475569; margin-bottom: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Milestone Alur Skripsi</h4>
        
        <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px;">
          <div style="display: flex; gap: 14px; align-items: flex-start;">
            <div style="width: 28px; height: 28px; border-radius: 50%; background: #16a34a; color: white; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; flex-shrink: 0;">
              <i class="fas fa-check"></i>
            </div>
            <div>
              <div style="font-weight: 600; font-size: 0.86rem; color: #0f172a;">1. Pengajuan Judul & Proposal</div>
              <div style="font-size: 0.78rem; color: #16a34a;">Disetujui oleh Program Studi</div>
            </div>
          </div>

          <div style="display: flex; gap: 14px; align-items: flex-start;">
            <div style="width: 28px; height: 28px; border-radius: 50%; background: #0284c7; color: white; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; flex-shrink: 0;">
              <i class="fas fa-spinner fa-spin"></i>
            </div>
            <div>
              <div style="font-weight: 600; font-size: 0.86rem; color: #0f172a;">2. Bimbingan & Logbook</div>
              <div style="font-size: 0.78rem; color: #0284c7;" id="progLogInfo">2 Konsultasi Tercatat &bull; Rekomendasi Seminar Siap</div>
            </div>
          </div>

          <div style="display: flex; gap: 14px; align-items: flex-start;">
            <div style="width: 28px; height: 28px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; flex-shrink: 0;">
              3
            </div>
            <div>
              <div style="font-weight: 600; font-size: 0.86rem; color: #64748b;">3. Seminar Proposal</div>
              <div style="font-size: 0.78rem; color: #94a3b8;">Jadwal & Penguji menunggu verifikasi</div>
            </div>
          </div>

          <div style="display: flex; gap: 14px; align-items: flex-start;">
            <div style="width: 28px; height: 28px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; flex-shrink: 0;">
              4
            </div>
            <div>
              <div style="font-weight: 600; font-size: 0.86rem; color: #64748b;">4. Sidang Skripsi (Munaqasyah)</div>
              <div style="font-size: 0.78rem; color: #94a3b8;">Tahap akhir kelulusan sarjana</div>
            </div>
          </div>
        </div>

        <div style="display: flex; justify-content: flex-end;">
          <button type="button" onclick="closeModal('modalProgres')" style="padding: 9px 18px; border: 1px solid #cbd5e1; background: #f8fafc; border-radius: 8px; font-size: 0.84rem; font-weight: 600; color: #475569; cursor: pointer;">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    let activePlotNpm = null;

    function openModalPlotting(npm, nama, dosen) {
      activePlotNpm = npm;
      document.getElementById('plotNpm').value = npm;
      document.getElementById('plotMhsDisplay').value = nama + ' (' + npm + ')';
      
      const select1 = document.getElementById('plotPembimbing1');
      for (let i = 0; i < select1.options.length; i++) {
        if (select1.options[i].value === dosen) {
          select1.selectedIndex = i;
          break;
        }
      }
      
      const modal = document.getElementById('modalPlotting');
      modal.style.display = 'flex';
    }

    function openModalProgres(nama, npm, judul, status, dosen) {
      document.getElementById('progNama').innerText = nama;
      document.getElementById('progNpmDosen').innerText = 'NPM: ' + npm + ' • Pembimbing: ' + dosen;
      document.getElementById('progJudul').innerText = '"' + judul + '"';
      
      const modal = document.getElementById('modalProgres');
      modal.style.display = 'flex';
    }

    function closeModal(id) {
      document.getElementById(id).style.display = 'none';
    }

    function submitPlotting(e) {
      e.preventDefault();
      const npm = document.getElementById('plotNpm').value;
      const dosenBaru = document.getElementById('plotPembimbing1').value;
      
      const rows = document.querySelectorAll('.mhs-row');
      rows.forEach(r => {
        const npmText = r.querySelector('.col-npm').innerText;
        if (npmText.includes(npm)) {
          r.querySelector('.txt-pembimbing').innerText = dosenBaru;
        }
      });
      
      closeModal('modalPlotting');
      showToast('Dosen pembimbing untuk ' + npm + ' berhasil diperbarui ke ' + dosenBaru + '!', 'success');
    }

    function filterTable() {
      const q = document.getElementById('searchMhs').value.toLowerCase();
      const st = document.getElementById('filterStatus').value.toLowerCase();
      const rows = document.querySelectorAll('.mhs-row');
      let visible = 0;

      rows.forEach(r => {
        const nama = r.querySelector('.col-nama').innerText.toLowerCase();
        const npm = r.querySelector('.col-npm').innerText.toLowerCase();
        const judul = r.querySelector('.col-judul').innerText.toLowerCase();
        const status = r.querySelector('.col-status').innerText.toLowerCase();
        
        const matchText = (nama.includes(q) || npm.includes(q) || judul.includes(q));
        const matchStatus = (st === '' || status.includes(st));

        if (matchText && matchStatus) {
          r.style.display = '';
          visible++;
        } else {
          r.style.display = 'none';
        }
      });

      document.getElementById('rowCount').innerText = visible;
    }

    window.onclick = function(e) {
      if (e.target.classList.contains('modal-overlay')) {
        e.target.style.display = 'none';
      }
    };
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
