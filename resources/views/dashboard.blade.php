@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold text-dark mb-1">Dashboard Overview</h3>
            <p class="text-muted mb-0">Ringkasan data simpan pinjam saat ini.</p>
        </div>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="bi bi-plus-lg"></i> Transaksi Baru
        </a>
    </div>
</div>

<!-- BARIS 1: KARTU STATISTIK -->
<div class="row g-4 mb-4">
    <!-- Total Anggota -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-3" style="border-radius: 15px;">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1 fw-semibold">Total Anggota</p>
                    <h2 class="fw-bold mb-0 text-dark">{{ \App\Models\Anggota::count() }}</h2>
                </div>
                <div class="bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 12px; font-size: 1.8rem;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Simpanan -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-3" style="border-radius: 15px;">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1 fw-semibold">Total Simpanan</p>
                    <h4 class="fw-bold mb-0 text-success">Rp {{ number_format(\App\Models\Transaksi::where('jenis', 'simpanan')->sum('jumlah'), 0, ',', '.') }}</h4>
                </div>
                <div class="bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 12px; font-size: 1.8rem;">
                    <i class="bi bi-wallet2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pinjaman -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 p-3" style="border-radius: 15px;">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted mb-1 fw-semibold">Total Pinjaman</p>
                    <h4 class="fw-bold mb-0 text-warning">Rp {{ number_format(\App\Models\Transaksi::where('jenis', 'pinjaman')->sum('jumlah'), 0, ',', '.') }}</h4>
                </div>
                <div class="bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 12px; font-size: 1.8rem;">
                    <i class="bi bi-credit-card-2-front-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BARIS 2: TABEL AKTIVITAS & MENU CEPAT -->
<div class="row g-4">
    <!-- Tabel Transaksi Terbaru -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 pt-4 pb-0 d-flex justify-content-between align-items-center" style="border-radius: 15px 15px 0 0;">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history text-primary me-2"></i>Transaksi Terbaru</h6>
                <a href="{{ route('transaksi.index') }}" class="text-decoration-none small fw-bold">Lihat Semua <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="card-body p-0 mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-decoration-none">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Tanggal</th>
                                <th>Anggota</th>
                                <th>Jenis</th>
                                <th class="text-end pe-4">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Transaksi::with('anggota')->latest()->take(5)->get() as $t)
                            <tr>
                                <td class="ps-4">{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                                <td class="fw-semibold">{{ $t->anggota->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge rounded-pill {{ $t->jenis == 'simpanan' ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning' }}">
                                        {{ ucfirst($t->jenis) }}
                                    </span>
                                </td>
                                <!-- text-decoration-none ditambahkan agar tidak ada garis bawah -->
                                <td class="text-end pe-4 fw-bold text-decoration-none">Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada transaksi terbaru.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Cepat -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 pt-4 pb-0" style="border-radius: 15px 15px 0 0;">
                <h6 class="fw-bold mb-0"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Menu Cepat</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('transaksi.create') }}" class="btn btn-primary w-100 mb-3 py-2 rounded-3 shadow-sm">
                    <i class="bi bi-plus-circle me-2"></i> Buat Transaksi
                </a>
                <a href="{{ route('anggota.create') }}" class="btn btn-outline-primary w-100 py-2 rounded-3 mb-3">
                    <i class="bi bi-person-plus me-2"></i> Tambah Anggota
                </a>
                <hr>
                <div class="text-center mt-3">
                    <p class="text-muted small mb-2">Butuh laporan?</p>
                    <a href="{{ route('transaksi.cetak') }}" class="btn btn-outline-danger btn-sm w-100 rounded-3" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i> Cetak Laporan PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection