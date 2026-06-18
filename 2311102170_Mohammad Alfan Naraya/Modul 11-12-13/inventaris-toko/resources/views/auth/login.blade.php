<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jeng Jeng Guitar Co.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #111111 0%, #2c2520 100%);
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff !important;
            border-radius: 8px;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: #d4af37;
            box-shadow: 0 0 8px rgba(212, 175, 55, 0.4);
        }
        .btn-amber {
            background: linear-gradient(45deg, #b8860b, #d4af37);
            border: none;
            color: #111;
            font-weight: 700;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-amber:hover {
            background: linear-gradient(45deg, #d4af37, #f4c430);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }
        .brand-icon {
            font-size: 3.5rem;
            color: #d4af37;
            text-shadow: 0 0 15px rgba(212, 175, 55, 0.5);
        }
    </style>
</head>
<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card login-card shadow-lg p-4 text-white">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fa-solid fa-guitar brand-icon"></i>
                        </div>
                        <h3 class="fw-bold tracking-wide mb-1" style="color: #d4af37;">Jeng Jeng Store</h3>
                        <p class="text-muted small mb-4">GUITAR CO. INVENTORY</p>
                        
                        @if($errors->any())
                            <div class="alert alert-danger py-2 bg-danger text-white border-0 small">{{ $errors->first() }}</div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST" class="text-start">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-light small fw-semibold">Guitarist Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent text-muted border-secondary"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="admin@toko.com" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-light small fw-semibold">Secret Pick (Password)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent text-muted border-secondary"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-amber w-100 py-2.5 shadow">TUNE IN (LOGIN)</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>