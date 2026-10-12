<?php
/**
 * SIDEBAR COMPONENT - SIMSKRIPSI
 * Menampilkan sidebar sesuai role pengguna yang login
 */
if (!defined('BASE_URL')) require_once dirname(__DIR__) . '/config/auth.php';
$user = getAuthUser();
$role = $user['role'];
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

function sidebarLink(string $href, string $icon, string $label, string $currentPage): string {
    $page = basename($href, '.php');
    $active = ($currentPage === $page) ? 'active' : '';
    return "<a href='{$href}' class='nav-link {$active}'><i class='fas {$icon}'></i><span>{$label}</span></a>";
}
?>
<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <div class="sidebar-logo">
      <div class="logo-icon"><i class="fas fa-graduation-cap"></i></div>
      <div class="logo-text">
        <span class="logo-title">SIMSKRIPSI</span>
        <span class="logo-sub">UMB</span>
      </div>
    </div>
  </div>

  <div class="sidebar-user">
    <div class="user-avatar">
      <i class="fas fa-user-circle"></i>
    </div>
    <div class="user-info">
      <span class="user-name"><?= htmlspecialchars($user['nama']) ?></span>
      <span class="user-role badge-role-<?= $role ?>"><?= ucfirst($role) ?></span>
    </div>
  </div>

  <nav class="sidebar-nav">
    <?php if ($role === 'admin'): ?>
      <?= sidebarLink('../admin/dashboard.php', 'fa-tachometer-alt', 'Dashboard', $currentPage) ?>
      <?= sidebarLink('../admin/proposal.php', 'fa-file-alt', 'Proposal', $currentPage) ?>
      <?= sidebarLink('../admin/bimbingan.php', 'fa-chalkboard-teacher', 'Bimbingan', $currentPage) ?>
      <?= sidebarLink('../admin/seminar.php', 'fa-microphone', 'Seminar', $currentPage) ?>
      <?= sidebarLink('../admin/sidang.php', 'fa-gavel', 'Sidang', $currentPage) ?>
      <div class="nav-divider"></div>
      <?= sidebarLink('../admin/mahasiswa.php', 'fa-users', 'Mahasiswa', $currentPage) ?>
      <?= sidebarLink('../admin/dosen.php', 'fa-chalkboard-teacher', 'Dosen Pembimbing', $currentPage) ?>
      <?= sidebarLink('../admin/jadwal.php', 'fa-calendar-alt', 'Jadwal', $currentPage) ?>
      <div class="nav-divider-label"><span>Master Data</span></div>
      <?= sidebarLink('../admin/master_data.php', 'fa-database', 'Master Data', $currentPage) ?>
      <?= sidebarLink('../admin/laporan.php', 'fa-chart-bar', 'Laporan', $currentPage) ?>

    <?php elseif ($role === 'prodi'): ?>
      <?= sidebarLink('../prodi/dashboard.php', 'fa-tachometer-alt', 'Dashboard', $currentPage) ?>
      <?= sidebarLink('../prodi/proposal.php', 'fa-file-alt', 'Proposal', $currentPage) ?>
      <?= sidebarLink('../prodi/mahasiswa.php', 'fa-users', 'Mahasiswa', $currentPage) ?>
      <?= sidebarLink('../prodi/seminar.php', 'fa-microphone', 'Seminar', $currentPage) ?>
      <?= sidebarLink('../prodi/sidang.php', 'fa-gavel', 'Sidang', $currentPage) ?>
      <?= sidebarLink('../prodi/jadwal.php', 'fa-calendar-alt', 'Jadwal', $currentPage) ?>
      <?= sidebarLink('../prodi/laporan.php', 'fa-chart-bar', 'Laporan', $currentPage) ?>

    <?php elseif ($role === 'mahasiswa'): ?>
      <?= sidebarLink('../mahasiswa/dashboard.php', 'fa-tachometer-alt', 'Dashboard', $currentPage) ?>
      <?= sidebarLink('../mahasiswa/proposal.php', 'fa-file-alt', 'Proposal Saya', $currentPage) ?>
      <?= sidebarLink('../mahasiswa/bimbingan.php', 'fa-chalkboard-teacher', 'Bimbingan', $currentPage) ?>
      <?= sidebarLink('../mahasiswa/seminar.php', 'fa-microphone', 'Seminar', $currentPage) ?>
      <?= sidebarLink('../mahasiswa/sidang.php', 'fa-gavel', 'Sidang', $currentPage) ?>
      <?= sidebarLink('../mahasiswa/dokumen.php', 'fa-folder-open', 'Dokumen', $currentPage) ?>
      <?= sidebarLink('../mahasiswa/profil.php', 'fa-user', 'Profil Saya', $currentPage) ?>

    <?php elseif ($role === 'dosen'): ?>
      <?= sidebarLink('../dosen/dashboard.php', 'fa-tachometer-alt', 'Dashboard', $currentPage) ?>
      <?= sidebarLink('../dosen/bimbingan.php', 'fa-chalkboard-teacher', 'Bimbingan', $currentPage) ?>
      <?= sidebarLink('../dosen/mahasiswa.php', 'fa-users', 'Mahasiswa Bimbingan', $currentPage) ?>
      <?= sidebarLink('../dosen/jadwal.php', 'fa-calendar-alt', 'Jadwal Saya', $currentPage) ?>
      <?= sidebarLink('../dosen/profil.php', 'fa-user', 'Profil', $currentPage) ?>
    <?php endif; ?>

    <div class="nav-divider"></div>
    <a href="../logout.php" class="nav-link nav-link-logout">
      <i class="fas fa-sign-out-alt"></i><span>Keluar</span>
    </a>
  </nav>
</aside>
