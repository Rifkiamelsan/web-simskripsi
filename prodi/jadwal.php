<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['prodi', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';
$pageTitle = "Jadwal Ujian - SIMSKRIPSI UMB";
$breadcrumb = [['label' => 'Dashboard', 'url' => 'dashboard.php'], ['label' => 'Jadwal', 'url' => '']];
require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;">
      <div>
        <h1 style="font-size:1.4rem;font-weight:700;color:#0f172a;">Jadwal Terpadu Ujian Skripsi</h1>
        <p style="color:#64748b;font-size:0.88rem;margin-top:4px;">Agenda seminar proposal dan sidang skripsi Teknik Informatika</p>
      </div>
      <button onclick="openModalJadwal()" style="background:#0284c7;padding:10px 18px;border-radius:8px;font-weight:600;font-size:0.85rem;color:white;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;">
        <i class="fas fa-calendar-plus"></i> Tambah Jadwal
      </button>
    </div>
    <div class="card" style="background:white;border-radius:12px;border:1px solid #e2e8f0;padding:22px;box-shadow:0 2px 10px rgba(0,0,0,0.03);">
      <div style="font-weight:700;color:#0f172a;font-size:0.95rem;margin-bottom:16px;border-bottom:1px solid #f1f5f9;padding-bottom:12px;">Oktober - November 2026</div>
      <div id="jadwalList" style="display:flex;flex-direction:column;gap:14px;">
        <div style="border-left:4px solid #0284c7;background:#f8fafc;padding:16px 20px;border-radius:0 8px 8px 0;display:flex;justify-content:space-between;align-items:center;">
          <div>
            <div style="font-weight:700;color:#0f172a;font-size:0.95rem;">Seminar Proposal - Dela Anggraini (221010004)</div>
            <div style="color:#64748b;font-size:0.82rem;margin-top:4px;">Sistem Pendukung Keputusan Pemilihan Dosen Terbaik</div>
            <div style="color:#0284c7;font-size:0.8rem;font-weight:600;margin-top:6px;"><i class="fas fa-clock"></i> 15 Oktober 2026 &bull; 09:00 WIB &bull; Ruang Seminar A Lt. 2</div>
          </div>
          <span class="badge badge-seminar">Seminar Proposal</span>
        </div>
        <div style="border-left:4px solid #0284c7;background:#f8fafc;padding:16px 20px;border-radius:0 8px 8px 0;display:flex;justify-content:space-between;align-items:center;">
          <div>
            <div style="font-weight:700;color:#0f172a;font-size:0.95rem;">Seminar Proposal - Siti Rahmawati (221010002)</div>
            <div style="color:#64748b;font-size:0.82rem;margin-top:4px;">Implementasi Web Service dan Web Semantik</div>
            <div style="color:#0284c7;font-size:0.8rem;font-weight:600;margin-top:6px;"><i class="fas fa-clock"></i> 25 Oktober 2026 &bull; 09:30 WIB &bull; Ruang Seminar FT Lt. 2</div>
          </div>
          <span class="badge badge-disetujui">Siap Ujian</span>
        </div>
        <div style="border-left:4px solid #16a34a;background:#f8fafc;padding:16px 20px;border-radius:0 8px 8px 0;display:flex;justify-content:space-between;align-items:center;">
          <div>
            <div style="font-weight:700;color:#0f172a;font-size:0.95rem;">Sidang Skripsi - Dela Anggraini (221010004)</div>
            <div style="color:#64748b;font-size:0.82rem;margin-top:4px;">Sistem Pendukung Keputusan Pemilihan Dosen Terbaik</div>
            <div style="color:#16a34a;font-size:0.8rem;font-weight:600;margin-top:6px;"><i class="fas fa-clock"></i> 10 November 2026 &bull; 09:00 WIB &bull; Ruang Sidang A Lt. 2</div>
          </div>
          <span class="badge badge-seminar">Terjadwal</span>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-overlay" id="modalJadwal">
    <div class="modal-box" style="max-width:500px;">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-calendar-plus" style="color:#0284c7;margin-right:8px;"></i>Tambah Jadwal Ujian</h3>
        <button class="modal-close" onclick="closeModalJadwal()">&times;</button>
      </div>
      <form onsubmit="handleTambahJadwal(event)">
        <div class="form-group"><label class="form-label">Jenis Ujian</label><select id="jdlJenis" class="form-control" required><option>Seminar Proposal</option><option>Sidang Skripsi</option></select></div>
        <div class="form-group"><label class="form-label">Nama Mahasiswa &amp; NPM</label><input type="text" id="jdlNama" class="form-control" required placeholder="Nama (NPM)"></div>
        <div class="form-group"><label class="form-label">Judul Skripsi</label><input type="text" id="jdlJudul" class="form-control" required placeholder="Judul penelitian"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div class="form-group"><label class="form-label">Tanggal</label><input type="date" id="jdlTgl" class="form-control" required></div>
          <div class="form-group"><label class="form-label">Jam</label><input type="time" id="jdlJam" class="form-control" required value="09:00"></div>
        </div>
        <div class="form-group"><label class="form-label">Ruangan</label><input type="text" id="jdlRuang" class="form-control" required placeholder="Ruang Seminar A Lt. 2"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalJadwal()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background:#0284c7;">Simpan Jadwal</button>
        </div>
      </form>
    </div>
  </div>
  <script>
  function openModalJadwal(){document.getElementById("modalJadwal").classList.add("open");}
  function closeModalJadwal(){document.getElementById("modalJadwal").classList.remove("open");}
  function handleTambahJadwal(e){
    e.preventDefault();
    var jenis=document.getElementById("jdlJenis").value;var nama=document.getElementById("jdlNama").value;
    var judul=document.getElementById("jdlJudul").value;var tgl=document.getElementById("jdlTgl").value;
    var jam=document.getElementById("jdlJam").value;var ruang=document.getElementById("jdlRuang").value;
    var color=jenis==="Sidang Skripsi"?"#16a34a":"#0284c7";
    var tglParts=tgl.split("-");var months=["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
    var tglFmt=parseInt(tglParts[2])+" "+months[parseInt(tglParts[1])-1]+" "+tglParts[0];
    var div=document.createElement("div");
    div.style.cssText="border-left:4px solid "+color+";background:#f8fafc;padding:16px 20px;border-radius:0 8px 8px 0;display:flex;justify-content:space-between;align-items:center;";
    div.innerHTML="<div><div style=\"font-weight:700;color:#0f172a;font-size:0.95rem;\">"+jenis+" - "+nama+"</div><div style=\"color:#64748b;font-size:0.82rem;margin-top:4px;\">"+judul+"</div><div style=\"color:"+color+";font-size:0.8rem;font-weight:600;margin-top:6px;\"><i class=\"fas fa-clock\"></i> "+tglFmt+" &bull; "+jam+" WIB &bull; "+ruang+"</div></div><span class=\"badge badge-seminar\">Terjadwal</span>";
    document.getElementById("jadwalList").appendChild(div);
    closeModalJadwal();e.target.reset();showToast("Jadwal "+jenis+" berhasil ditambahkan!","success");
  }
  </script>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
</main>
