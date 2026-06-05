@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')

<div class="page-header">
    <h1>Tambah Mahasiswa</h1>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nama <span style="color:#dc2626">*</span></label>
            <input type="text" id="name" name="name"
                value="{{ old('name') }}" required>
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" id="address" name="address"
                value="{{ old('address') }}">
            @error('address')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">No. Telepon</label>
            <input type="text" id="phone_number" name="phone_number"
                value="{{ old('phone_number') }}">
            @error('phone_number')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" 
                value="{{ old('email') }}" required>
            @error('email') 
                <div class="form-error">{{ $message }}</div> 
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password') 
                <div class="form-error">{{ $message }}</div> 
            @enderror
        </div>

    </form>
</div>

@endsection