@extends('layouts.app')

@section('title', 'Biodata Mahasiswa')

@section('content')

<div class="page-header">
    <h1>Biodata Mahasiswa</h1>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card">

    <table class="detail-table">
        <tr>
            <td>NIM</td>
            <td>{{ $student->student_id }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>{{ $student->address ?? '-' }}</td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td>{{ $student->phone_number ?? '-' }}</td>
        </tr>
    </table>

    <div class="form-actions" style="margin-top:28px; padding-top:20px; border-top:1px solid #f1f5f9;">
        <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-primary">Ubah Data</a>
        <form action="{{ route('students.destroy', $student->student_id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Hapus mahasiswa ini?')">Hapus</button>
        </form>
    </div>

</div>

@endsection