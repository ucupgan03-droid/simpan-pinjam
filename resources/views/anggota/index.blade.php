@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Anggota</h2>
        <div>
            <a href="{{ route('anggota.cetak') }}" class="btn btn-danger" target="_blank">📄 Cetak PDF</a>
            <a href="{{ route('anggota.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th><th>No. Anggota</th><th>Nama</th><th>Alamat</th><th>Telepon</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggotas as $index => $a)
                <tr>
                    <td>{{ $anggotas->firstItem() + $index }}</td>
                    <td>{{ $a->nomor_anggota }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->alamat }}</td>
                    <td>{{ $a->telepon }}</td>
                    <td>
                        <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $anggotas->links() }}
</div>
@endsection