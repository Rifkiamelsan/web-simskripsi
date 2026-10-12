<?php
/**
 * TOPBAR COMPONENT - SIMSKRIPSI
 */
if (!isset($user)) $user = getAuthUser();
$role = $user['role'] ?? 'user';
$displayName = $user['nama'] ?: ($user['username'] ?: 'Pengguna');
$roleLabel = ucfirst($role);
?>
<header class="topbar">
  <div class="topbar-left">
    <button class="topbar-btn" id="sidebarToggle" title="Toggle Sidebar">
      <i class="fas fa-bars"></i>
    </button>
    <?php if (isset($breadcrumb) && is_array($breadcrumb)): ?>
      <nav class="breadcrumb">
        <?php foreach ($breadcrumb as $i => $item): ?>
          <?php if ($i > 0): ?><span class="bc-sep"><i class="fas fa-chevron-right"></i></span><?php endif; ?>
          <?php if (!empty($item['url'])): ?>
            <a href="<?= htmlspecialchars($item['url']) ?>" class="bc-link"><?= htmlspecialchars($item['label']) ?></a>
          <?php else: ?>
            <span class="bc-current"><?= htmlspecialchars($item['label']) ?></span>
          <?php endif; ?>
        <?php endforeach; ?>
      </nav>
    <?php endif; ?>
  </div>

  <div class="topbar-right">
    <!-- Notification Bell -->
    <div class="topbar-item dropdown">
      <button class="topbar-icon-btn" id="notifBtn" title="Notifikasi">
        <i class="far fa-bell"></i>
        <span class="notif-badge">3</span>
      </button>
      <div class="dropdown-menu notif-menu" id="notifDropdown">
        <div class="dropdown-header">
          <span>Notifikasi Terbaru</span>
          <span class="badge badge-info">3 Baru</span>
        </div>
        <div class="dropdown-list">
          <a href="#" class="dropdown-item notif-item unread">
            <div class="notif-icon bg-blue"><i class="fas fa-file-alt"></i></div>
            <div class="notif-text">
              <p class="notif-title">Proposal Baru Diajukan</p>
              <span class="notif-time">Andi Pratama - 10 Menit lalu</span>
            </div>
          </a>
          <a href="#" class="dropdown-item notif-item unread">
            <div class="notif-icon bg-green"><i class="fas fa-check-circle"></i></div>
            <div class="notif-text">
              <p class="notif-title">Bimbingan Disetujui</p>
              <span class="notif-time">Dr. Ahmad, M.Kom - 1 Jam lalu</span>
            </div>
          </a>
          <a href="#" class="dropdown-item notif-item">
            <div class="notif-icon bg-orange"><i class="fas fa-calendar-alt"></i></div>
            <div class="notif-text">
              <p class="notif-title">Jadwal Seminar Ditambahkan</p>
              <span class="notif-time">Seminar Proposal - Kemarin</span>
            </div>
          </a>
        </div>
      </div>
    </div>

    <!-- User Profile Dropdown -->
    <div class="topbar-item dropdown">
      <div class="topbar-user" id="userMenuBtn">
        <div class="user-avatar-circle">
          <?= strtoupper(substr($displayName, 0, 1)) ?>
        </div>
        <div class="user-meta">
          <span class="user-name"><?= htmlspecialchars($displayName) ?></span>
          <span class="user-role-badge"><?= $roleLabel ?></span>
        </div>
        <i class="fas fa-chevron-down topbar-chevron"></i>
      </div>
      <div class="dropdown-menu user-dropdown" id="userDropdown">
        <div class="dropdown-header">
          <strong><?= htmlspecialchars($displayName) ?></strong>
          <small><?= htmlspecialchars($user['username'] ?? '') ?></small>
        </div>
        <a href="<?= BASE_URL ?>index.php" class="dropdown-item"><i class="fas fa-home"></i> Beranda Utama</a>
        <div class="dropdown-divider"></div>
        <a href="<?= BASE_URL ?>logout.php" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt"></i> Keluar (Logout)</a>
      </div>
    </div>
  </div>
</header>
