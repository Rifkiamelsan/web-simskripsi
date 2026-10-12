<?php
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['prodi', 'admin']);
$user = getAuthUser();
require_once dirname(__DIR__) . '/includes/sample_data.php';
$pageTitle = "Sidang Skripsi - SIMSKRIPSI UMB";
$breadcrumb = [['label' => 'Dashboard', 'url' => 'dashboard.php'], ['label' => 'Sidang Skripsi', 'url' => '']];
require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>
<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>
  <div class="page-content">
    <div class="page-header" style="margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;">
      <div>
        <h1 style="font-size:1.4rem;font-weight:700;color:#0f172a;">Sidang Skripsi (Munaqasyah)</h1>
        <p style="color:#64748b;font-size:0.88rem;margin-top:4px;">Penetapan jadwal sidang akhir, penilaian penguji, dan yudisium kelulusan</p>
      </div>
      <button onclick="openModalTambahSidang()" style="background:#0284c7;padding:10px 18px;border-radius:8px;font-weight:600;font-size:0.85rem;color:white;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;">
        <i class="fas fa-gavel"></i> Tambah Jadwal Sidang
      </button>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px;">
      <div style="background:white;border-radius:12px;padding:18px;border:1px solid #e2e8f0;display:flex;align-items:center;gap:14px;">
        <div style="width:44px;height:44px;border-radius:10px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;font-size:1.1rem;"><i class="fas fa-gavel"></i></div>
        <div><div style="font-size:1.4rem;font-weight:800;color:#0f172a;">1</div><div style="font-size:0.75rem;color:#64748b;">Terjadwal</div></div>
      </div>
      <div style="background:white;border-radius:12px;padding:18px;border:1px solid #e2e8f0;display:flex;align-items:center;gap:14px;">
        <div style="width:44px;height:44px;border-radius:10px;background:#f0fdf4;color:#16a34a;display:flex;align-items:center;justify-content:center;font-size:1.1rem;"><i class="fas fa-graduation-cap"></i></div>
        <div><div style="font-size:1.4rem;font-weight:800;color:#0f172a;">1</div><div style="font-size:0.75rem;color:#64748b;">Lulus Yudisium</div></div>
      </div>
      <div style="background:white;border-radius:12px;padding:18px;border:1px solid #e2e8f0;display:flex;align-items:center;gap:14px;">
        <div style="width:44px;height:44px;border-radius:10px;background:#fff7ed;color:#ea580c;display:flex;align-items:center;justify-content:center;font-size:1.1rem;"><i class="fas fa-clock"></i></div>
        <div><div style="font-size:1.4rem;font-weight:800;color:#0f172a;">0</div><div style="font-size:0.75rem;color:#64748b;">Menunggu Penilaian</div></div>
      </div>
    </div>
    <div class="card" style="background:white;border-radius:12px;border:1px solid #e2e8f0;padding:22px;box-shadow:0 2px 10px rgba(0,0,0,0.03);">
      <div class="table-wrapper">
        <table style="width:100%;border-collapse:collapse;font-size:0.86rem;">
          <thead>
            <tr style="border-bottom:2px solid #f1f5f9;text-align:left;background:#fafafa;">
              <th style="padding:12px 14px;">NPM</th>
              <th style="padding:12px 14px;">Nama Mahasiswa</th>
              <th style="padding:12px 14px;">Tanggal Sidang</th>
              <th style="padding:12px 14px;">Ruangan</th>
              <th style="padding:12px 14px;">Nilai Akhir</th>
              <th style="padding:12px 14px;">Predikat</th>
              <th style="padding:12px 14px;">Status</th>
              <th style="padding:12px 14px;text-align:center;">Aksi</th>
            </tr>
          </thead>
          <tbody id="sidangTbody">
            <tr style="border-bottom:1px solid #f1f5f9;">
              <td style="padding:14px;color:#64748b;">221010006</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">Fajar Nugraha</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">01-10-2026 (10:00 WIB)</td>
              <td style="padding:14px;color:#64748b;">Ruang Sidang B Lt. 3</td>
              <td style="padding:14px;font-weight:700;color:#16a34a;">88.50 (A)</td>
              <td style="padding:14px;font-weight:600;">Dengan Pujian</td>
              <td style="padding:14px;"><span class="badge badge-selesai">Lulus Yudisium</span></td>
              <td style="padding:14px;text-align:center;"><button onclick="showToast('Data sudah final','info')" style="background:#64748b;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-eye"></i> Lihat</button></td>
            </tr>
            <tr>
              <td style="padding:14px;color:#64748b;">221010004</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">Dela Anggraini</td>
              <td style="padding:14px;font-weight:600;color:#0f172a;">10-11-2026 (09:00 WIB)</td>
              <td style="padding:14px;color:#64748b;">Ruang Sidang A Lt. 2</td>
              <td style="padding:14px;color:#94a3b8;">Belum dinilai</td>
              <td style="padding:14px;color:#94a3b8;">-</td>
              <td style="padding:14px;"><span class="badge badge-seminar">Terjadwal</span></td>
              <td style="padding:14px;text-align:center;"><button onclick="openModalNilai('Dela Anggraini')" style="background:#0284c7;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;"><i class="fas fa-star"></i> Input Nilai</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal-overlay" id="modalTambahSidang">
    <div class="modal-box" style="max-width:500px;">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-gavel" style="color:#0284c7;margin-right:8px;"></i>Jadwalkan Sidang Skripsi</h3>
        <button class="modal-close" onclick="closeModalTambahSidang()">&times;</button>
      </div>
      <form onsubmit="handleTambahSidang(event)">
        <div class="form-group"><label class="form-label">Nama Mahasiswa</label><input type="text" id="sdNama" class="form-control" required placeholder="Nama mahasiswa"></div>
        <div class="form-group"><label class="form-label">NPM</label><input type="text" id="sdNpm" class="form-control" required placeholder="NPM mahasiswa"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div class="form-group"><label class="form-label">Tanggal</label><input type="date" id="sdTgl" class="form-control" required></div>
          <div class="form-group"><label class="form-label">Jam</label><input type="time" id="sdJam" class="form-control" required value="09:00"></div>
        </div>
        <div class="form-group"><label class="form-label">Ruangan</label><input type="text" id="sdRuang" class="form-control" required placeholder="Ruang Sidang B Lt. 3"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalTambahSidang()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background:#0284c7;">Simpan Jadwal</button>
        </div>
      </form>
    </div>
  </div>
  <div class="modal-overlay" id="modalNilai">
    <div class="modal-box" style="max-width:440px;">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-star" style="color:#f59e0b;margin-right:8px;"></i>Input Nilai Sidang</h3>
        <button class="modal-close" onclick="closeModalNilai()">&times;</button>
      </div>
      <form onsubmit="handleInputNilai(event)">
        <input type="hidden" id="nilaiNama">
        <div class="form-group"><label class="form-label">Mahasiswa</label><input type="text" id="nilaiNamaView" class="form-control" readonly style="background:#f8fafc;"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div class="form-group"><label class="form-label">Nilai Penguji 1</label><input type="number" id="nilaiP1" class="form-control" required min="0" max="100" placeholder="85"></div>
          <div class="form-group"><label class="form-label">Nilai Penguji 2</label><input type="number" id="nilaiP2" class="form-control" required min="0" max="100" placeholder="88"></div>
        </div>
        <div class="form-group"><label class="form-label">Nilai Pembimbing</label><input type="number" id="nilaiPb" class="form-control" required min="0" max="100" placeholder="90"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalNilai()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background:#059669;">Simpan &amp; Yudisium</button>
        </div>
      </form>
    </div>
  </div>
  <script>
  function openModalTambahSidang(){document.getElementById("modalTambahSidang").classList.add("open");}
  function closeModalTambahSidang(){document.getElementById("modalTambahSidang").classList.remove("open");}
  function openModalNilai(nama){document.getElementById("nilaiNama").value=nama;document.getElementById("nilaiNamaView").value=nama;document.getElementById("modalNilai").classList.add("open");}
  function closeModalNilai(){document.getElementById("modalNilai").classList.remove("open");}
  function handleTambahSidang(e){
    e.preventDefault();
    var nama=document.getElementById("sdNama").value;var npm=document.getElementById("sdNpm").value;
    var tgl=document.getElementById("sdTgl").value;var jam=document.getElementById("sdJam").value;var ruang=document.getElementById("sdRuang").value;
    var tbody=document.getElementById("sidangTbody");var tglFmt=tgl.split("-").reverse().join("-");
    var tr=document.createElement("tr");tr.style.borderBottom="1px solid #f1f5f9";
    tr.innerHTML="<td style=\"padding:14px;color:#64748b;\">"+npm+"</td><td style=\"padding:14px;font-weight:600;color:#0f172a;\">"+nama+"</td><td style=\"padding:14px;font-weight:600;color:#0f172a;\">"+tglFmt+" ("+jam+" WIB)</td><td style=\"padding:14px;color:#64748b;\">"+ruang+"</td><td style=\"padding:14px;color:#94a3b8;\">Belum dinilai</td><td style=\"padding:14px;color:#94a3b8;\">-</td><td style=\"padding:14px;\"><span class=\"badge badge-seminar\">Terjadwal</span></td><td style=\"padding:14px;text-align:center;\"><button onclick=\"openModalNilai('"+nama+"')\" style=\"background:#0284c7;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;\"><i class=\"fas fa-star\"></i> Input Nilai</button></td>";
    tbody.appendChild(tr);closeModalTambahSidang();e.target.reset();showToast("Jadwal sidang "+nama+" berhasil ditambahkan!","success");
  }
  function handleInputNilai(e){
    e.preventDefault();
    var nama=document.getElementById("nilaiNama").value;
    var p1=parseFloat(document.getElementById("nilaiP1").value);var p2=parseFloat(document.getElementById("nilaiP2").value);var pb=parseFloat(document.getElementById("nilaiPb").value);
    var avg=((p1+p2+pb)/3).toFixed(2);var grade="C";var predikat="Cukup";
    if(avg>=90){grade="A";predikat="Dengan Pujian (Cumlaude)";}else if(avg>=80){grade="A-";predikat="Sangat Memuaskan";}else if(avg>=70){grade="B+";predikat="Memuaskan";}else if(avg>=60){grade="B";predikat="Baik";}
    document.querySelectorAll("#sidangTbody tr").forEach(function(row){
      var td2=row.querySelector("td:nth-child(2)");
      if(td2&&td2.textContent===nama){
        row.querySelector("td:nth-child(5)").textContent=avg+" ("+grade+")";row.querySelector("td:nth-child(5)").style.cssText="padding:14px;font-weight:700;color:#16a34a;";
        row.querySelector("td:nth-child(6)").textContent=predikat;row.querySelector("td:nth-child(6)").style.cssText="padding:14px;font-weight:600;";
        row.querySelector(".badge").className="badge badge-selesai";row.querySelector(".badge").textContent="Lulus Yudisium";
        row.querySelector("td:last-child").innerHTML="<button onclick=\"showToast('Data final','info')\" style=\"background:#64748b;color:white;padding:6px 12px;border-radius:6px;font-size:0.78rem;border:none;cursor:pointer;\"><i class=\"fas fa-eye\"></i> Lihat</button>";
      }
    });
    closeModalNilai();e.target.reset();showToast(nama+" dinyatakan Lulus dengan nilai "+avg+" ("+grade+")!","success");
  }
  </script>
  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>
</main>
