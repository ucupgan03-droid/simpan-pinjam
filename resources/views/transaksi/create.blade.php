@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Tambah Transaksi</h2>
    <form action="{{ route('transaksi.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label>Anggota</label>
            <select name="anggota_id" class="form-control @error('anggota_id') is-invalid @enderror">
                <option value="">-- Pilih Anggota --</option>
                @foreach($anggotas as $a)
                    <option value="{{ $a->id }}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                        {{ $a->nomor_anggota }} - {{ $a->nama }}
                    </option>
                @endforeach
            </select>
            @error('anggota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Jenis</label>
            <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                <option value="simpanan" {{ old('jenis') == 'simpanan' ? 'selected' : '' }}>Simpanan</option>
                <option value="pinjaman" {{ old('jenis') == 'pinjaman' ? 'selected' : '' }}>Pinjaman</option>
            </select>
            @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Jumlah (Rp)</label>
            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}">
            @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', date('Y-m-d')) }}">
            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection