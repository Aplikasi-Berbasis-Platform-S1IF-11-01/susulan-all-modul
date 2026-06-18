<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventaris Toko') — Pak Cik & Mas Aimar</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- DataTables --}}
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

    <style>
        /* ── CSS Variables ─────────────────────────────────────────────── */
        :root {
            --dark-brown:   #4B2E2B;
            --medium-brown: #6F4E37;
            --light-brown:  #A67B5B;
            --pale-brown:   #C4956A;
            --cream:        #F5F5DC;
            --cream-dark:   #EDE8D0;
            --white:        #FFFFFF;
            --text-dark:    #2C1810;
            --text-mid:     #5C3D2E;
            --text-muted:   #8B6B52;
            --sidebar-w:    260px;
            --navbar-h:     64px;
            --shadow-sm:    0 2px 8px rgba(75,46,43,.12);
            --shadow-md:    0 4px 20px rgba(75,46,43,.18);
            --shadow-lg:    0 8px 40px rgba(75,46,43,.22);
            --radius:       12px;
            --radius-sm:    8px;
        }

        /* ── Reset & Base ───────────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* ── Sidebar ────────────────────────────────────────────────────── */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--dark-brown);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-y: auto;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }

        .sidebar-brand .brand-icon {
            width: 44px; height: 44px;
            background: var(--medium-brown);
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; margin-bottom: 10px;
            box-shadow: var(--shadow-sm);
        }

        .sidebar-brand .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 700;
            color: var(--cream);
            line-height: 1.3;
            margin: 0;
        }

        .sidebar-brand .brand-sub {
            font-size: 11px; color: var(--light-brown);
            margin: 2px 0 0;
            font-weight: 400;
            letter-spacing: .5px;
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--light-brown);
            padding: 8px 8px 6px;
            margin-bottom: 4px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            color: rgba(245,245,220,.75);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all .2s ease;
            margin-bottom: 2px;
        }

        .sidebar-nav .nav-link i {
            font-size: 17px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: var(--medium-brown);
            color: var(--cream);
            transform: translateX(4px);
        }

        .sidebar-nav .nav-link.active {
            background: linear-gradient(135deg, var(--medium-brown), var(--light-brown));
            box-shadow: var(--shadow-sm);
            color: #fff;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            background: rgba(255,255,255,.06);
        }

        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--medium-brown);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
            color: var(--cream);
            flex-shrink: 0;
        }

        .user-info .user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--cream);
            line-height: 1.2;
        }

        .user-info .user-role {
            font-size: 11px;
            color: var(--light-brown);
        }

        /* ── Navbar ─────────────────────────────────────────────────────── */
        #navbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--navbar-h);
            background: var(--white);
            border-bottom: 1px solid rgba(75,46,43,.12);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 999;
            box-shadow: var(--shadow-sm);
        }

        .navbar-page-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--dark-brown);
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            border-radius: var(--radius-sm);
            background: transparent;
            border: 1.5px solid rgba(75,46,43,.25);
            color: var(--text-mid);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: var(--dark-brown);
            border-color: var(--dark-brown);
            color: #fff;
        }

        /* ── Main Content ───────────────────────────────────────────────── */
        #main-content {
            margin-left: var(--sidebar-w);
            padding-top: var(--navbar-h);
            min-height: 100vh;
        }

        .content-wrapper {
            padding: 28px 32px;
        }

        /* ── Page Header ────────────────────────────────────────────────── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .page-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--dark-brown);
            margin: 0;
        }

        .page-header p {
            margin: 4px 0 0;
            font-size: 13px;
            color: var(--text-muted);
        }

        /* ── Buttons ────────────────────────────────────────────────────── */
        .btn-brown {
            background: var(--medium-brown);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 13.5px;
            padding: 9px 20px;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }

        .btn-brown:hover {
            background: var(--dark-brown);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-brown-outline {
            background: transparent;
            border: 1.5px solid var(--medium-brown);
            color: var(--medium-brown);
            font-weight: 600;
            font-size: 13px;
            padding: 7px 16px;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }

        .btn-brown-outline:hover {
            background: var(--medium-brown);
            color: #fff;
        }

        .btn-edit {
            background: rgba(111,78,55,.1);
            border: 1px solid rgba(111,78,55,.25);
            color: var(--medium-brown);
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-edit:hover {
            background: var(--medium-brown);
            color: #fff;
            border-color: var(--medium-brown);
        }

        .btn-delete {
            background: rgba(185,28,28,.08);
            border: 1px solid rgba(185,28,28,.2);
            color: #b91c1c;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-delete:hover {
            background: #b91c1c;
            color: #fff;
            border-color: #b91c1c;
        }

        /* ── Cards ──────────────────────────────────────────────────────── */
        .card-custom {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(75,46,43,.08);
            overflow: hidden;
        }

        .card-custom .card-header-custom {
            background: linear-gradient(135deg, var(--dark-brown), var(--medium-brown));
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-custom .card-header-custom h5 {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            color: #fff;
            margin: 0;
        }

        .card-custom .card-header-custom i {
            color: var(--pale-brown);
            font-size: 18px;
        }

        .card-body-custom {
            padding: 28px;
        }

        /* ── Stat Cards ─────────────────────────────────────────────────── */
        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 20px 24px;
            border: 1px solid rgba(75,46,43,.08);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 50px; height: 50px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .stat-icon.brown { background: rgba(111,78,55,.12); color: var(--medium-brown); }
        .stat-icon.green { background: rgba(21,128,61,.1); color: #15803d; }
        .stat-icon.amber { background: rgba(180,83,9,.1); color: #b45309; }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 26px; font-weight: 700;
            color: var(--dark-brown);
            line-height: 1;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* ── Table Styling ──────────────────────────────────────────────── */
        .table-custom {
            width: 100% !important;
            font-size: 13.5px;
        }

        .table-custom thead tr {
            background: linear-gradient(135deg, var(--dark-brown), var(--medium-brown));
        }

        .table-custom thead th {
            color: var(--cream) !important;
            font-weight: 600;
            font-size: 12.5px;
            letter-spacing: .4px;
            text-transform: uppercase;
            padding: 13px 16px;
            border: none !important;
            white-space: nowrap;
        }

        .table-custom tbody tr {
            transition: background .15s;
        }

        .table-custom tbody tr:hover td {
            background: rgba(166,123,91,.08) !important;
        }

        .table-custom tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            border-color: rgba(75,46,43,.06) !important;
            color: var(--text-dark);
        }

        .table-custom tbody tr:nth-child(even) td {
            background: rgba(245,245,220,.5);
        }

        .badge-stock-low   { background: rgba(185,28,28,.1);  color: #b91c1c;  padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-stock-med   { background: rgba(180,83,9,.1);   color: #b45309;  padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-stock-good  { background: rgba(21,128,61,.1);  color: #15803d;  padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }

        /* ── DataTables Override ─────────────────────────────────────────── */
        .dataTables_wrapper .dataTables_filter input {
            border: 1.5px solid rgba(75,46,43,.2);
            border-radius: var(--radius-sm);
            padding: 7px 12px;
            font-size: 13px;
            color: var(--text-dark);
            transition: border-color .2s;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            border-color: var(--medium-brown);
            box-shadow: 0 0 0 3px rgba(111,78,55,.12);
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1.5px solid rgba(75,46,43,.2);
            border-radius: var(--radius-sm);
            padding: 6px 10px;
            font-size: 13px;
            color: var(--text-dark);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--medium-brown) !important;
            border-color: var(--medium-brown) !important;
            color: #fff !important;
            border-radius: var(--radius-sm) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(111,78,55,.12) !important;
            border-color: transparent !important;
            color: var(--medium-brown) !important;
            border-radius: var(--radius-sm) !important;
        }

        .dataTables_wrapper .dataTables_info {
            font-size: 12.5px;
            color: var(--text-muted);
        }

        /* ── Form Styles ────────────────────────────────────────────────── */
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 6px;
        }

        .form-control, .form-select {
            border: 1.5px solid rgba(75,46,43,.2);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            font-size: 14px;
            color: var(--text-dark);
            background: #fff;
            transition: all .2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--medium-brown);
            box-shadow: 0 0 0 3.5px rgba(111,78,55,.12);
            outline: none;
        }

        .form-control.is-invalid { border-color: #dc2626; }
        .invalid-feedback { font-size: 12px; color: #dc2626; }

        .input-group-text {
            background: rgba(245,245,220,.8);
            border: 1.5px solid rgba(75,46,43,.2);
            color: var(--text-muted);
            font-size: 14px;
        }

        /* ── Alert / Toast ──────────────────────────────────────────────── */
        .alert-success-custom {
            background: rgba(21,128,61,.08);
            border: 1px solid rgba(21,128,61,.2);
            border-left: 4px solid #15803d;
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            color: #15803d;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error-custom {
            background: rgba(185,28,28,.06);
            border: 1px solid rgba(185,28,28,.2);
            border-left: 4px solid #b91c1c;
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            color: #b91c1c;
            font-size: 13.5px;
        }

        /* ── Modal ──────────────────────────────────────────────────────── */
        .modal-custom .modal-content {
            border-radius: var(--radius);
            border: none;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .modal-custom .modal-header {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            border: none;
            padding: 18px 24px;
        }

        .modal-custom .modal-title {
            font-family: 'Playfair Display', serif;
            color: #fff;
            font-size: 16px;
        }

        .modal-custom .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-custom .modal-body {
            padding: 28px 24px 20px;
            text-align: center;
        }

        .modal-danger-icon {
            width: 64px; height: 64px;
            background: rgba(185,28,28,.1);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px;
            color: #b91c1c;
            margin: 0 auto 16px;
        }

        .modal-custom .modal-body h5 {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            color: var(--dark-brown);
            margin-bottom: 8px;
        }

        .modal-custom .modal-body p {
            color: var(--text-muted);
            font-size: 13.5px;
            margin: 0;
        }

        .modal-product-name {
            font-weight: 700;
            color: var(--dark-brown);
        }

        .modal-custom .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid rgba(75,46,43,.1);
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn-cancel {
            padding: 9px 22px;
            border-radius: var(--radius-sm);
            border: 1.5px solid rgba(75,46,43,.25);
            background: transparent;
            color: var(--text-mid);
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-cancel:hover {
            background: rgba(75,46,43,.06);
        }

        .btn-danger-custom {
            padding: 9px 22px;
            border-radius: var(--radius-sm);
            border: none;
            background: #b91c1c;
            color: #fff;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn-danger-custom:hover {
            background: #991b1b;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(185,28,28,.3);
        }

        /* ── Breadcrumb ─────────────────────────────────────────────────── */
        .breadcrumb-custom {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            margin-bottom: 20px;
        }

        .breadcrumb-custom a {
            color: var(--text-muted);
            text-decoration: none;
        }

        .breadcrumb-custom a:hover { color: var(--medium-brown); }
        .breadcrumb-custom .sep { color: rgba(75,46,43,.3); }
        .breadcrumb-custom .current { color: var(--medium-brown); font-weight: 600; }

        /* ── No results ─────────────────────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 52px;
            color: rgba(111,78,55,.25);
            margin-bottom: 16px;
            display: block;
        }

        .empty-state h5 {
            font-family: 'Playfair Display', serif;
            color: var(--text-mid);
        }

        .empty-state p { color: var(--text-muted); font-size: 13px; }

        /* ── Scrollbar ──────────────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: var(--cream-dark); }
        ::-webkit-scrollbar-thumb { background: var(--light-brown); border-radius: 10px; }

        /* ── Responsive ─────────────────────────────────────────────────── */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #navbar { left: 0; }
            #main-content { margin-left: 0; }
            .content-wrapper { padding: 20px 16px; }
        }
    </style>

    @stack('styles')
</head>

<body>
    {{-- ── Sidebar ──────────────────────────────────────────────────────── --}}
    <aside id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">🏪</div>
            <p class="brand-name">Toko Pak Cik<br>& Mas Aimar</p>
            <p class="brand-sub">Sistem Inventaris</p>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>

            <a href="{{ route('products.index') }}"
               class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Data Produk</span>
            </a>

            <a href="{{ route('products.create') }}"
               class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah Produk</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">{{ auth()->user()->email }}</div>
                </div>
            </div>
        </div>
    </aside>

    {{-- ── Navbar ────────────────────────────────────────────────────────── --}}
    <header id="navbar">
        <div class="navbar-page-title">@yield('page-title', 'Dashboard')</div>

        <div class="navbar-actions">
            <span style="font-size:13px; color:var(--text-muted);">
                <i class="bi bi-calendar3 me-1"></i>
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </span>

            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>
    </header>

    {{-- ── Main Content ──────────────────────────────────────────────────── --}}
    <main id="main-content">
        <div class="content-wrapper">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert-success-custom mb-4" id="flash-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                    <button onclick="document.getElementById('flash-success').style.display='none'"
                            style="margin-left:auto;background:none;border:none;color:inherit;cursor:pointer;font-size:16px;">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error-custom mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Page Content --}}
            @yield('content')
        </div>
    </main>

    {{-- ── Scripts ───────────────────────────────────────────────────────── --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        // Auto-dismiss flash messages after 4s
        setTimeout(() => {
            const flash = document.getElementById('flash-success');
            if (flash) {
                flash.style.transition = 'opacity .5s';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }
        }, 4000);
    </script>

    @stack('scripts')
</body>
</html>
