<?php
/**
 * ============================================================================
 * KONFIGURASI KONEKSI DATABASE - SIMSKRIPSI
 * Universitas Muhammadiyah Bengkulu
 * ============================================================================
 *
 * MODE SINGLE DB (Hosting Gratis - 1 database):
 *   - Set SINGLE_DB_MODE = true
 *   - Isi DB_NAME dengan nama database hosting (misal: u123456_db)
 *   - Import: database.sql (web universitas) + database_simskripsi_addon.sql
 *   - Kedua koneksi akan mengarah ke 1 database yang sama
 *
 * MODE DUAL DB (Localhost / Hosting berbayar - 2 database):
 *   - Set SINGLE_DB_MODE = false
 *   - Isi DB_SIMMAHASISWA dan DB_SIMSKRIPSI dengan nama masing-masing
 *   - Import: database.sql + database_simskripsi.sql (terpisah)
 * ============================================================================
 */

// ============================================================
//  ⚙️  UBAH KONFIGURASI DI SINI SESUAI HOSTING ANDA
// ============================================================
if (!defined('DB_HOST')) define('DB_HOST', '127.0.0.1');   // Ganti dengan host hosting
if (!defined('DB_USER')) define('DB_USER', 'root');          // Ganti dengan user hosting
if (!defined('DB_PASS')) define('DB_PASS', '');              // Ganti dengan password hosting
if (!defined('DB_PORT')) define('DB_PORT', '3306');

/**
 * SINGLE_DB_MODE:
 *   true  = 1 database (untuk hosting gratis)
 *   false = 2 database terpisah (untuk localhost/hosting berbayar)
 */
if (!defined('SINGLE_DB_MODE')) define('SINGLE_DB_MODE', true);

// Nama database saat SINGLE_DB_MODE = true (1 database gabungan)
if (!defined('DB_NAME'))        define('DB_NAME',        'db_universitas');

// Nama database saat SINGLE_DB_MODE = false (2 database terpisah)
if (!defined('DB_SIMMAHASISWA')) define('DB_SIMMAHASISWA', 'db_universitas');
if (!defined('DB_SIMSKRIPSI'))   define('DB_SIMSKRIPSI',   'db_simskripsi');

// ============================================================
//  Tentukan nama DB yang aktif berdasarkan mode
// ============================================================
$_db_mhs_name     = SINGLE_DB_MODE ? DB_NAME : DB_SIMMAHASISWA;
$_db_skripsi_name = SINGLE_DB_MODE ? DB_NAME : DB_SIMSKRIPSI;

/**
 * Koneksi ke database SIMMAHASISWA
 * (mahasiswa, prodi, admin - tabel: users, students, study_programs, dll)
 */
function getDBSimmahasiswa(bool $silent = true): ?PDO {
    global $_db_mhs_name;
    static $pdo = null;
    static $attempted = false;
    if ($pdo !== null) return $pdo;
    if ($attempted && $silent) return null;
    $attempted = true;

    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . $_db_mhs_name . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        if (!$silent) {
            die(renderDBError($_db_mhs_name . ' (SIMMAHASISWA)', $e->getMessage()));
        }
        return null;
    }
}

/**
 * Koneksi ke database SIMSKRIPSI
 * (dosen, proposal, bimbingan, seminar, sidang, jadwal)
 * Di mode SINGLE_DB, koneksi ini sama dengan SIMMAHASISWA
 */
function getDBSimskripsi(bool $silent = true): ?PDO {
    global $_db_skripsi_name;

    // Jika SINGLE_DB_MODE aktif, pakai koneksi yang sama
    if (SINGLE_DB_MODE) {
        return getDBSimmahasiswa($silent);
    }

    static $pdo2 = null;
    static $attempted2 = false;
    if ($pdo2 !== null) return $pdo2;
    if ($attempted2 && $silent) return null;
    $attempted2 = true;

    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . $_db_skripsi_name . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo2 = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo2;
    } catch (PDOException $e) {
        if (!$silent) {
            die(renderDBError($_db_skripsi_name . ' (SIMSKRIPSI)', $e->getMessage()));
        }
        return null;
    }
}

/** Cek status koneksi database */
function checkDBStatus(): array {
    if (SINGLE_DB_MODE) {
        $ok = getDBSimmahasiswa(true) !== null;
        return ['simmahasiswa' => $ok, 'simskripsi' => $ok];
    }
    return [
        'simmahasiswa' => getDBSimmahasiswa(true) !== null,
        'simskripsi'   => getDBSimskripsi(true)   !== null,
    ];
}

/** Helper tampilkan pesan error koneksi */
function renderDBError(string $dbName, string $msg): string {
    return "<div style='font-family:sans-serif;max-width:600px;margin:50px auto;padding:24px;border:1px solid #fecaca;background:#fef2f2;border-radius:8px;color:#991b1b;'>"
         . "<h3>Gagal Terhubung ke Database: <em>{$dbName}</em></h3>"
         . "<p>Pastikan MySQL berjalan dan database sudah di-import dengan benar.</p>"
         . "<p style='font-size:0.85rem;'><strong>Error:</strong> " . htmlspecialchars($msg) . "</p>"
         . "</div>";
}

