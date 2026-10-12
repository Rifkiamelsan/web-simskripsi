-- ============================================================================
-- ADDON SQL: Tabel SIMSKRIPSI untuk digabung ke db_universitas
-- ============================================================================
-- CARA PAKAI (di Hosting):
--   1. Pastikan database db_universitas (web universitas) sudah di-import
--   2. Buka phpMyAdmin hosting -> pilih database yang dipakai web universitas
--   3. Klik tab "SQL" -> paste dan jalankan file ini
--   4. Selesai! Tabel simskripsi sudah masuk ke database yang sama
-- ============================================================================

-- Hapus tabel lama jika ada (urutan penting karena ada foreign key)
DROP TABLE IF EXISTS `sidang`;
DROP TABLE IF EXISTS `seminar`;
DROP TABLE IF EXISTS `jadwal`;
DROP TABLE IF EXISTS `dokumen`;
DROP TABLE IF EXISTS `bimbingan`;
DROP TABLE IF EXISTS `proposal`;
DROP TABLE IF EXISTS `users_dosen`;
DROP TABLE IF EXISTS `dosen`;

-- ----------------------------------------------------------------------------
-- TABEL: dosen
-- ----------------------------------------------------------------------------
CREATE TABLE `dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `gelar_depan` varchar(50) DEFAULT NULL,
  `gelar_belakang` varchar(50) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT 'Dosen Pembimbing',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- TABEL: users_dosen
-- ----------------------------------------------------------------------------
CREATE TABLE `users_dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  CONSTRAINT `fk_ud_dosen` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- TABEL: proposal
-- ----------------------------------------------------------------------------
CREATE TABLE `proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama_mahasiswa` varchar(150) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `nama_prodi` varchar(150) NOT NULL,
  `judul` text NOT NULL,
  `bidang_penelitian` varchar(150) DEFAULT NULL,
  `dosen_pembimbing1_id` int(11) DEFAULT NULL,
  `dosen_pembimbing2_id` int(11) DEFAULT NULL,
  `status` enum('Diajukan','Disetujui','Bimbingan','Revisi','Seminar','Sidang','Selesai','Ditolak') DEFAULT 'Diajukan',
  `catatan_admin` text DEFAULT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tanggal_disetujui` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_p_dosen1` FOREIGN KEY (`dosen_pembimbing1_id`) REFERENCES `dosen` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_p_dosen2` FOREIGN KEY (`dosen_pembimbing2_id`) REFERENCES `dosen` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- TABEL: bimbingan
-- ----------------------------------------------------------------------------
CREATE TABLE `bimbingan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `ke` int(11) NOT NULL DEFAULT 1,
  `tanggal` date NOT NULL,
  `catatan` text NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_b_proposal` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_b_dosen` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- TABEL: dokumen
-- ----------------------------------------------------------------------------
CREATE TABLE `dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `jenis` enum('Proposal','Revisi','BAB','Skripsi Lengkap','Turnitin','Lainnya') NOT NULL,
  `judul_dokumen` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `diunggah_oleh` enum('mahasiswa','dosen','admin') DEFAULT 'mahasiswa',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_d_proposal` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- TABEL: jadwal
-- ----------------------------------------------------------------------------
CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `jenis` enum('Seminar Proposal','Sidang Skripsi') NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruang` varchar(100) NOT NULL,
  `penguji1_id` int(11) DEFAULT NULL,
  `penguji2_id` int(11) DEFAULT NULL,
  `status` enum('Terjadwal','Berlangsung','Selesai','Dibatalkan') DEFAULT 'Terjadwal',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_j_proposal` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- TABEL: seminar
