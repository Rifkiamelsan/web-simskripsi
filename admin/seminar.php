<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';
$pageTitle = "Data Seminar Proposal - SIMSKRIPSI UMB";
$breadcrumb = [['label' => 'Dashboard', 'url' => 'dashboard.php'], ['label' => 'Seminar', 'url' => '']];
require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;">
      <div>
        <h1 style="font-size:1.4rem;font-weight:700;color:#0f172a;">Jadwal &amp; Peserta Seminar Proposal</h1>
        <p style="color:#64748b;font-size:0.88rem;margin-top:4px;">Kelola penetapan ruang, dewan penguji, dan keputusan seminar proposal</p>
      </div>
      <button onclick="openModalSeminarAdmin()" style="background:#0284c7;padding:10px 18px;border-radius:8px;font-weight:600;font-size:0.85rem;color:white;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;">
        <i class="fas fa-calendar-plus"></i> Tambah Jadwal Seminar
      </button>
    </div>
    <div class="card" style="background:white;border-radius:12px;border:1px solid #e2e8f0;padding:22px;box-shadow:0 2px 10px rgba(0,0,0,0.03);">
      <div class="table-wrapper">
        <table style="width:100%;border-collapse:collapse;font-size:0.86rem;">
          <thead>
            <tr style="border-bottom:2px solid #f1f5f9;text-align:left;background:#fafafa;">
              <th style="padding:12px 14px;">NPM</th>
              <th style="padding:12px 14px;">Nama Mahasiswa</th>
              <th style="padding:12px 14px;">Tanggal &amp; Waktu</th>
              <th style="padding:12px 14px;">Ruangan</th>
              <th style="padding:12px 14px;">Penguji 1 &amp; 2</th>
              <th style="padding:12px 14px;">Status</th>
              <th style="padding:12px 14px;text-align:center;">Aksi</th>
            </tr>
          </thead>
          <tbody id="adminSeminarTbody">
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px;color:#64748b;">221010004</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">Dela Anggraini</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">15-10-2026 (09:00 WIB)</td>
              <td style="padding:14px;color:#64748b;">Ruang Seminar A Lt. 2</td>
              <td style="padding:14px;color:#334155;font-size:0.82rem;">Dr. Ahmad, M.Kom &bull; Dr. Budi Santoso, M.M</td>
              <td style="padding:14px;"><span class="badge badge-seminar">Terjadwal</span></td>
              <td style="padding:14px;text-align:center;"><div style="display:flex;gap:6px;justify-content:center;">
                <button onclick="lulusAdmin(this,'Dela Anggraini')" style="background:#10b981;color:white;padding:6px 11px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-check"></i> Lulus</button>
                <button onclick="revisiAdmin(this,'Dela Anggraini')" style="background:#ef4444;color:white;padding:6px 11px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-times"></i> Revisi</button>
              </div></td>
            </tr>
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px;color:#64748b;">221010002</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">Siti Rahmawati</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">25-10-2026 (09:30 WIB)</td>
              <td style="padding:14px;color:#64748b;">Ruang Seminar FT Lt. 2</td>
              <td style="padding:14px;color:#334155;font-size:0.82rem;">Prof. Dr. Ir. Hendra, M.T &bull; Dr. Budi Santoso</td>
              <td style="padding:14px;"><span class="badge badge-disetujui">Siap Ujian</span></td>
              <td style="padding:14px;text-align:center;"><div style="display:flex;gap:6px;justify-content:center;">
                <button onclick="lulusAdmin(this,'Siti Rahmawati')" style="background:#10b981;color:white;padding:6px 11px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-check"></i> Lulus</button>
                <button onclick="revisiAdmin(this,'Siti Rahmawati')" style="background:#ef4444;color:white;padding:6px 11px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-times"></i> Revisi</button>
              </div></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal-overlay" id="modalSeminarAdmin">
    <div class="modal-box" style="max-width:520px;">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-calendar-plus" style="color:#0284c7;margin-right:8px;"></i>Tambah Jadwal Seminar</h3>
        <button class="modal-close" onclick="closeModalSeminarAdmin()">&times;</button>
      </div>
      <form onsubmit="handleTambahSeminarAdmin(event)">
        <div class="form-group"><label class="form-label">Nama Mahasiswa</label><input type="text" id="asmrNama" class="form-control" required placeholder="Nama lengkap mahasiswa"></div>
        <div class="form-group"><label class="form-label">NPM</label><input type="text" id="asmrNpm" class="form-control" required placeholder="NPM mahasiswa"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div class="form-group"><label class="form-label">Tanggal</label><input type="date" id="asmrTgl" class="form-control" required></div>
          <div class="form-group"><label class="form-label">Jam</label><input type="time" id="asmrJam" class="form-control" required value="09:00"></div>
        </div>
        <div class="form-group"><label class="form-label">Ruangan</label><input type="text" id="asmrRuang" class="form-control" required placeholder="Ruang Seminar A Lt. 2"></div>
        <div class="form-group"><label class="form-label">Dosen Penguji 1</label><input type="text" id="asmrP1" class="form-control" required placeholder="Nama Dosen Penguji 1"></div>
        <div class="form-group"><label class="form-label">Dosen Penguji 2</label><input type="text" id="asmrP2" class="form-control" required placeholder="Nama Dosen Penguji 2"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalSeminarAdmin()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background:#0284c7;">Simpan Jadwal</button>
        </div>
      </form>
    </div>
  </div>
  <script>
  function openModalSeminarAdmin(){document.getElementById("modalSeminarAdmin").classList.add("open");}
  function closeModalSeminarAdmin(){document.getElementById("modalSeminarAdmin").classList.remove("open");}
  function handleTambahSeminarAdmin(e){
    e.preventDefault();
    var nama=document.getElementById("asmrNama").value;var npm=document.getElementById("asmrNpm").value;
    var tgl=document.getElementById("asmrTgl").value;var jam=document.getElementById("asmrJam").value;
    var ruang=document.getElementById("asmrRuang").value;var p1=document.getElementById("asmrP1").value;var p2=document.getElementById("asmrP2").value;
    var tbody=document.getElementById("adminSeminarTbody");var tglFmt=tgl.split("-").reverse().join("-");
    var tr=document.createElement("tr");tr.style.borderBottom="1px solid #f1f5f9";
    tr.innerHTML="<td style=\"padding:14px;color:#64748b;\">"+npm+"</td><td style=\"padding:14px;font-weight:600;color:#0f172a;\">"+nama+"</td><td style=\"padding:14px;font-weight:600;color:#0f172a;\">"+tglFmt+" ("+jam+" WIB)</td><td style=\"padding:14px;color:#64748b;\">"+ruang+"</td><td style=\"padding:14px;color:#334155;font-size:0.82rem;\">"+p1+" &bull; "+p2+"</td><td style=\"padding:14px;\"><span class=\"badge badge-seminar\">Terjadwal</span></td><td style=\"padding:14px;text-align:center;\"><div style=\"display:flex;gap:6px;justify-content:center;\"><button onclick=\"lulusAdmin(this,'"+nama+"')\" style=\"background:#10b981;color:white;padding:6px 11px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;\"><i class=\"fas fa-check\"></i> Lulus</button><button onclick=\"revisiAdmin(this,'"+nama+"')\" style=\"background:#ef4444;color:white;padding:6px 11px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;\"><i class=\"fas fa-times\"></i> Revisi</button></div></td>";
    tbody.appendChild(tr);closeModalSeminarAdmin();e.target.reset();showToast("Jadwal seminar "+nama+" ditambahkan!","success");
  }
  function lulusAdmin(btn,nama){var row=btn.closest("tr");row.querySelector(".badge").className="badge badge-disetujui";row.querySelector(".badge").textContent="Lulus Seminar";btn.closest("div").innerHTML="<span style=\"color:#16a34a;font-weight:600;font-size:0.82rem;\"><i class=\"fas fa-check-circle\"></i> Lulus</span>";showToast(nama+" dinyatakan Lulus Seminar Proposal!","success");}
  function revisiAdmin(btn,nama){var row=btn.closest("tr");row.querySelector(".badge").className="badge badge-revisi";row.querySelector(".badge").textContent="Perlu Revisi";showToast(nama+" diminta revisi.","warning");}
  </script>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
</main>
