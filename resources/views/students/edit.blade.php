@extends('layouts.app')

@section('title', 'Ubah Data Mahasiswa')

@section('content')

<div class="page-header">
    <h1>Ubah Data Mahasiswa</h1>
    <a href="{{ route('students.show', $student->student_id) }}" class="btn btn-secondary">Kembali</a>
</div>

@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif
@if (session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<p><strong>Nama:</strong> {{ $student->name }}<br>
<strong>NIM:</strong> {{ $student->student_id }}<br>
<strong>Program Studi:</strong> {{ $student->program_studi ?? '-' }}</p>

<form method="POST" action="{{ route('students.update', $student->student_id) }}" style="max-width:500px;">
    @csrf
    @method('PUT')

    <div style="margin-bottom:14px;">
        <label for="address" style="display:block;margin-bottom:4px;font-weight:600;">Alamat</label>
        <input type="text" id="address" name="address" value="{{ old('address', $student->address) }}" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
        @error('address')<div style="color:#d00;font-size:13px;margin-top:4px;">{{ $message }}</div>@enderror
    </div>

    <div style="margin-bottom:18px;">
        <label for="phone_number" style="display:block;margin-bottom:4px;font-weight:600;">No. Telepon</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
        @error('phone_number')<div style="color:#d00;font-size:13px;margin-top:4px;">{{ $message }}</div>@enderror
    </div>

    <div>
        <button type="submit" style="padding:8px 14px;background:#000;color:#fff;border:none;border-radius:4px;cursor:pointer;">Simpan</button>
        <a href="{{ route('students.show', $student->student_id) }}" style="display:inline-block;padding:8px 14px;margin-left:8px;border:1px solid #999;background:#f1f1f1;color:#000;text-decoration:none;border-radius:4px;">Batal</a>
    </div>
</form>

@endsection