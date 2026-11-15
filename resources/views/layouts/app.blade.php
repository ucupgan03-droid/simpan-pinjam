<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Simpan Pinjam') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (INI YANG BIKIN IKON MUNCUL) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* --- STYLE SIDEBAR KIRI --- */
        .wrapper { display: flex; width: 100%; align-items: stretch; }
        
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #ffffff;
            color: #333;
            transition: all 0.3s;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            z-index: 1000;
            min-height: 100vh;
        }
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: #ffffff;
            border-bottom: 1px solid #f0f0f0;
        }

        #sidebar ul.components { padding: 20px 0; }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1rem;
            display: block;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-weight: 500;
        }

        #sidebar ul li a:hover, #sidebar ul li a.active {
            color: #4361ee;
            background: #eef2ff;
            border-left: 4px solid #4361ee;
        }

        #sidebar ul li a i { margin-right: 12px; font-size: 1.1rem; }

        /* --- STYLE KONTEN --- */
        #content { width: 100%; padding: 30px; min-height: 100vh; }

        /* Topbar */
        .topbar {
            background: #fff; padding: 15px 25px; border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02); margin-bottom: 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <!-- SIDEBAR KIRI -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4 class="fw-bold text-primary mb-0"><i class="bi bi-box-seam me-2"></i>Simpan Pinjam</h4>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('anggota.index') }}" class="{{ request()->routeIs('anggota.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Data Anggota
                    </a>
                </li>
                <li>
                    <a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                        <i class="bi bi-cash-coin"></i> Transaksi
                    </a>
                </li>
                
                <li class="mt-4 border-top pt-3">
                    <a href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-gear"></i> Pengaturan Profil
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger text-decoration-none w-100 text-start" style="padding: 12px 20px; font-weight: 500;">
                            <i class="bi bi-box-arrow-right me-2"></i> Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- KONTEN UTAMA -->
        <div id="content">
            <!-- Topbar Atas -->
            <div class="topbar">
                <h5 class="mb-0 text-muted">Halo, <strong class="text-dark">{{ Auth::user()->name }}</strong> 👋</h5>
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary rounded-pill me-2">Admin</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4361ee&color=fff" class="rounded-circle" width="40" alt="Profile">
                </div>
            </div>

            <!-- ISI HALAMAN (YIELD) -->
            @yield('content')
            
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>