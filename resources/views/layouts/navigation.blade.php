<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Simpan Pinjam</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu Kiri -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">Transaksi</a>
                </li>
            </ul>

            <!-- Menu Kanan (User & Logout) -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name ?? 'User' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <!-- Form Logout yang sudah diperbaiki -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger fw-bold">
                                    Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>