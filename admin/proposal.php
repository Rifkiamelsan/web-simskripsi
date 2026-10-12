<?php
/**
 * SCREEN 4 - DATA PROPOSAL (MASTER DATA)
 * Sistem Informasi Skripsi Mahasiswa (SIMSKRIPSI)
 * Universitas Muhammadiyah Bengkulu
 */
require_once dirname(__DIR__) . '/config/auth.php';
requireRole(['admin']);
$user = getAuthUser();

require_once dirname(__DIR__) . '/includes/sample_data.php';

$pageTitle = "Data Proposal - SIMSKRIPSI UMB";
$breadcrumb = [
    ['label' => 'Dashboard', 'url' => 'dashboard.php'],
    ['label' => 'Proposal', 'url' => '']
];

$proposals = getProposalList();

// Filter via query param
$search = trim($_GET['search'] ?? '');
$filterProdi = trim($_GET['prodi'] ?? '');
$filterStatus = trim($_GET['status'] ?? '');

$filtered = array_filter($proposals, function($p) use ($search, $filterProdi, $filterStatus) {
    if ($search !== '' && stripos($p['nama'], $search) === false && stripos($p['judul'], $search) === false && stripos($p['npm'], $search) === false) {
        return false;
    }
    if ($filterProdi !== '' && $filterProdi !== 'Semua Prodi' && $p['prodi'] !== $filterProdi) {
        return false;
    }
    if ($filterStatus !== '' && $filterStatus !== 'Semua Status' && $p['status'] !== $filterStatus) {
        return false;
    }
    return true;
});

require_once dirname(__DIR__) . '/includes/header.php';
require_once dirname(__DIR__) . '/includes/sidebar.php';
?>