-- ----------------------------------------------------------------------------
CREATE TABLE `seminar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `jadwal_id` int(11) DEFAULT NULL,
  `nilai_penguji1` decimal(5,2) DEFAULT NULL,
  `nilai_penguji2` decimal(5,2) DEFAULT NULL,
  `nilai_pembimbing` decimal(5,2) DEFAULT NULL,
  `nilai_akhir` decimal(5,2) DEFAULT NULL,
  `hasil` enum('Lulus','Lulus Dengan Revisi','Tidak Lulus') DEFAULT NULL,
  `catatan_penguji` text DEFAULT NULL,
  `revisi_deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_sm_proposal` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_sm_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- TABEL: sidang
-- ----------------------------------------------------------------------------
CREATE TABLE `sidang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proposal_id` int(11) NOT NULL,
  `jadwal_id` int(11) DEFAULT NULL,
  `nilai_penguji1` decimal(5,2) DEFAULT NULL,
  `nilai_penguji2` decimal(5,2) DEFAULT NULL,
  `nilai_pembimbing` decimal(5,2) DEFAULT NULL,
  `nilai_akhir` decimal(5,2) DEFAULT NULL,
  `predikat` enum('Dengan Pujian','Sangat Memuaskan','Memuaskan','Cukup') DEFAULT NULL,
  `hasil` enum('Lulus','Lulus Dengan Revisi','Tidak Lulus') DEFAULT NULL,
  `tanggal_yudisium` date DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_sd_proposal` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_sd_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- DATA SAMPLE DOSEN (password semua: "password123")
-- ----------------------------------------------------------------------------
INSERT INTO `dosen` (`nip`,`nama`,`gelar_depan`,`gelar_belakang`,`email`,`no_hp`,`prodi_id`,`jabatan`,`status`) VALUES
('0412057801','Hendra Setiawan','Dr. Ir.','M.T.','hendra.setiawan@umb.ac.id','081234567801',1,'Dosen Pembimbing','Aktif'),
('0415088202','Bambang Trianto',NULL,'S.Kom., M.Cs.','bambang.trianto@umb.ac.id','081234567802',1,'Dosen Pembimbing','Aktif'),
('0420118503','Maya Kartika','Dr.','S.Si., M.Sc.','maya.kartika@umb.ac.id','081234567803',1,'Dosen Pembimbing','Aktif'),
('0425028904','Rizky Firmansyah',NULL,'M.Kom.','rizky.f@umb.ac.id','081234567804',1,'Dosen Penguji','Aktif'),
('0410098705','Fajar Nugroho',NULL,'M.T.','fajar.nugroho@umb.ac.id','081234567805',2,'Dosen Pembimbing','Aktif'),
('0418048606','Dewi Anggraini',NULL,'M.Kom.','dewi.a@umb.ac.id','081234567806',2,'Dosen Penguji','Aktif'),
('19800101','Ahmad','Dr.','M.Kom.','ahmad@umb.ac.id','081234567899',1,'Dosen Pembimbing','Aktif');

INSERT INTO `users_dosen` (`dosen_id`,`username`,`password`,`is_active`) VALUES
(1,'0412057801','$2y$10$wT0lJkK5zZzXg/2JtJt90.6ZlWkP3OqjN6vO3ZzY1Y7F6e6h7oNGe',1),
(2,'0415088202','$2y$10$wT0lJkK5zZzXg/2JtJt90.6ZlWkP3OqjN6vO3ZzY1Y7F6e6h7oNGe',1),
(3,'0420118503','$2y$10$wT0lJkK5zZzXg/2JtJt90.6ZlWkP3OqjN6vO3ZzY1Y7F6e6h7oNGe',1),
(4,'0425028904','$2y$10$wT0lJkK5zZzXg/2JtJt90.6ZlWkP3OqjN6vO3ZzY1Y7F6e6h7oNGe',1),
(5,'0410098705','$2y$10$wT0lJkK5zZzXg/2JtJt90.6ZlWkP3OqjN6vO3ZzY1Y7F6e6h7oNGe',1),
(6,'0418048606','$2y$10$wT0lJkK5zZzXg/2JtJt90.6ZlWkP3OqjN6vO3ZzY1Y7F6e6h7oNGe',1),
(7,'19800101','$2y$10$wT0lJkK5zZzXg/2JtJt90.6ZlWkP3OqjN6vO3ZzY1Y7F6e6h7oNGe',1);
