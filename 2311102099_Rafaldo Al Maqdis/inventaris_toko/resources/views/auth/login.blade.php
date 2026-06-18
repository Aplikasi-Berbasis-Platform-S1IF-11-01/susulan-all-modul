<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inventaris Toko Pak Cik & Mas Aimar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --dark-brown:   #4B2E2B;
            --medium-brown: #6F4E37;
            --light-brown:  #A67B5B;
            --pale-brown:   #C4956A;
            --cream:        #F5F5DC;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--cream);
        }

        /* Left panel */
        .login-left {
            width: 45%;
            background: linear-gradient(160deg, var(--dark-brown) 0%, var(--medium-brown) 60%, var(--light-brown) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            width: 380px; height: 380px;
            background: rgba(255,255,255,.04);
            border-radius: 50%;
            top: -100px; left: -100px;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 250px; height: 250px;
            background: rgba(255,255,255,.04);
            border-radius: 50%;
            bottom: -60px; right: -60px;
        }

        .left-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .store-icon {
            font-size: 64px;
            margin-bottom: 24px;
            display: block;
        }

        .left-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: #fff;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .left-content p {
            color: rgba(245,245,220,.7);
            font-size: 14px;
            line-height: 1.7;
            max-width: 280px;
            margin: 0 auto 40px;
        }

        .feature-list {
            list-style: none;
            text-align: left;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(245,245,220,.85);
            font-size: 13.5px;
            margin-bottom: 12px;
        }

        .feature-list li i {
            width: 28px; height: 28px;
            background: rgba(255,255,255,.12);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        /* Right panel */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 32px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
        }

        .login-card .top-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--light-brown);
            margin-bottom: 8px;
        }

        .login-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            font-weight: 700;
            color: var(--dark-brown);
            margin-bottom: 6px;
        }

        .login-card .subtitle {
            color: #8B6B52;
            font-size: 14px;
            margin-bottom: 36px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #5C3D2E;
            margin-bottom: 6px;
            display: block;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--light-brown);
            font-size: 16px;
            pointer-events: none;
        }

        .form-control {
            border: 1.5px solid rgba(75,46,43,.2);
            border-radius: 10px;
            padding: 11px 14px 11px 42px;
            font-size: 14px;
            color: #2C1810;
            width: 100%;
            transition: all .2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--medium-brown);
            box-shadow: 0 0 0 3.5px rgba(111,78,55,.12);
        }

        .form-control.is-invalid {
            border-color: #dc2626;
        }

        .invalid-feedback {
            font-size: 12px; color: #dc2626;
            margin-top: 4px; display: block;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 16px 0 24px;
        }

        .remember-row input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--medium-brown);
            cursor: pointer;
        }

        .remember-row label {
            font-size: 13px;
            color: #5C3D2E;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--medium-brown), var(--dark-brown));
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all .25s;
            letter-spacing: .3px;
        }

        .btn-login:hover {
            opacity: .9;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(75,46,43,.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .hint-box {
            margin-top: 24px;
            padding: 14px 16px;
            background: rgba(166,123,91,.08);
            border: 1px solid rgba(166,123,91,.2);
            border-radius: 10px;
        }

        .hint-box p {
            font-size: 12.5px;
            color: #8B6B52;
            margin: 0;
            line-height: 1.7;
        }

        .hint-box strong { color: var(--dark-brown); }

        .alert-error-login {
            background: rgba(185,28,28,.06);
            border: 1px solid rgba(185,28,28,.25);
            border-left: 4px solid #dc2626;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #b91c1c;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .login-left { display: none; }
        }
    </style>
</head>
<body>

    {{-- Left Decorative Panel --}}
    <div class="login-left">
        <div class="left-content">
            <span class="store-icon">🏪</span>
            <h1>Selamat Datang di<br>Toko Kami</h1>
            <p>Kelola inventaris toko Anda dengan mudah, cepat, dan profesional.</p>

            <ul class="feature-list">
                <li>
                    <i class="bi bi-box-seam"></i>
                    Manajemen stok produk lengkap
                </li>
                <li>
                    <i class="bi bi-pencil-square"></i>
                    CRUD data produk real-time
                </li>
                <li>
                    <i class="bi bi-search"></i>
                    Pencarian & filter cepat
                </li>
                <li>
                    <i class="bi bi-shield-lock"></i>
                    Akses aman berbasis login
                </li>
            </ul>
        </div>
    </div>

    {{-- Right Login Form --}}
    <div class="login-right">
        <div class="login-card">
            <p class="top-label">Sistem Inventaris</p>
            <h2>Masuk ke Akun</h2>
            <p class="subtitle">Pak Cik & Mas Aimar — Manajemen Toko</p>

            {{-- Error Alert --}}
            @if($errors->any())
                <div class="alert-error-login">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div style="background:rgba(21,128,61,.08);border:1px solid rgba(21,128,61,.2);border-left:4px solid #15803d;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:13px;color:#15803d;display:flex;align-items:center;gap:8px;">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="form-label" for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" id="email"
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               value="{{ old('email') }}"
                               placeholder="email@toko.com"
                               autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-2">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="password" id="password"
                               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               placeholder="Masukkan password"
                               autocomplete="current-password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember me --}}
                <div class="remember-row">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit" class="btn-login">
                    Masuk Sekarang
                </button>
            </form>

            <div class="hint-box mt-4">
                <p>
                    <strong>Akun Demo:</strong><br>
                    📧 admin@toko.com &nbsp;|&nbsp; 🔑 password123<br>
                    📧 aimar@toko.com &nbsp;|&nbsp; 🔑 password123
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
