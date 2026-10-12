<?php
/**
 * FOOTER COMPONENT - SIMSKRIPSI
 */
?>
      <footer class="app-footer">
        <div class="footer-content">
          <span>&copy; <?= date('Y') ?> <strong>SIMSKRIPSI</strong> - Universitas Muhammadiyah Bengkulu. Modul Pembelajaran Web Service &amp; Web Semantik.</span>
          <span class="footer-links">
            <a href="#">Bantuan</a> &bull;
            <a href="#">Panduan</a> &bull;
            <a href="#">Privasi</a>
          </span>
        </div>
      </footer>
    </main> <!-- /main-content -->
  </div> <!-- /app-body -->
</div> <!-- /app-wrapper -->

<!-- Global Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<script>
// Global Toast Notification Helper
function showToast(message, type = 'success') {
  const container = document.getElementById('toastContainer');
  if (!container) return;
  const toast = document.createElement('div');
  toast.className = `toast toast-${type}`;
  let iconClass = 'fa-check-circle';
  if (type === 'error') iconClass = 'fa-exclamation-circle';
  if (type === 'info') iconClass = 'fa-info-circle';

  toast.innerHTML = `
    <i class="fas ${iconClass} toast-icon"></i>
    <div style="flex:1;color:#1e293b;">${message}</div>
    <button style="background:none;border:none;color:#94a3b8;cursor:pointer;font-size:0.9rem;" onclick="this.parentElement.remove()">&times;</button>
  `;
  container.appendChild(toast);
  setTimeout(() => {
    toast.style.transition = 'all 0.3s ease';
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(100%)';
    setTimeout(() => toast.remove(), 300);
  }, 4000);
}

// Sidebar Toggle (Mobile & Desktop)
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar = document.getElementById('sidebar');
if (sidebarToggle && sidebar) {
  sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
  });
}

// User Dropdown
const userMenuBtn = document.getElementById('userMenuBtn');
const userDropdown = document.getElementById('userDropdown');
if (userMenuBtn && userDropdown) {
  userMenuBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    userDropdown.classList.toggle('show');
    if (notifDropdown) notifDropdown.classList.remove('show');
  });
}

// Notif Dropdown
const notifBtn = document.getElementById('notifBtn');
const notifDropdown = document.getElementById('notifDropdown');
if (notifBtn && notifDropdown) {
  notifBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    notifDropdown.classList.toggle('show');
    if (userDropdown) userDropdown.classList.remove('show');
  });
}

// Close dropdowns on outside click
document.addEventListener('click', () => {
  if (userDropdown) userDropdown.classList.remove('show');
  if (notifDropdown) notifDropdown.classList.remove('show');
});
</script>
</body>
</html>