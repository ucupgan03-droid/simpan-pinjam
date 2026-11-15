@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit Anggota</h2>
    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" class="mt-3">
        @csrf 
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Nomor Anggota</label>
            <input type="text" name="nomor_anggota" class="form-control @error('nomor_anggota') is-invalid @enderror" value="{{ old('nomor_anggota', $anggota->nomor_anggota) }}">
            @error('nomor_anggota') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $anggota->nama) }}">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $anggota->alamat) }}</textarea>
            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon', $anggota->telepon) }}">
            @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        
        <button class="btn btn-success">Update</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection