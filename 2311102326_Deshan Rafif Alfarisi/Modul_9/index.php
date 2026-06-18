<?php
/**
 * Program PHP sederhana untuk menampilkan data nilai mahasiswa,
 * menghitung nilai akhir, menentukan grade, dan status kelulusan.
 * 
 * Pengembang: Deshan Rafif Alfarisi (2311102326)
 */

// 1. Array Asosiasi untuk menyimpan data mahasiswa
$mahasiswaList = [
    [
        "nama" => "Deshan Rafif Alfarisi",
        "nim" => "2311102326",
        "nilai_tugas" => 100,
        "nilai_uts" => 100,
        "nilai_uas" => 100
    ],
    [
        "nama" => "Fathur Rahman",
        "nim" => "2311102302",
        "nilai_tugas" => 85,
        "nilai_uts" => 80,
        "nilai_uas" => 90
    ],
    [
        "nama" => "Aura Salsabila",
        "nim" => "2311102315",
        "nilai_tugas" => 90,
        "nilai_uts" => 95,
        "nilai_uas" => 92
    ],
    [
        "nama" => "Budi Pratama",
        "nim" => "2311102340",
        "nilai_tugas" => 55,
        "nilai_uts" => 60,
        "nilai_uas" => 58
    ],
    [
        "nama" => "Citra Wahyuni",
        "nim" => "2311102355",
        "nilai_tugas" => 75,
        "nilai_uts" => 70,
        "nilai_uas" => 78
    ]
];

// 2. Function untuk menghitung nilai akhir
// Bobot: Tugas 30%, UTS 30%, UAS 40%
function hitungNilaiAkhir($tugas, $uts, $uas) {
    // Menggunakan operator aritmatika (* dan +)
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// 3. Function untuk menentukan grade berdasarkan nilai akhir
function tentukanGrade($nilaiAkhir) {
    // Menggunakan struktur kontrol if/else
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 75) {
        return "B";
    } elseif ($nilaiAkhir >= 65) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}

