@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Tambah Anggota</h2>
    <form action="{{ route('anggota.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label>Nomor Anggota</label>
            <input type="text" name="nomor_anggota" class="form-control @error('nomor_anggota') is-invalid @enderror" value="{{ old('nomor_anggota') }}">
            @error('nomor_anggota') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}">
            @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection