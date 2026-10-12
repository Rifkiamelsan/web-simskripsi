<?php
/**
 * LANDING PAGE - SIMSKRIPSI
 * Sistem Informasi Skripsi Mahasiswa
 * Universitas Muhammadiyah Bengkulu
 */
$pageTitle = "SIMSKRIPSI - Sistem Informasi Skripsi Mahasiswa | UMB";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?></title>
  <meta name="description" content="Sistem Informasi Skripsi Mahasiswa Universitas Muhammadiyah Bengkulu. Kelola proposal, bimbingan, seminar, dan sidang skripsi secara online, cepat, transparan, dan terintegrasi.">
  <link rel="stylesheet" href="assets/css/landing.css?v=<?= time() ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', sans-serif; background: #f1f5f9; color: #0f172a; overflow-x: hidden; }
    a { text-decoration: none; color: inherit; }

    /* Hero Visual & Image */
    .hero-visual {
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
      width: 100% !important;
      position: relative !important;
    }
    .hero-img-box {
      position: relative !important;
      width: 100% !important;
      max-width: 470px !important;
      border-radius: 22px !important;
      padding: 8px !important;
      background: rgba(255, 255, 255, 0.08) !important;
      backdrop-filter: blur(14px) !important;
      -webkit-backdrop-filter: blur(14px) !important;
      border: 1px solid rgba(255, 255, 255, 0.18) !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 0 0 30px rgba(26, 86, 219, 0.3) !important;
      transition: transform 0.35s ease, box-shadow 0.35s ease !important;
    }
    .hero-img-box:hover {
      transform: translateY(-4px) !important;
      box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.7), 0 0 40px rgba(26, 86, 219, 0.45) !important;
    }
    .hero-main-img {
      width: 100% !important;
      height: auto !important;
      max-height: 440px !important;
      aspect-ratio: 1 / 1 !important;
      object-fit: cover !important;
      object-position: center top !important;
      border-radius: 16px !important;
      display: block !important;
    }
    .hero-floating-card {
      position: absolute !important;
      display: flex !important;
      align-items: center !important;
      gap: 12px !important;
      background: rgba(15, 23, 42, 0.92) !important;
      backdrop-filter: blur(16px) !important;
      -webkit-backdrop-filter: blur(16px) !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      padding: 10px 16px !important;
      border-radius: 14px !important;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.55) !important;
      animation: floatBadge 4s ease-in-out infinite !important;
      z-index: 10 !important;
    }
    .hero-floating-card.top-badge {
      top: -14px !important;
      right: -14px !important;
      animation-delay: -1s !important;
    }
    .hero-floating-card.bottom-badge {
      bottom: -14px !important;
      left: -14px !important;
    }
    @keyframes floatBadge {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-7px); }
    }
    .floating-icon {
      width: 38px !important;
      height: 38px !important;
      border-radius: 10px !important;
      background: linear-gradient(135deg, #1a56db, #0ea5e9) !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      color: #fff !important;
      font-size: 1rem !important;
      flex-shrink: 0 !important;
    }
    .floating-icon.pulse {
      background: linear-gradient(135deg, #059669, #10b981) !important;
    }
    .floating-title {
      color: #ffffff !important;
      font-size: 0.82rem !important;
      font-weight: 700 !important;
      line-height: 1.2 !important;
    }
    .floating-subtitle {
      color: #94a3b8 !important;
      font-size: 0.72rem !important;
      line-height: 1.2 !important;
      margin-top: 2px !important;
    }
    @media (max-width: 768px) {
      .hero-visual { display: flex !important; max-width: 440px !important; margin: 25px auto 0 !important; }
      .hero-main-img { max-height: 320px !important; }
      .hero-floating-card.top-badge { right: 0 !important; top: -10px !important; }
      .hero-floating-card.bottom-badge { left: 0 !important; bottom: -10px !important; }
    }
  </style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="lp-navbar" id="navbar">
  <div class="nav-brand">
    <div class="brand-icon"><i class="fas fa-graduation-cap"></i></div>
    <div>
      <div class="brand-name">SIMSKRIPSI</div>
      <div class="brand-sub">Universitas Muhammadiyah Bengkulu</div>
    </div>
  </div>
  <div class="lp-nav-links">
    <a href="#beranda">Beranda</a>
    <a href="#fitur">Informasi</a>
    <a href="#alur">Panduan</a>
    <a href="#kontak">Kontak</a>
    <a href="login.php" class="btn-login-nav">Login <i class="fas fa-arrow-right" style="font-size:.75rem"></i></a>
  </div>
</nav>

<!-- ===== HERO ===== -->
<section class="lp-hero" id="beranda">
  <div class="hero-bg-shapes">
    <div class="hero-circle hero-circle-1"></div>
    <div class="hero-circle hero-circle-2"></div>
  </div>
  <div class="hero-inner">
    <div class="hero-text">
      <div class="hero-badge">
        <i class="fas fa-star" style="color:#f59e0b;font-size:.75rem"></i>
        <span>Sistem Terintegrasi &amp; Modern</span>
      </div>
      <h1 class="hero-title">
        Sistem Informasi<br>
        <span class="highlight">Skripsi Mahasiswa</span>
      </h1>
      <p class="hero-desc">
        Mengelola proses pengajuan, bimbingan, seminar hingga yudisium
        secara <strong style="color:white">online, cepat, transparan, dan terintegrasi</strong>
        untuk seluruh civitas akademika UMB.
      </p>
      <div class="hero-actions">
        <a href="login.php" class="btn-hero-primary"><i class="fas fa-sign-in-alt"></i> Login ke Sistem</a>
        <a href="#fitur" class="btn-hero-outline"><i class="fas fa-info-circle"></i> Pelajari Lebih</a>
      </div>
      <div class="hero-stats">
        <div class="hero-stat-item">
          <div class="hero-stat-num">128</div>
          <div class="hero-stat-label">Total Mahasiswa</div>
        </div>
        <div class="hero-stat-item">
          <div class="hero-stat-num">86</div>
          <div class="hero-stat-label">Proposal Aktif</div>
        </div>
        <div class="hero-stat-item">
          <div class="hero-stat-num">45</div>
          <div class="hero-stat-label">Sedang Bimbingan</div>
        </div>
        <div class="hero-stat-item">
          <div class="hero-stat-num">28</div>
          <div class="hero-stat-label">Sidang Selesai</div>
        </div>
      </div>
    </div>

    <div class="hero-visual">
      <div class="hero-img-box">
        <img src="assets/img/foto bersama.jpeg" alt="Civitas Akademika SIMSKRIPSI" class="hero-main-img">
        <div class="hero-floating-card top-badge">
          <div class="floating-icon"><i class="fas fa-graduation-cap"></i></div>
          <div>
            <div class="floating-title">Bimbingan &amp; Kelulusan</div>
            <div class="floating-subtitle">Tepat Waktu &amp; Terintegrasi</div>
          </div>
        </div>
        <div class="hero-floating-card bottom-badge">
          <div class="floating-icon pulse"><i class="fas fa-users"></i></div>
          <div>
            <div class="floating-title">Civitas Akademika UMB</div>
            <div class="floating-subtitle">Universitas Muhammadiyah Bengkulu</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== FITUR ===== -->
<section id="fitur" style="padding: 80px 0; background: #f8fafc;">
  <div class="lp-section" style="padding-top:0;padding-bottom:0">
    <div class="section-header">
      <span class="section-badge">Fitur Unggulan</span>
      <h2 class="section-title">Semua yang Anda Butuhkan dalam Satu Sistem</h2>
      <p class="section-desc">Dirancang untuk memudahkan proses skripsi dari awal hingga yudisium</p>
    </div>
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon" style="background:#eff6ff;color:#1a56db"><i class="fas fa-file-alt"></i></div>
        <div class="feature-title">Pengajuan Proposal Online</div>
        <p class="feature-desc">Ajukan proposal skripsi kapan saja dan di mana saja melalui portal yang mudah digunakan.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon" style="background:#f0fdf4;color:#10b981"><i class="fas fa-chalkboard-teacher"></i></div>
        <div class="feature-title">Bimbingan Terstruktur</div>
        <p class="feature-desc">Catat setiap sesi bimbingan, unggah dokumen revisi, dan pantau progres bersama dosen pembimbing.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon" style="background:#fdf4ff;color:#7c3aed"><i class="fas fa-chart-line"></i></div>
        <div class="feature-title">Monitoring Progress</div>
        <p class="feature-desc">Lihat status skripsi secara real-time dari Diajukan hingga Selesai dengan visualisasi yang jelas.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon" style="background:#fffbeb;color:#d97706"><i class="fas fa-folder-open"></i></div>
        <div class="feature-title">Dokumen Terintegrasi</div>
        <p class="feature-desc">Semua berkas proposal, revisi, dan skripsi tersimpan terpusat dan mudah diakses kapanpun.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon" style="background:#fff1f2;color:#be123c"><i class="fas fa-calendar-check"></i></div>
        <div class="feature-title">Jadwal Seminar &amp; Sidang</div>
        <p class="feature-desc">Pengelolaan jadwal seminar dan sidang skripsi secara otomatis dan terorganisir.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon" style="background:#f0fdfa;color:#0d9488"><i class="fas fa-chart-bar"></i></div>
        <div class="feature-title">Laporan &amp; Statistik</div>
        <p class="feature-desc">Dashboard analitik untuk Admin dan Prodi dalam memantau perkembangan skripsi seluruh mahasiswa.</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== ALUR SKRIPSI ===== -->
<section id="alur" class="alur-section">
  <div class="alur-inner">
    <div class="section-header">
      <span class="section-badge">Alur Proses</span>
      <h2 class="section-title" style="color:white">Alur Proses Skripsi</h2>
      <p class="section-desc" style="color:#94a3b8">6 tahap yang jelas dan terstruktur dari pengajuan hingga yudisium</p>
    </div>
    <div class="alur-steps">
      <div class="alur-step">
        <div class="alur-step-num">1</div>
        <div class="alur-step-label">Pengajuan<br>Proposal</div>
      </div>
      <div class="alur-step">
        <div class="alur-step-num">2</div>
        <div class="alur-step-label">Persetujuan<br>Judul</div>
      </div>
      <div class="alur-step">
        <div class="alur-step-num">3</div>
        <div class="alur-step-label">Bimbingan</div>
      </div>
      <div class="alur-step">
        <div class="alur-step-num">4</div>
        <div class="alur-step-label">Seminar<br>Proposal</div>
      </div>
      <div class="alur-step">
        <div class="alur-step-num">5</div>
        <div class="alur-step-label">Sidang<br>Skripsi</div>
      </div>
      <div class="alur-step">
        <div class="alur-step-num">6</div>
        <div class="alur-step-label">Yudisium</div>
      </div>
    </div>
  </div>
</section>

<!-- ===== INFO LOGIN ===== -->
<section id="kontak" class="login-info-section" style="padding: 60px 5%;">
  <div class="login-info-inner">
    <h3 style="font-size:1.3rem;font-weight:800;margin-bottom:6px">Informasi Akun Login</h3>
    <p style="color:#64748b;font-size:.875rem">Gunakan akun berikut untuk login ke sistem SIMSKRIPSI</p>
    <div class="login-accounts">
      <div class="account-item" style="border-left: 3px solid #0ea5e9;">
        <div class="account-role" style="color:#0ea5e9"><i class="fas fa-user-graduate"></i> Mahasiswa</div>
        <div class="account-info">Username: <strong>NIM</strong></div>
        <div class="account-info">Password: <span class="account-pass">password123</span></div>
      </div>
      <div class="account-item" style="border-left: 3px solid #10b981;">
        <div class="account-role" style="color:#10b981"><i class="fas fa-chalkboard-teacher"></i> Dosen</div>
        <div class="account-info">Username: <strong>NIP</strong></div>
        <div class="account-info">Password: <span class="account-pass">password123</span></div>
      </div>
      <div class="account-item" style="border-left: 3px solid #8b5cf6;">
        <div class="account-role" style="color:#8b5cf6"><i class="fas fa-user-tie"></i> Ka. Prodi</div>
        <div class="account-info">Username: <strong>Akun Dosen</strong></div>
        <div class="account-info">Password: <span class="account-pass">password123</span></div>
      </div>
      <div class="account-item" style="border-left: 3px solid #ef4444;">
        <div class="account-role" style="color:#ef4444"><i class="fas fa-user-shield"></i> Admin</div>
        <div class="account-info">Username: <strong>admin</strong></div>
        <div class="account-info">Password: <span class="account-pass">password123</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ===== CTA ===== -->
<section class="cta-section">
  <h2 class="cta-title">Mulai Kelola Skripsi Anda Sekarang</h2>
  <p class="cta-desc">Login dan nikmati kemudahan proses skripsi yang transparan dan terintegrasi</p>
  <a href="login.php" class="btn-cta"><i class="fas fa-sign-in-alt"></i> Login ke SIMSKRIPSI</a>
</section>

<!-- ===== FOOTER ===== -->
<footer class="lp-footer">
  <p class="footer-text">&copy; 2026 <strong style="color:#94a3b8">SIMSKRIPSI</strong> — Universitas Muhammadiyah Bengkulu. Dibuat untuk keperluan pembelajaran Web Service &amp; Web Semantik.</p>
</footer>

<script>
// Navbar scroll effect
window.addEventListener('scroll', () => {
  const nav = document.getElementById('navbar');
  nav.classList.toggle('scrolled', window.scrollY > 30);
});
// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    e.preventDefault();
    const target = document.querySelector(a.getAttribute('href'));
    if (target) target.scrollIntoView({ behavior: 'smooth' });
  });
});
</script>
</body>
</html>
