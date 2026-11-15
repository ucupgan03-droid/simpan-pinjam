@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit Transaksi</h2>
    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="mt-3">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Anggota</label>
            <select name="anggota_id" class="form-control">
                @foreach($anggotas as $a)
                    <option value="{{ $a->id }}" {{ $transaksi->anggota_id == $a->id ? 'selected' : '' }}>
                        {{ $a->nomor_anggota }} - {{ $a->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jenis</label>
            <select name="jenis" class="form-control">
                <option value="simpanan" {{ $transaksi->jenis == 'simpanan' ? 'selected' : '' }}>Simpanan</option>
                <option value="pinjaman" {{ $transaksi->jenis == 'pinjaman' ? 'selected' : '' }}>Pinjaman</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $transaksi->jumlah }}">
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $transaksi->tanggal }}">
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $transaksi->keterangan }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection