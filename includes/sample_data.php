<?php
/**
 * DATA REPOSITORY & HELPER - SIMSKRIPSI
 * Universitas Muhammadiyah Bengkulu
 * Mendukung data langsung dari MySQL atau fallback mockup data
 */
require_once dirname(__DIR__) . '/config/koneksi.php';

// Mock data identik dengan gambar rencana / mockup
function getMockProposals(): array {
    return [
        [
            'id' => 1,
            'nama' => 'Andi Pratama',
            'npm' => '221010001',
            'judul' => 'Analisis Sistem Informasi Manajemen Rumah Sakit Berbasis Cloud',
            'prodi' => 'Manajemen',
            'status' => 'Diajukan',
            'dosen' => 'Dr. Budi Santoso, M.M',
            'tanggal' => '10-10-2026',
            'created_at' => '2026-10-10'
        ],
        [
            'id' => 2,
            'nama' => 'Siti Rahmawati',
            'npm' => '221010002',
            'judul' => 'Implementasi Web Service dan Web Semantik pada Sistem Informasi Akademik',
            'prodi' => 'TI',
            'status' => 'Bimbingan',
            'dosen' => 'Dr. Ahmad, M.Kom',
            'tanggal' => '09-10-2026',
            'created_at' => '2026-10-01'
        ],
        [
            'id' => 3,
            'nama' => 'Budi Santoso',
            'npm' => '221010003',
            'judul' => 'Pengaruh Digital Marketing terhadap Keputusan Pembelian Konsumen',
            'prodi' => 'Manajemen',
            'status' => 'Disetujui',
            'dosen' => 'Dr. Budi Santoso, M.M',
            'tanggal' => '08-10-2026',
            'created_at' => '2026-10-08'
        ],
        [
            'id' => 4,
            'nama' => 'Dela Anggraini',
            'npm' => '221010004',
            'judul' => 'Sistem Pendukung Keputusan Pemilihan Dosen Terbaik Menggunakan Metode TOPSIS',
            'prodi' => 'TI',
            'status' => 'Seminar',
            'dosen' => 'Prof. Dr. Ir. Hendra, M.T',
            'tanggal' => '05-10-2026',
            'created_at' => '2026-09-28'
        ],
        [
            'id' => 5,
            'nama' => 'Rizky Maulana',
            'npm' => '221010005',
            'judul' => 'Implementasi Web Semantik untuk Pencarian Repositori Karya Ilmiah',
            'prodi' => 'TI',
            'status' => 'Ditolak',
            'dosen' => 'Dr. Ahmad, M.Kom',
            'tanggal' => '03-10-2026',
            'created_at' => '2026-09-25'
        ],
        [
            'id' => 6,
            'nama' => 'Fajar Nugraha',
            'npm' => '221010006',
            'judul' => 'Audit Tata Kelola Teknologi Informasi Menggunakan Framework COBIT 2019',
            'prodi' => 'Sistem Informasi',
            'status' => 'Sidang',
            'dosen' => 'Dr. Ahmad, M.Kom',
            'tanggal' => '01-10-2026',
            'created_at' => '2026-09-15'
        ]
    ];
}

function getMockBimbinganLogs(int $proposalId = 2): array {
    return [
        [
            'no' => 1,
            'tanggal' => '03-10-2026',
            'catatan' => 'Perbaiki latar belakang dan kajian pustaka terkait Web Semantik dan RDF ontology',
            'file' => 'catatan1.pdf',
            'status' => 'Selesai'
        ],
        [
            'no' => 2,
            'tanggal' => '08-10-2026',
            'catatan' => 'Lanjut ke metode penelitian dan perancangan arsitektur REST API & SPARQL endpoint',
            'file' => 'catatan2.pdf',
            'status' => 'Sedang Berjalan'
        ]
    ];
}

function getProposalList(): array {
    $db = getDBSimskripsi(true);
    if ($db) {
        try {
            $stmt = $db->query("SELECT p.*, d.nama AS dosen_nama FROM proposal p LEFT JOIN dosen d ON d.id = p.dosen_pembimbing1_id ORDER BY p.id DESC");
            $rows = $stmt->fetchAll();
            if (!empty($rows)) {
                $result = [];
                foreach ($rows as $r) {
                    $result[] = [
                        'id' => $r['id'],
                        'nama' => $r['nama_mahasiswa'],
                        'npm' => $r['nim'],
                        'judul' => $r['judul'],
                        'prodi' => $r['nama_prodi'],
                        'status' => $r['status'],
                        'dosen' => $r['dosen_nama'] ?? 'Belum Ditentukan',
                        'tanggal' => date('d-m-Y', strtotime($r['tanggal_pengajuan'])),
                        'created_at' => $r['tanggal_pengajuan']
                    ];
                }
                return $result;
            }
        } catch (Exception $e) {}
    }
    return getMockProposals();
}

function getProposalById(int $id): ?array {
    $list = getProposalList();
    foreach ($list as $p) {
        if ($p['id'] === $id) return $p;
    }
    return $list[1] ?? ($list[0] ?? null); // default to Siti Rahmawati if not matched
}

function getProposalByMahasiswa(string $npm): array {
    $list = getProposalList();
    foreach ($list as $p) {
        if ($p['npm'] === $npm) return $p;
    }
    // Return Siti Rahmawati proposal as demo
    return $list[1] ?? $list[0];
}
