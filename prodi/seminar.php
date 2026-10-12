<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['prodi', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';
$pageTitle = "Seminar Proposal - SIMSKRIPSI UMB";
$breadcrumb = [['label' => 'Dashboard', 'url' => 'dashboard.php'],['label' => 'Seminar Proposal', 'url' => '']];
require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;">
      <div>
        <h1 style="font-size:1.4rem;font-weight:700;color:#0f172a;">Seminar Proposal Mahasiswa</h1>
        <p style="color:#64748b;font-size:0.88rem;margin-top:4px;">Kelola jadwal, dewan penguji, dan keputusan ujian seminar proposal</p>
      </div>
      <button onclick="openModalSeminar()" style="background:#0284c7;padding:10px 18px;border-radius:8px;font-weight:600;font-size:0.85rem;color:white;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;">
        <i class="fas fa-calendar-plus"></i> Tambah Jadwal
      </button>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px;">
      <div style="background:white;border-radius:12px;padding:18px;border:1px solid #e2e8f0;display:flex;align-items:center;gap:14px;">
        <div style="width:44px;height:44px;border-radius:10px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;font-size:1.1rem;"><i class="fas fa-microphone"></i></div>
        <div><div style="font-size:1.4rem;font-weight:800;color:#0f172a;">2</div><div style="font-size:0.75rem;color:#64748b;">Terjadwal</div></div>
      </div>
      <div style="background:white;border-radius:12px;padding:18px;border:1px solid #e2e8f0;display:flex;align-items:center;gap:14px;">
        <div style="width:44px;height:44px;border-radius:10px;background:#f0fdf4;color:#16a34a;display:flex;align-items:center;justify-content:center;font-size:1.1rem;"><i class="fas fa-check-circle"></i></div>
        <div><div style="font-size:1.4rem;font-weight:800;color:#0f172a;">1</div><div style="font-size:0.75rem;color:#64748b;">Lulus Seminar</div></div>
      </div>
      <div style="background:white;border-radius:12px;padding:18px;border:1px solid #e2e8f0;display:flex;align-items:center;gap:14px;">
        <div style="width:44px;height:44px;border-radius:10px;background:#fff7ed;color:#ea580c;display:flex;align-items:center;justify-content:center;font-size:1.1rem;"><i class="fas fa-clock"></i></div>
        <div><div style="font-size:1.4rem;font-weight:800;color:#0f172a;">1</div><div style="font-size:0.75rem;color:#64748b;">Menunggu Jadwal</div></div>
      </div>
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
              <th style="padding:12px 14px;">Dewan Penguji</th>
              <th style="padding:12px 14px;">Status</th>
              <th style="padding:12px 14px;text-align:center;">Aksi</th>
            </tr>
          </thead>
          <tbody id="seminarTbody">
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px;color:#64748b;">221010004</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">Dela Anggraini</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">15-10-2026 (09:00 WIB)</td>
              <td style="padding:14px;color:#64748b;">Ruang Seminar A Lt. 2</td>
              <td style="padding:14px;color:#334155;font-size:0.82rem;">Dr. Ahmad &bull; Dr. Budi</td>
              <td style="padding:14px;"><span class="badge badge-seminar">Terjadwal</span></td>
              <td style="padding:14px;text-align:center;"><div style="display:flex;gap:6px;justify-content:center;"><button onclick="lulusSeminar(this,&apos;Dela Anggraini&apos;)" style="background:#10b981;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-check"></i> Lulus</button><button onclick="revisiSeminar(this,&apos;Dela Anggraini&apos;)" style="background:#ef4444;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-times"></i> Revisi</button></div></td>
            </tr>
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px;color:#64748b;">221010002</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">Siti Rahmawati</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">25-10-2026 (09:30 WIB)</td>
              <td style="padding:14px;color:#64748b;">Ruang Seminar FT Lt. 2</td>
              <td style="padding:14px;color:#334155;font-size:0.82rem;">Prof. Hendra &bull; Dr. Budi</td>
              <td style="padding:14px;"><span class="badge badge-disetujui">Siap Ujian</span></td>
              <td style="padding:14px;text-align:center;"><div style="display:flex;gap:6px;justify-content:center;"><button onclick="lulusSeminar(this,&apos;Siti Rahmawati&apos;)" style="background:#10b981;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-check"></i> Lulus</button><button onclick="revisiSeminar(this,&apos;Siti Rahmawati&apos;)" style="background:#ef4444;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-times"></i> Revisi</button></div></td>
            </tr>
            <tr>
              <td style="padding:14px;color:#64748b;">221010006</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">Fajar Nugraha</td>
              <td style="padding:14px;color:#94a3b8;">Belum dijadwalkan</td>
              <td style="padding:14px;color:#94a3b8;">-</td>
              <td style="padding:14px;color:#94a3b8;">-</td>
              <td style="padding:14px;"><span class="badge badge-bimbingan">Menunggu Jadwal</span></td>
              <td style="padding:14px;text-align:center;"><button onclick="openModalSeminar()" style="background:#0284c7;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-calendar-plus"></i> Jadwalkan</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal-overlay" id="modalSeminar">
    <div class="modal-box" style="max-width:520px;">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-calendar-plus" style="color:#0284c7;margin-right:8px;"></i>Jadwalkan Seminar Proposal</h3>
        <button class="modal-close" onclick="closeModalSeminar()">&times;</button>
      </div>
      <form onsubmit="handleTambahSeminar(event)">
        <div class="form-group"><label class="form-label">Nama Mahasiswa</label><input type="text" id="smrNama" class="form-control" required placeholder="Nama lengkap mahasiswa"></div>
        <div class="form-group"><label class="form-label">NPM</label><input type="text" id="smrNpm" class="form-control" required placeholder="NPM mahasiswa"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div class="form-group"><label class="form-label">Tanggal</label><input type="date" id="smrTgl" class="form-control" required></div>
          <div class="form-group"><label class="form-label">Jam Mulai</label><input type="time" id="smrJam" class="form-control" required value="09:00"></div>
        </div>
        <div class="form-group"><label class="form-label">Ruangan</label><input type="text" id="smrRuang" class="form-control" required placeholder="Ruang Seminar A Lt. 2"></div>
        <div class="form-group"><label class="form-label">Dosen Penguji 1</label><input type="text" id="smrP1" class="form-control" required placeholder="Nama Dosen Penguji 1"></div>
        <div class="form-group"><label class="form-label">Dosen Penguji 2</label><input type="text" id="smrP2" class="form-control" required placeholder="Nama Dosen Penguji 2"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalSeminar()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background:#0284c7;">Simpan Jadwal</button>
        </div>
      </form>
    </div>
  </div>
  <script>
  function openModalSeminar(){document.getElementById("modalSeminar").classList.add("open");}
  function closeModalSeminar(){document.getElementById("modalSeminar").classList.remove("open");}
  function handleTambahSeminar(e){
    e.preventDefault();
    var nama=document.getElementById("smrNama").value;
    var npm=document.getElementById("smrNpm").value;
    var tgl=document.getElementById("smrTgl").value;
    var jam=document.getElementById("smrJam").value;
    var ruang=document.getElementById("smrRuang").value;
    var p1=document.getElementById("smrP1").value;
    var p2=document.getElementById("smrP2").value;
    var tbody=document.getElementById("seminarTbody");
    var tglFmt=tgl.split("-").reverse().join("-");
    var tr=document.createElement("tr");
    tr.style.borderBottom="1px solid #f1f5f9";
    tr.innerHTML="<td style=\"padding:14px;color:#64748b;\">"+npm+"</td><td style=\"padding:14px;font-weight:600;color:#0f172a;\">"+nama+"</td><td style=\"padding:14px;font-weight:600;color:#0f172a;\">"+tglFmt+" ("+jam+" WIB)</td><td style=\"padding:14px;color:#64748b;\">"+ruang+"</td><td style=\"padding:14px;color:#334155;font-size:0.82rem;\">"+p1+" &bull; "+p2+"</td><td style=\"padding:14px;\"><span class=\"badge badge-seminar\">Terjadwal</span></td><td style=\"padding:14px;text-align:center;\"><div style=\"display:flex;gap:6px;justify-content:center;\"><button onclick=\"lulusSeminar(this,'"+nama+"')\" style=\"background:#10b981;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;\"><i class=\"fas fa-check\"></i> Lulus</button><button onclick=\"revisiSeminar(this,'"+nama+"')\" style=\"background:#ef4444;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;\"><i class=\"fas fa-times\"></i> Revisi</button></div></td>";
    tbody.appendChild(tr);closeModalSeminar();e.target.reset();
    showToast("Jadwal seminar "+nama+" berhasil ditambahkan!","success");
  }
  function lulusSeminar(btn,nama){
    var row=btn.closest("tr");row.querySelector(".badge").className="badge badge-disetujui";row.querySelector(".badge").textContent="Lulus Seminar";
    btn.closest("div").innerHTML="<span style=\"color:#16a34a;font-weight:600;font-size:0.82rem;\"><i class=\"fas fa-check-circle\"></i> Lulus</span>";
    showToast(nama+" dinyatakan Lulus Seminar Proposal!","success");
  }
  function revisiSeminar(btn,nama){
    var row=btn.closest("tr");row.querySelector(".badge").className="badge badge-revisi";row.querySelector(".badge").textContent="Perlu Revisi";
    showToast(nama+" diminta melakukan revisi.","warning");
  }
  </script>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
</main>