// 4. Function untuk menentukan status kelulusan
function tentukanStatus($nilaiAkhir) {
    // Menggunakan operator perbandingan
    if ($nilaiAkhir >= 60) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

// Proses data untuk statistik
$totalNilaiAkhir = 0;
$nilaiTertinggi = 0;
$mahasiswaTertinggi = "";

foreach ($mahasiswaList as &$mhs) {
    $na = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
    $mhs['nilai_akhir'] = $na;
    $mhs['grade'] = tentukanGrade($na);
    $mhs['status'] = tentukanStatus($na);
    
    $totalNilaiAkhir += $na;
    
    if ($na > $nilaiTertinggi) {
        $nilaiTertinggi = $na;
        $mahasiswaTertinggi = $mhs['nama'];
    }
}
unset($mhs); // Putus referensi loop

$rataRataKelas = count($mahasiswaList) > 0 ? $totalNilaiAkhir / count($mahasiswaList) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Akademik Sederhana untuk menampilkan data nilai mahasiswa, grade, dan kelulusan.">
    <title>Sistem Evaluasi Nilai Mahasiswa</title>
    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(22, 29, 49, 0.7);
            --border-color: rgba(255, 255, 255, 0.08);
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --accent-primary: #4f46e5;
            --accent-success: #10b981;
            --accent-danger: #ef4444;
            --gradient-accent: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            --glow-color: rgba(99, 102, 241, 0.15);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 10% 20%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(16, 185, 129, 0.03) 0px, transparent 50%);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
            width: 100%;
        }

        /* Header Styling */
        header {
            text-align: center;
            margin-bottom: 3rem;
        }

        header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff 0%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        header p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            font-weight: 400;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-accent);
        }

        .stat-card.success::before {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
        }

        .stat-card.info::before {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        }

        .stat-label {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .stat-value {
            font-family: 'Outfit', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.2;
        }

        .stat-subtext {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
        }

        /* Table Card Container */
        .table-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin-bottom: 2rem;
        }

        .table-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
            background: rgba(15, 23, 42, 0.3);
        }

        .table-header h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: #ffffff;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.95rem;
        }

        th {
            background: rgba(15, 23, 42, 0.5);
            padding: 1.2rem 1.5rem;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--border-color);
        }

        td {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-primary);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr {
            transition: background-color 0.2s ease;
        }

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.02);
        }

        /* Student Names Highlight */
        .student-info {
            display: flex;
            flex-direction: column;
        }

        .student-name {
            font-weight: 600;
            color: #ffffff;
        }

        .student-nim {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 0.2rem;
        }

        /* Badges & Scores styles */
        .score-badge {
            background: rgba(255, 255, 255, 0.05);
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            border: 1px solid var(--border-color);
        }

        .final-score {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: #818cf8;
        }

        .grade-badge {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: #ffffff;
        }

        .grade-a { background: linear-gradient(135deg, #10b981 0%, #059669 100%); box-shadow: 0 0 10px rgba(16, 185, 129, 0.3); }
        .grade-b { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); box-shadow: 0 0 10px rgba(59, 130, 246, 0.3); }
        .grade-c { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); box-shadow: 0 0 10px rgba(245, 158, 11, 0.3); }
        .grade-d { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
        .grade-e { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); box-shadow: 0 0 10px rgba(239, 68, 68, 0.3); }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.8rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-lulus {
            background-color: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-lulus::before {
            background-color: #10b981;
            box-shadow: 0 0 8px #10b981;
        }

        .status-tidak-lulus {
            background-color: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-tidak-lulus::before {
            background-color: #ef4444;
            box-shadow: 0 0 8px #ef4444;
        }

        /* Footer Styling */
        footer {
            text-align: center;
            padding: 2rem 0;
            color: var(--text-secondary);
            font-size: 0.85rem;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }

        footer strong {
            color: #a5b4fc;
        }

        /* Responsive design adjustments */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2rem;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            td, th {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header Section -->
        <header>
            <h1>Sistem Evaluasi Akademik</h1>
            <p>Daftar Rekapitulasi Nilai Akhir & Kelulusan Mahasiswa</p>
        </header>

        <!-- Stats Section -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Rata-rata Kelas</div>
                <div class="stat-value"><?php echo number_format($rataRataKelas, 2); ?></div>
                <div class="stat-subtext">Dari keseluruhan <?php echo count($mahasiswaList); ?> mahasiswa terdaftar</div>
            </div>
            
            <div class="stat-card success">
                <div class="stat-label">Nilai Tertinggi</div>
                <div class="stat-value"><?php echo number_format($nilaiTertinggi, 2); ?></div>
                <div class="stat-subtext">Oleh: <strong><?php echo htmlspecialchars($mahasiswaTertinggi); ?></strong></div>
            </div>

            <div class="stat-card info">
                <div class="stat-label">Tingkat Kelulusan</div>
                <div class="stat-value">
                    <?php
                    $lulusCount = 0;
                    foreach ($mahasiswaList as $mhs) {
                        if ($mhs['status'] === 'Lulus') $lulusCount++;
                    }
                    echo number_format(($lulusCount / count($mahasiswaList)) * 100, 1) . '%';
                    ?>
                </div>
                <div class="stat-subtext"><?php echo $lulusCount; ?> dari <?php echo count($mahasiswaList); ?> mahasiswa lulus evaluasi</div>
            </div>
        </div>

        <!-- Table Card Section -->
        <div class="table-card">
            <div class="table-header">
                <h2>Data Hasil Belajar Mahasiswa</h2>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Tugas (30%)</th>
                            <th>UTS (30%)</th>
                            <th>UAS (40%)</th>
                            <th>Nilai Akhir</th>
                            <th>Grade</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswaList as $mhs): ?>
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <span class="student-name"><?php echo htmlspecialchars($mhs['nama']); ?></span>
                                        <span class="student-nim">NIM: <?php echo htmlspecialchars($mhs['nim']); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="score-badge"><?php echo $mhs['nilai_tugas']; ?></span>
                                </td>
                                <td>
                                    <span class="score-badge"><?php echo $mhs['nilai_uts']; ?></span>
                                </td>
                                <td>
                                    <span class="score-badge"><?php echo $mhs['nilai_uas']; ?></span>
                                </td>
                                <td>
                                    <span class="final-score"><?php echo number_format($mhs['nilai_akhir'], 1); ?></span>
                                </td>
                                <td>
                                    <?php 
                                    $gradeClass = 'grade-' . strtolower($mhs['grade']);
                                    ?>
                                    <span class="grade-badge <?php echo $gradeClass; ?>"><?php echo $mhs['grade']; ?></span>
                                </td>
                                <td>
                                    <?php if ($mhs['status'] === 'Lulus'): ?>
                                        <span class="status-pill status-lulus">Lulus</span>
                                    <?php else: ?>
                                        <span class="status-pill status-tidak-lulus">Tidak Lulus</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>Sistem dibuat oleh: <strong>Deshan Rafif Alfarisi (2311102326)</strong> | Praktikum Web &copy; <?php echo date('Y'); ?></p>
    </footer>

</body>
</html>