<main class="main-content">
  <?php require_once dirname(__DIR__) . '/includes/topbar.php'; ?>

  <div class="page-content">
    <!-- Header with Action Button -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <div>
        <h1 class="page-title" style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">Data Proposal</h1>
        <div class="topbar-breadcrumb" style="margin-top: 4px;">
          <a href="dashboard.php" class="bc-link">Dashboard</a>
          <span class="bc-sep"><i class="fas fa-chevron-right"></i></span>
          <span class="bc-current">Proposal</span>
        </div>
      </div>
      <button class="btn btn-primary" onclick="openModalProposal()" style="background: #0284c7; padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; gap: 8px; border: none; color: white;">
        <i class="fas fa-plus"></i> Tambah Proposal Mahasiswa
      </button>
    </div>

    <!-- Main Card -->
    <div class="card" style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.03);">
      
      <!-- Filter Bar -->
      <form method="GET" action="" style="display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap;">
        <!-- Search Input -->
        <div style="position: relative; flex: 1; min-width: 260px;">
          <i class="fas fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.85rem;"></i>
          <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari nama atau judul..." class="form-control" style="padding-left: 38px; border-radius: 8px; border: 1.5px solid #e2e8f0; height: 40px; font-size: 0.85rem; width: 100%;">
        </div>

        <!-- Filter Prodi -->
        <div style="min-width: 170px;">
          <select name="prodi" onchange="this.form.submit()" class="form-control" style="border-radius: 8px; border: 1.5px solid #e2e8f0; height: 40px; font-size: 0.85rem;">
            <option value="">Semua Prodi</option>
            <option value="TI" <?= $filterProdi === 'TI' ? 'selected' : '' ?>>Teknik Informatika (TI)</option>
            <option value="Manajemen" <?= $filterProdi === 'Manajemen' ? 'selected' : '' ?>>Manajemen</option>
            <option value="Sistem Informasi" <?= $filterProdi === 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
          </select>
        </div>

        <!-- Filter Status -->
        <div style="min-width: 170px;">
          <select name="status" onchange="this.form.submit()" class="form-control" style="border-radius: 8px; border: 1.5px solid #e2e8f0; height: 40px; font-size: 0.85rem;">
            <option value="">Semua Status</option>
            <option value="Diajukan" <?= $filterStatus === 'Diajukan' ? 'selected' : '' ?>>Diajukan</option>
            <option value="Disetujui" <?= $filterStatus === 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
            <option value="Bimbingan" <?= $filterStatus === 'Bimbingan' ? 'selected' : '' ?>>Bimbingan</option>
            <option value="Seminar" <?= $filterStatus === 'Seminar' ? 'selected' : '' ?>>Seminar</option>
            <option value="Sidang" <?= $filterStatus === 'Sidang' ? 'selected' : '' ?>>Sidang</option>
            <option value="Ditolak" <?= $filterStatus === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
          </select>
        </div>

        <?php if ($search || $filterProdi || $filterStatus): ?>
          <a href="proposal.php" class="btn btn-outline" style="height: 40px; display: inline-flex; align-items: center; padding: 0 14px; border-radius: 8px; font-size: 0.82rem; border: 1.5px solid #e2e8f0; color: #64748b; text-decoration: none;">Reset</a>
        <?php endif; ?>
      </form>

      <!-- Data Table -->
      <div class="table-wrapper">
        <table id="proposalTable" style="width: 100%; border-collapse: collapse; font-size: 0.86rem;">
          <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left; background: #fafafa;">
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600; width: 45px;">No</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600;">Nama</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600;">NPM</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600; width: 35%;">Judul Proposal</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600;">Prodi</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600;">Status</th>
              <th style="padding: 12px 14px; color: #64748b; font-weight: 600; text-align: center; width: 120px;">Aksi</th>
            </tr>
          </thead>
          <tbody id="proposalTbody">
            <?php $no = 1; foreach ($filtered as $item): ?>
              <?php
                $statusClass = 'badge-diajukan';
                if ($item['status'] === 'Disetujui') $statusClass = 'badge-disetujui';
                elseif ($item['status'] === 'Bimbingan') $statusClass = 'badge-bimbingan';
                elseif ($item['status'] === 'Seminar') $statusClass = 'badge-seminar';
                elseif ($item['status'] === 'Sidang') $statusClass = 'badge-sidang';
                elseif ($item['status'] === 'Ditolak') $statusClass = 'badge-ditolak';
              ?>
              <tr id="row-proposal-<?= $item['id'] ?>"
                  data-id="<?= $item['id'] ?>"
                  data-nama="<?= htmlspecialchars($item['nama']) ?>"
                  data-npm="<?= htmlspecialchars($item['npm']) ?>"
                  data-judul="<?= htmlspecialchars($item['judul']) ?>"
                  data-prodi="<?= htmlspecialchars($item['prodi']) ?>"
                  data-status="<?= htmlspecialchars($item['status']) ?>"
                  data-dosen="<?= htmlspecialchars($item['dosen'] ?? 'Dr. Ahmad, M.Kom') ?>"
                  style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;" 
                  onmouseover="this.style.background='#f8fafc'" 
                  onmouseout="this.style.background='transparent'">
                <td class="col-no" style="padding: 14px; color: #64748b;"><?= $no++ ?></td>
                <td class="col-nama" style="padding: 14px; font-weight: 600; color: #0f172a;"><?= htmlspecialchars($item['nama']) ?></td>
                <td class="col-npm" style="padding: 14px; color: #64748b;"><?= htmlspecialchars($item['npm']) ?></td>
                <td class="col-judul" style="padding: 14px; color: #334155; line-height: 1.4;"><?= htmlspecialchars($item['judul']) ?></td>
                <td class="col-prodi" style="padding: 14px; color: #64748b;"><?= htmlspecialchars($item['prodi']) ?></td>
                <td class="col-status" style="padding: 14px;">
                  <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($item['status']) ?></span>
                </td>
                <td style="padding: 14px; text-align: center;">
                  <div class="action-btns" style="justify-content: center;">
                    <!-- Eye / Detail Button -->
                    <a href="detail_proposal.php?id=<?= $item['id'] ?>" class="btn-act btn-act-view" title="Lihat Detail Proposal">
                      <i class="fas fa-eye"></i>
                    </a>
                    <!-- Edit Button -->
                    <button type="button" class="btn-act btn-act-edit" onclick="openEditModal(<?= $item['id'] ?>)" title="Edit Proposal">
                      <i class="fas fa-pen"></i>
                    </button>
                    <!-- Delete Button -->
                    <button type="button" class="btn-act btn-act-del" onclick="confirmDeleteProposal(<?= $item['id'] ?>)" title="Hapus Proposal">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Footer Pagination matching Mockup -->
      <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 16px; border-top: 1px solid #f1f5f9; font-size: 0.82rem; color: #64748b;">
        <div id="paginationCount">Menampilkan 1 - <?= count($filtered) ?> dari 128 data</div>
        <div style="display: flex; gap: 4px;">
          <a href="#" style="width: 30px; height: 30px; border-radius: 6px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; text-decoration: none;"><i class="fas fa-chevron-left" style="font-size: 0.7rem;"></i></a>
          <a href="#" style="width: 30px; height: 30px; border-radius: 6px; background: #0284c7; color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; text-decoration: none;">1</a>
          <a href="#" style="width: 30px; height: 30px; border-radius: 6px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; text-decoration: none;">2</a>
          <a href="#" style="width: 30px; height: 30px; border-radius: 6px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; text-decoration: none;">3</a>
          <a href="#" style="width: 30px; height: 30px; border-radius: 6px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; text-decoration: none;">4</a>
          <a href="#" style="width: 30px; height: 30px; border-radius: 6px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; text-decoration: none;">5</a>
          <a href="#" style="width: 30px; height: 30px; border-radius: 6px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; text-decoration: none;"><i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i></a>
        </div>
      </div>

    </div>
  </div>

  <!-- Modal 1: Input Data Proposal Mahasiswa -->
  <div class="modal-overlay" id="modalProposal">
    <div class="modal-box">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-plus-circle" style="color:#0284c7;margin-right:8px;"></i> Input Data Proposal Mahasiswa</h3>
        <button class="modal-close" onclick="closeModalProposal()">&times;</button>
      </div>
      <form id="formAddProposal" onsubmit="handleProposalSubmit(event)">
        <div class="form-group">
          <label class="form-label">Nama Mahasiswa</label>
          <input type="text" id="addNama" class="form-control" required placeholder="Contoh: Siti Rahmawati">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">NPM</label>
            <input type="text" id="addNpm" class="form-control" required placeholder="Contoh: 221010002">
          </div>
          <div class="form-group">
            <label class="form-label">Program Studi</label>
            <select id="addProdi" class="form-control" required>
              <option value="TI">Teknik Informatika (TI)</option>
              <option value="Sistem Informasi">Sistem Informasi</option>
              <option value="Manajemen">Manajemen</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Judul Proposal</label>
          <textarea id="addJudul" class="form-control" rows="3" required placeholder="Masukkan judul proposal lengkap..."></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Dosen Pembimbing</label>
          <select id="addDosen" class="form-control">
            <option value="Dr. Ahmad, M.Kom">Dr. Ahmad, M.Kom</option>
            <option value="Dr. Budi Santoso, M.M">Dr. Budi Santoso, M.M</option>
            <option value="Prof. Dr. Ir. Hendra, M.T">Prof. Dr. Ir. Hendra, M.T</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModalProposal()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background: #0284c7;">Simpan Data Proposal</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal 2: Edit Proposal (REAL WORKING FORM) -->
  <div class="modal-overlay" id="modalEditProposal">
    <div class="modal-box">
      <div class="modal-header">
        <h3 class="modal-title"><i class="fas fa-edit" style="color:#10b981;margin-right:8px;"></i> Edit Data Proposal Skripsi</h3>
        <button class="modal-close" onclick="closeEditModal()">&times;</button>
      </div>
      <form id="formEditProposal" onsubmit="handleEditSubmit(event)">
        <input type="hidden" id="editId">
        <div class="form-group">
          <label class="form-label">Nama Mahasiswa</label>
          <input type="text" id="editNama" class="form-control" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">NPM</label>
            <input type="text" id="editNpm" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="form-label">Program Studi</label>
            <select id="editProdi" class="form-control" required>
              <option value="TI">Teknik Informatika (TI)</option>
              <option value="Sistem Informasi">Sistem Informasi</option>
              <option value="Manajemen">Manajemen</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Judul Proposal</label>
          <textarea id="editJudul" class="form-control" rows="3" required></textarea>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Status Proposal</label>
            <select id="editStatus" class="form-control" required>
              <option value="Diajukan">Diajukan</option>
              <option value="Disetujui">Disetujui</option>
              <option value="Bimbingan">Bimbingan</option>
              <option value="Seminar">Seminar</option>
              <option value="Sidang">Sidang</option>
              <option value="Ditolak">Ditolak</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Dosen Pembimbing</label>
            <select id="editDosen" class="form-control">
              <option value="Dr. Ahmad, M.Kom">Dr. Ahmad, M.Kom</option>
              <option value="Dr. Budi Santoso, M.M">Dr. Budi Santoso, M.M</option>
              <option value="Prof. Dr. Ir. Hendra, M.T">Prof. Dr. Ir. Hendra, M.T</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeEditModal()">Batal</button>
          <button type="submit" class="btn btn-primary" style="background: #10b981;">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
  // Helper Badge Class
  function getBadgeClass(status) {
    if (status === 'Disetujui') return 'badge-disetujui';
    if (status === 'Bimbingan') return 'badge-bimbingan';
    if (status === 'Seminar') return 'badge-seminar';
    if (status === 'Sidang') return 'badge-sidang';
    if (status === 'Ditolak') return 'badge-ditolak';
    return 'badge-diajukan';
  }

  // --- Modal Ajukan Proposal ---
  function openModalProposal() {
    document.getElementById('modalProposal').classList.add('open');
  }
  function closeModalProposal() {
    document.getElementById('modalProposal').classList.remove('open');
  }
  function handleProposalSubmit(e) {
    e.preventDefault();
    const nama = document.getElementById('addNama').value.trim();
    const npm = document.getElementById('addNpm').value.trim();
    const prodi = document.getElementById('addProdi').value;
    const judul = document.getElementById('addJudul').value.trim();
    const dosen = document.getElementById('addDosen').value;
    const newId = Date.now();

    const tbody = document.getElementById('proposalTbody');
    const newRow = document.createElement('tr');
    newRow.id = `row-proposal-${newId}`;
    newRow.dataset.id = newId;
    newRow.dataset.nama = nama;
    newRow.dataset.npm = npm;
    newRow.dataset.judul = judul;
    newRow.dataset.prodi = prodi;
    newRow.dataset.status = 'Diajukan';
    newRow.dataset.dosen = dosen;
    newRow.style.borderBottom = '1px solid #f1f5f9';
    newRow.style.transition = 'background 0.15s';

    const currentCount = tbody.children.length + 1;
    newRow.innerHTML = `
      <td class="col-no" style="padding: 14px; color: #64748b;">${currentCount}</td>
      <td class="col-nama" style="padding: 14px; font-weight: 600; color: #0f172a;">${nama}</td>
      <td class="col-npm" style="padding: 14px; color: #64748b;">${npm}</td>
      <td class="col-judul" style="padding: 14px; color: #334155; line-height: 1.4;">${judul}</td>
      <td class="col-prodi" style="padding: 14px; color: #64748b;">${prodi}</td>
      <td class="col-status" style="padding: 14px;">
        <span class="badge badge-diajukan">Diajukan</span>
      </td>
      <td style="padding: 14px; text-align: center;">
        <div class="action-btns" style="justify-content: center;">
          <a href="detail_proposal.php?id=2" class="btn-act btn-act-view" title="Lihat Detail Proposal"><i class="fas fa-eye"></i></a>
          <button type="button" class="btn-act btn-act-edit" onclick="openEditModal(${newId})" title="Edit Proposal"><i class="fas fa-pen"></i></button>
          <button type="button" class="btn-act btn-act-del" onclick="confirmDeleteProposal(${newId})" title="Hapus Proposal"><i class="fas fa-trash"></i></button>
        </div>
      </td>
    `;
    tbody.insertBefore(newRow, tbody.firstChild);
    closeModalProposal();
    document.getElementById('formAddProposal').reset();
    showToast(`Proposal untuk <strong>${nama}</strong> berhasil diajukan!`, 'success');
  }

  // --- Modal Edit Proposal ---
  function openEditModal(id) {
    const row = document.getElementById(`row-proposal-${id}`);
    if (!row) return;

    document.getElementById('editId').value = id;
    document.getElementById('editNama').value = row.dataset.nama || '';
    document.getElementById('editNpm').value = row.dataset.npm || '';
    document.getElementById('editJudul').value = row.dataset.judul || '';
    document.getElementById('editProdi').value = row.dataset.prodi || 'TI';
    document.getElementById('editStatus').value = row.dataset.status || 'Diajukan';
    document.getElementById('editDosen').value = row.dataset.dosen || 'Dr. Ahmad, M.Kom';

    document.getElementById('modalEditProposal').classList.add('open');
  }

  function closeEditModal() {
    document.getElementById('modalEditProposal').classList.remove('open');
  }

  function handleEditSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    const row = document.getElementById(`row-proposal-${id}`);
    if (!row) return;

    const nama = document.getElementById('editNama').value.trim();
    const npm = document.getElementById('editNpm').value.trim();
    const prodi = document.getElementById('editProdi').value;
    const judul = document.getElementById('editJudul').value.trim();
    const status = document.getElementById('editStatus').value;
    const dosen = document.getElementById('editDosen').value;

    // Update dataset
    row.dataset.nama = nama;
    row.dataset.npm = npm;
    row.dataset.prodi = prodi;
    row.dataset.judul = judul;
    row.dataset.status = status;
    row.dataset.dosen = dosen;

    // Update DOM
    row.querySelector('.col-nama').innerText = nama;
    row.querySelector('.col-npm').innerText = npm;
    row.querySelector('.col-prodi').innerText = prodi;
    row.querySelector('.col-judul').innerText = judul;
    row.querySelector('.col-status').innerHTML = `<span class="badge ${getBadgeClass(status)}">${status}</span>`;

    // Highlight row effect
    row.style.background = '#eff6ff';
    setTimeout(() => { row.style.background = 'transparent'; }, 1200);

    closeEditModal();
    showToast(`Data proposal <strong>${nama}</strong> berhasil diperbarui!`, 'success');
  }

  // --- Delete Proposal ---
  function confirmDeleteProposal(id) {
    const row = document.getElementById(`row-proposal-${id}`);
    if (!row) return;
    const nama = row.dataset.nama || 'ini';

    if (confirm(`Apakah Anda yakin ingin menghapus proposal mahasiswa "${nama}"?`)) {
      row.style.transition = 'all 0.3s ease';
      row.style.opacity = '0';
      row.style.transform = 'scale(0.95)';
      setTimeout(() => {
        row.remove();
        showToast(`Proposal "${nama}" berhasil dihapus.`, 'info');
      }, 300);
    }
  }
  </script>

  <?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>