<?php
$mahasiswa = [
    [
        "nama" => "Nofita Fitriyani",
        "nim" => "2311102001",
        "tugas" => 85,
        "uts" => 80,
        "uas" => 88
    ],
    [
        "nama" => "Aulia Rahman",
        "nim" => "2311102002",
        "tugas" => 78,
        "uts" => 75,
        "uas" => 82
    ],
    [
        "nama" => "Salsa Putri",
        "nim" => "2311102003",
        "tugas" => 90,
        "uts" => 92,
        "uas" => 89
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas)
{
    return ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
}

function tentukanGrade($nilaiAkhir)
{
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

function tentukanStatus($nilaiAkhir)
{
    return ($nilaiAkhir >= 70) ? "Lulus" : "Tidak Lulus";
}

$totalNilai = 0;
$nilaiTertinggi = 0;
$namaTertinggi = "";

foreach ($mahasiswa as $mhs) {
    $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
    $totalNilai += $nilaiAkhir;

    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
        $namaTertinggi = $mhs["nama"];
    }
}

$rataRataKelas = $totalNilai / count($mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Nilai Mahasiswa</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            margin: 0;
            padding: 30px;
            color: #1e293b;
        }

        .container {
            max-width: 950px;
            margin: auto;
            background: #ffffff;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            text-align: center;
            color: #0f172a;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 12px;
        }

        thead {
            background: #334155;
            color: white;
        }

        th, td {
            padding: 14px 12px;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        tbody tr:hover {
            background: #e2e8f0;
            transition: 0.3s;
        }

        .status-lulus {
            color: #166534;
            font-weight: bold;
        }

        .status-tidak {
            color: #b91c1c;
            font-weight: bold;
        }

        .info-box {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
            margin-top: 25px;
        }

        .card {
            background: #f8fafc;
            border-left: 5px solid #475569;
            padding: 18px;
            border-radius: 12px;
        }

        .card h3 {
            margin: 0 0 8px;
            font-size: 16px;
            color: #334155;
        }

        .card p {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
        }

        .footer-note {
            margin-top: 20px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rekap Nilai Mahasiswa</h1>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Nilai Tugas</th>
                    <th>Nilai UTS</th>
                    <th>Nilai UAS</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($mahasiswa as $mhs): ?>
                    <?php
                        $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
                        $grade = tentukanGrade($nilaiAkhir);
                        $status = tentukanStatus($nilaiAkhir);
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $mhs["nama"]; ?></td>
                        <td><?= $mhs["nim"]; ?></td>
                        <td><?= $mhs["tugas"]; ?></td>
                        <td><?= $mhs["uts"]; ?></td>
                        <td><?= $mhs["uas"]; ?></td>
                        <td><?= number_format($nilaiAkhir, 2); ?></td>
                        <td><?= $grade; ?></td>
                        <td class="<?= ($status == 'Lulus') ? 'status-lulus' : 'status-tidak'; ?>">
                            <?= $status; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="info-box">
            <div class="card">
                <h3>Rata-rata Kelas</h3>
                <p><?= number_format($rataRataKelas, 2); ?></p>
            </div>
            <div class="card">
                <h3>Nilai Tertinggi</h3>
                <p><?= number_format($nilaiTertinggi, 2); ?></p>
            </div>
            <div class="card">
                <h3>Mahasiswa Nilai Tertinggi</h3>
                <p><?= $namaTertinggi; ?></p>
            </div>
        </div>
    </div>
</body>
</html>