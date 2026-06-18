<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa | IF-11-01</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ===== RESET & BASE ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:      #4f46e5;
            --primary-dark: #3730a3;
            --primary-light:#818cf8;
            --secondary:    #06b6d4;
            --success:      #10b981;
            --danger:       #ef4444;
            --warning:      #f59e0b;
            --bg:           #f1f5f9;
            --card-bg:      #ffffff;
            --text:         #1e293b;
            --text-muted:   #64748b;
            --border:       #e2e8f0;
            --shadow:       0 4px 24px rgba(79,70,229,.10);
            --radius:       16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ===== HEADER ===== */
        .header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, var(--primary-light) 100%);
            padding: 24px 0 52px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .header-content { position: relative; z-index: 1; }
        .header-badge {
            display: inline-block;
            background: rgba(255,255,255,.18);
            color: #fff;
            font-size: .75rem; font-weight: 600;
            letter-spacing: .08em; text-transform: uppercase;
            padding: 6px 18px; border-radius: 99px;
            border: 1px solid rgba(255,255,255,.3);
            margin-bottom: 16px;
        }
        .header h1 {
            font-size: 2.4rem; font-weight: 800;
            color: #fff; letter-spacing: -.5px;
            text-shadow: 0 2px 12px rgba(0,0,0,.2);
        }
        .header p {
            color: rgba(255,255,255,.85);
            font-size: 1rem; margin-top: 8px;
        }

        /* ===== IDENTITY CARD ===== */
        .identity-strip {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.25);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            display: inline-flex; gap: 32px;
            padding: 14px 32px; margin-top: 24px;
            color: #fff; font-size: .875rem;
        }
        .identity-strip span { font-weight: 600; }
        .identity-strip label { opacity: .7; font-weight: 400; margin-right: 4px; }

        /* ===== MAIN WRAPPER ===== */
        .main {
            max-width: 1200px;
            margin: -36px auto 60px;
            padding: 0 20px;
        }

        /* ===== STAT CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 22px 24px;
            box-shadow: var(--shadow);
            display: flex; align-items: center; gap: 16px;
            border-left: 5px solid var(--primary);
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 32px rgba(79,70,229,.15); }
        .stat-card.green  { border-color: var(--success); }
        .stat-card.cyan   { border-color: var(--secondary); }
        .stat-card.amber  { border-color: var(--warning); }
        .stat-card.red    { border-color: var(--danger); }

        .stat-icon {
            width: 50px; height: 50px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; flex-shrink: 0;
        }
        .stat-icon.indigo { background: #ede9fe; }
        .stat-icon.green  { background: #d1fae5; }
        .stat-icon.cyan   { background: #cffafe; }
        .stat-icon.amber  { background: #fef3c7; }
        .stat-icon.red    { background: #fee2e2; }

        .stat-info h3 { font-size: 1.6rem; font-weight: 800; line-height: 1; }
        .stat-info p  { font-size: .78rem; color: var(--text-muted); margin-top: 4px; }

        /* ===== TABLE CARD ===== */
        .table-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        .table-card-header {
            padding: 22px 28px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .table-card-header h2 {
            font-size: 1.15rem; font-weight: 700;
            display: flex; align-items: center; gap: 10px;
        }
        .table-card-header h2 .icon {
            background: #ede9fe; color: var(--primary);
            width: 34px; height: 34px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
        }
        .bobot-info {
            font-size: .78rem; color: var(--text-muted);
            background: var(--bg); padding: 6px 14px;
            border-radius: 99px;
        }

        /* ===== TABLE ===== */
        .table-wrap { overflow-x: auto; }
        table {
            width: 100%; border-collapse: collapse;
            font-size: .875rem;
        }
        thead th {
            background: #f8fafc;
            padding: 14px 16px;
            text-align: left;
            font-size: .72rem; font-weight: 700;
            letter-spacing: .06em; text-transform: uppercase;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border);
            white-space: nowrap;
        }
        thead th.center { text-align: center; }
        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f8fafc; }
        td { padding: 14px 16px; vertical-align: middle; }
        td.center { text-align: center; }

        /* row highlight untuk pembuat */
        tbody tr.row-maker { background: linear-gradient(90deg, #fdf4ff 0%, #fff 100%); }
        tbody tr.row-maker:hover { background: #f5e6ff; }

        /* NIM */
        .nim { font-family: monospace; color: var(--primary); font-weight: 600; font-size: .82rem; }

        /* Nama */
        .nama { font-weight: 600; }
        .kelas-badge {
            font-size: .68rem; background: #ede9fe; color: var(--primary);
            padding: 2px 8px; border-radius: 99px; margin-left: 6px;
            font-weight: 500;
        }
        .maker-tag {
            font-size: .68rem; background: #fae8ff; color: #a21caf;
            padding: 2px 8px; border-radius: 99px; margin-left: 6px;
            font-weight: 500;
        }

        /* Nilai cell */
        .nilai-cell { font-weight: 500; }

        /* Nilai akhir */
        .nilai-akhir { font-weight: 700; font-size: 1rem; color: var(--primary-dark); }

        /* Grade badges */
        .grade {
            display: inline-block;
            font-weight: 800; font-size: .9rem;
            width: 36px; height: 36px; line-height: 36px;
            border-radius: 10px; text-align: center;
        }
        .grade-A { background: #d1fae5; color: #065f46; }
        .grade-B { background: #dbeafe; color: #1e3a8a; }
        .grade-C { background: #fef9c3; color: #713f12; }
        .grade-D { background: #ffedd5; color: #7c2d12; }
        .grade-E { background: #fee2e2; color: #7f1d1d; }

        /* Status badges */
        .status {
            display: inline-flex; align-items: center; gap: 5px;
            font-weight: 600; font-size: .78rem;
            padding: 5px 12px; border-radius: 99px;
        }
        .status-lulus     { background: #d1fae5; color: #065f46; }
        .status-tidak     { background: #fee2e2; color: #991b1b; }
        .status::before { content: ''; width: 7px; height: 7px; border-radius: 50%; }
        .status-lulus::before { background: #10b981; }
        .status-tidak::before { background: #ef4444; }

        /* ===== FOOTER ===== */
        .footer {
            text-align: center; margin-top: 48px;
            font-size: .78rem; color: var(--text-muted);
        }
        .footer strong { color: var(--primary); }

        /* ===== FORMULA INFO ===== */
        .formula-card {
            background: linear-gradient(135deg, #ede9fe, #dbeafe);
            border: 1px solid #c4b5fd;
            border-radius: var(--radius);
            padding: 18px 24px;
            margin-bottom: 20px;
            font-size: .84rem;
            color: var(--primary-dark);
        }
        .formula-card strong { font-weight: 700; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            .header h1 { font-size: 1.6rem; }
            .identity-strip { flex-direction: column; gap: 8px; text-align: left; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

{{-- ==================== HEADER ==================== --}}
<header class="header">
    <div class="header-content">
        <div class="header-badge">🎓 Sistem Akademik · IF-11-01</div>
        <h1>Sistem Penilaian Mahasiswa</h1>
        <p>Rekap Nilai Akhir, Grade, & Status Kelulusan</p>

        {{-- Identitas Pembuat --}}
        <div class="identity-strip">
            <div><label>Nama</label><span>Imelda Fajar Awalina Crisyanti</span></div>
            <div><label>NIM</label><span>2311102004</span></div>
            <div><label>Kelas</label><span>IF-11-01</span></div>
        </div>
    </div>
</header>

{{-- ==================== MAIN ==================== --}}
<main class="main">

    {{-- STAT CARDS --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon indigo">👨‍🎓</div>
            <div class="stat-info">
                <h3>{{ $jumlahMahasiswa }}</h3>
                <p>Total Mahasiswa</p>
            </div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon green">✅</div>
            <div class="stat-info">
                <h3 style="color:#10b981">{{ $jumlahLulus }}</h3>
                <p>Mahasiswa Lulus</p>
            </div>
        </div>
        <div class="stat-card red">
            <div class="stat-icon red">❌</div>
            <div class="stat-info">
                <h3 style="color:#ef4444">{{ $jumlahMahasiswa - $jumlahLulus }}</h3>
                <p>Tidak Lulus</p>
            </div>
        </div>
        <div class="stat-card cyan">
            <div class="stat-icon cyan">📊</div>
            <div class="stat-info">
                <h3 style="color:#0891b2">{{ $rataRataKelas }}</h3>
                <p>Rata-rata Kelas</p>
            </div>
        </div>
        <div class="stat-card amber">
            <div class="stat-icon amber">🏆</div>
            <div class="stat-info">
                <h3 style="color:#d97706">{{ $nilaiTertinggi }}</h3>
                <p>Nilai Tertinggi</p>
            </div>
        </div>
    </div>

    {{-- FORMULA INFO --}}
    <div class="formula-card">
        📐 <strong>Formula Nilai Akhir:</strong>
        &nbsp; (Tugas × 30%) + (UTS × 35%) + (UAS × 35%)
        &nbsp;|&nbsp;
        🎯 <strong>Kelulusan:</strong> Nilai Akhir ≥ 60
        &nbsp;|&nbsp;
        🏅 <strong>Grade:</strong> A ≥ 85 &nbsp;· B ≥ 75 &nbsp;· C ≥ 65 &nbsp;· D ≥ 55 &nbsp;· E &lt; 55
    </div>

    {{-- TABLE CARD --}}
    <div class="table-card">
        <div class="table-card-header">
            <h2>
                <span class="icon">📋</span>
                Data Nilai Mahasiswa
            </h2>
            <span class="bobot-info">Tugas 30% &middot; UTS 35% &middot; UAS 35%</span>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th class="center">Tugas</th>
                        <th class="center">UTS</th>
                        <th class="center">UAS</th>
                        <th class="center">Nilai Akhir</th>
                        <th class="center">Grade</th>
                        <th class="center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data mahasiswa --}}
                    @foreach ($hasilMahasiswa as $index => $mhs)
                        <tr class="{{ $mhs['nim'] === '2311102004' ? 'row-maker' : '' }}">
                            <td style="color:var(--text-muted); font-weight:500;">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <span class="nama">{{ $mhs['nama'] }}</span>
                                @if ($mhs['nim'] === '2311102004')
                                    <span class="maker-tag">👑 Pembuat</span>
                                @endif
                            </td>
                            <td><span class="nim">{{ $mhs['nim'] }}</span></td>
                            <td class="center nilai-cell">{{ $mhs['nilai_tugas'] }}</td>
                            <td class="center nilai-cell">{{ $mhs['nilai_uts'] }}</td>
                            <td class="center nilai-cell">{{ $mhs['nilai_uas'] }}</td>
                            <td class="center">
                                <span class="nilai-akhir">{{ $mhs['nilai_akhir'] }}</span>
                            </td>
                            <td class="center">
                                <span class="grade grade-{{ $mhs['grade'] }}">
                                    {{ $mhs['grade'] }}
                                </span>
                            </td>
                            <td class="center">
                                <span class="status {{ $mhs['status'] === 'LULUS' ? 'status-lulus' : 'status-tidak' }}">
                                    {{ $mhs['status'] }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                {{-- SUMMARY ROW --}}
                <tfoot>
                    <tr style="background:#f8fafc; border-top: 2px solid var(--border);">
                        <td colspan="6" style="padding:14px 16px; font-weight:700; color:var(--text-muted); font-size:.8rem; text-transform:uppercase; letter-spacing:.05em;">
                            📊 Statistik Kelas
                        </td>
                        <td class="center">
                            <span style="font-weight:800; color:var(--primary-dark);">{{ $rataRataKelas }}</span>
                            <div style="font-size:.68rem; color:var(--text-muted);">Rata-rata</div>
                        </td>
                        <td class="center">
                            <span style="font-weight:800; color:#d97706;">{{ $nilaiTertinggi }}</span>
                            <div style="font-size:.68rem; color:var(--text-muted);">Tertinggi</div>
                        </td>
                        <td class="center">
                            <span style="font-weight:700; color:var(--success);">{{ $jumlahLulus }}/{{ $jumlahMahasiswa }}</span>
                            <div style="font-size:.68rem; color:var(--text-muted);">Lulus</div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- INFO NILAI TERTINGGI --}}
        <div style="padding: 16px 28px; background:#fffbeb; border-top:1px solid #fde68a; font-size:.84rem; color:#92400e;">
            🏆 <strong>Nilai Tertinggi</strong> diraih oleh
            <strong>{{ $mahasiswaTertinggi }}</strong>
            dengan nilai akhir <strong>{{ $nilaiTertinggi }}</strong>
        </div>
    </div>

</main>

{{-- ==================== FOOTER ==================== --}}
<footer class="footer">
    <p>
        Dibuat oleh <strong>Imelda Fajar Awalina Crisyanti</strong>
        &middot; NIM <strong>2311102004</strong>
        &middot; Kelas <strong>IF-11-01</strong>
    </p>
    <p style="margin-top:4px;">
        Tugas Modul 9 – Pemrograman Web &middot; Laravel Framework
    </p>
</footer>

</body>
</html>