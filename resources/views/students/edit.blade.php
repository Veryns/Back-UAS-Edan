@extends('layouts.app')

@section('title', 'Ubah Data Mahasiswa')

@section('content')

<div class="page-header">
    <h1>Ubah Data Mahasiswa</h1>
    <a href="{{ route('students.show', $student->student_id) }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card">

    <div style="margin-bottom:24px; padding-bottom:18px; border-bottom:1px solid #f1f5f9;">
        <div style="font-size:12px; text-transform:uppercase; letter-spacing:0.4px; color:#94a3b8; font-weight:600; margin-bottom:6px;">Mahasiswa</div>
        <div style="font-size:15px; font-weight:700; color:#1a1a2e;">{{ $student->name }}</div>
        <div style="font-size:13px; color:#64748b; margin-top:2px;">NIM: {{ $student->student_id }}</div>
    </div>

    <form method="POST" action="{{ route('students.update', $student->student_id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" id="address" name="address"
                value="{{ old('address', $student->address) }}">
            @error('address')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">No. Telepon</label>
            <input type="text" id="phone_number" name="phone_number"
                value="{{ old('phone_number', $student->phone_number) }}">
            @error('phone_number')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('students.show', $student->student_id) }}" class="btn btn-secondary">Batal</a>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="{{ old('email') }}" required>
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password') <div class="form-error">{{ $message }}</div> @enderror
        </div>

    </form>
</div>

@endsection