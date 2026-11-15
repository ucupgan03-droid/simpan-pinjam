@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Transaksi</h2>
        <div>
            <a href="{{ route('transaksi.cetak') }}" class="btn btn-danger" target="_blank">📄 Cetak PDF</a>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th><th>Tanggal</th><th>Anggota</th><th>Jenis</th><th>Jumlah</th><th>Keterangan</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $index => $t)
                <tr>
                    <td>{{ $transaksis->firstItem() + $index }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $t->anggota->nama ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $t->jenis == 'simpanan' ? 'success' : 'warning' }}">
                            {{ ucfirst($t->jenis) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $t->keterangan ?? '-' }}</td>
                    <td>
                        <a href="{{ route('transaksi.edit', $t->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $transaksis->links() }}
</div>
@endsection