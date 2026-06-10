@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')

<h1>Tambah Mahasiswa</h1>
<p>
    <a href="{{ route('students.index') }}" style="display:inline-block;padding:6px 12px;border:1px solid #999;background:#f1f1f1;color:#000;text-decoration:none;border-radius:4px;">← Kembali</a>
</p>

@if (session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif
@if (session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<form method="POST" action="{{ route('students.store') }}" style="max-width:500px;">
    @csrf

    <div style="margin-bottom:14px;">
        <label for="name" style="display:block;margin-bottom:4px;font-weight:600;">Nama <span style="color:#d00;">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
        @error('name')<div style="color:#d00;font-size:13px;margin-top:4px;">{{ $message }}</div>@enderror
    </div>

    <div style="margin-bottom:14px;">
        <label for="address" style="display:block;margin-bottom:4px;font-weight:600;">Alamat</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
        @error('address')<div style="color:#d00;font-size:13px;margin-top:4px;">{{ $message }}</div>@enderror
    </div>

    <div style="margin-bottom:14px;">
        <label for="phone_number" style="display:block;margin-bottom:4px;font-weight:600;">No. Telepon</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
        @error('phone_number')<div style="color:#d00;font-size:13px;margin-top:4px;">{{ $message }}</div>@enderror
    </div>

    <div style="margin-bottom:14px;">
        <label for="email" style="display:block;margin-bottom:4px;font-weight:600;">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
        @error('email')<div style="color:#d00;font-size:13px;margin-top:4px;">{{ $message }}</div>@enderror
    </div>

    <div style="margin-bottom:18px;">
        <label for="password" style="display:block;margin-bottom:4px;font-weight:600;">Password</label>
        <input type="password" id="password" name="password" required style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
        @error('password')<div style="color:#d00;font-size:13px;margin-top:4px;">{{ $message }}</div>@enderror
    </div>

    <div>
        <button type="submit" style="padding:8px 14px;background:#000;color:#fff;border:none;border-radius:4px;cursor:pointer;">Simpan</button>
        <a href="{{ route('students.index') }}" style="display:inline-block;padding:8px 14px;margin-left:8px;border:1px solid #999;background:#f1f1f1;color:#000;text-decoration:none;border-radius:4px;">Batal</a>
    </div>
</form>

@endsection