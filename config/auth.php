<?php
/**
 * AUTH HELPER - SIMSKRIPSI
 * Mengelola sesi login untuk semua role:
 * - mahasiswa, prodi, admin -> auth dari db_universitas
 * - dosen -> auth dari db_simskripsi
 */
require_once __DIR__ . '/koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** Cek apakah user sudah login */
function isLoggedIn(): bool {
    return isset($_SESSION['simskripsi_user_id']) && !empty($_SESSION['simskripsi_role']);
}

/** Ambil data session user */
function getAuthUser(): array {
    return [
        'id'       => $_SESSION['simskripsi_user_id'] ?? null,
        'nama'     => $_SESSION['simskripsi_nama'] ?? '',
        'username' => $_SESSION['simskripsi_username'] ?? '',
        'role'     => $_SESSION['simskripsi_role'] ?? '',
        'extra_id' => $_SESSION['simskripsi_extra_id'] ?? null, // student.id / dosen.id
    ];
}

/** Redirect jika belum login */
function requireLogin(string $redirect = '../login.php'): void {
    if (!isLoggedIn()) {
        header("Location: {$redirect}");
        exit;
    }
}

/** Pastikan role sesuai */
function requireRole(array $allowedRoles, string $redirect = '../login.php'): void {
    requireLogin($redirect);
    $user = getAuthUser();
    if (!in_array($user['role'], $allowedRoles)) {
        redirectToDashboard();
    }
}

/** Redirect ke dashboard sesuai role */
function redirectToDashboard(): void {
    $role = $_SESSION['simskripsi_role'] ?? '';
    $map = [
        'admin'     => 'admin/dashboard.php',
        'prodi'     => 'prodi/dashboard.php',
        'mahasiswa' => 'mahasiswa/dashboard.php',
        'dosen'     => 'dosen/dashboard.php',
    ];
    $target = $map[$role] ?? 'login.php';
    header("Location: " . BASE_URL . $target);
    exit;
}

/** Logout */
function doLogout(): void {
    session_unset();
    session_destroy();
    header('Location: ' . BASE_URL . 'login.php?logout=1');
    exit;
}

// ---- Konstanta URL ----
if (!defined('BASE_URL')) {
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $dir = dirname($scriptName);
    // Hapus subfolder controller/modul jika dipanggil dari dalamnya
    $dir = preg_replace('#/(admin|dosen|mahasiswa|prodi|config)$#i', '', $dir);
    $basePath = rtrim(str_replace('\\', '/', $dir), '/');
    define('BASE_URL', ($basePath ? $basePath : '') . '/');
}
