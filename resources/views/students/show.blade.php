@extends('layouts.app')

@section('title', 'Biodata Mahasiswa')

@section('content')

<div class="page-header">
    <h1>Biodata Mahasiswa</h1>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<table border="1" cellpadding="10" cellspacing="0" style="border-collapse:collapse;max-width:500px;">
    <tr>
        <td><strong>NIM</strong></td>
        <td>{{ $student->student_id }}</td>
    </tr>
    <tr>
        <td><strong>Nama</strong></td>
        <td>{{ $student->name }}</td>
    </tr>
    <tr>
        <td><strong>Program Studi</strong></td>
        <td>{{ $student->program_studi ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Alamat</strong></td>
        <td>{{ $student->address ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>No. Telepon</strong></td>
        <td>{{ $student->phone_number ?? '-' }}</td>
    </tr>
</table>

<p style="margin-top:18px;">
    <a href="{{ route('students.edit', $student->student_id) }}" style="display:inline-block;padding:8px 14px;background:#000;color:#fff;text-decoration:none;border-radius:4px;">Ubah Data</a>
    <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" style="display:inline-block;margin-left:8px;">
        @csrf
        @method('DELETE')
        <button type="submit" style="padding:8px 14px;background:#f44336;color:#fff;border:none;border-radius:4px;cursor:pointer;" onclick="return confirm('Hapus mahasiswa ini?')">Hapus</button>
    </form>
</p>

@endsection