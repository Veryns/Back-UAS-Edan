@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')

<div class="page-header">
    <h1>Daftar Mahasiswa</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif

<div class="card">
    @if ($students->isEmpty())
        <div class="empty">Belum ada mahasiswa yang tersimpan.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('students.show', $student->student_id) }}" class="link">
                                {{ $student->student_id }}
                            </a>
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->address ?? '-' }}</td>
                        <td>{{ $student->phone_number ?? '-' }}</td>
                        <td style="display:flex; gap:8px; align-items:center;">
                            <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-secondary btn-sm">Ubah</a>
                            <form action="{{ route('students.destroy', $student->student_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus mahasiswa ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection