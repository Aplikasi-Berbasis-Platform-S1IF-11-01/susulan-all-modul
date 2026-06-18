<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventaris Toko Cipa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #ffe4e1; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-girly { background-color: #ffb6c1; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .navbar-brand { color: #fff; font-weight: bold; font-size: 1.5rem; text-shadow: 1px 1px 2px #ff69b4; }
        .card-girly { border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(255,105,180,0.2); }
        .btn-pink { background-color: #ff69b4; color: white; border-radius: 20px; transition: 0.3s; border: none; }
        .btn-pink:hover { background-color: #ff1493; color: white; }
        .table-pink th { background-color: #ffb6c1; color: white; }
        .table-hover tbody tr:hover { background-color: #fff0f5; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-girly mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">🎀 Toko Cipa</a>
            @auth
            <div class="d-flex">
                <span class="navbar-text text-white me-3">Halo, cipa! 💖</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-light rounded-pill text-danger">Logout</button>
                </form>
            </div>
            @endauth
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>