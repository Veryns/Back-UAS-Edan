@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')

<h1>Daftar Mahasiswa</h1>
<p>
    <a href="{{ route('home') }}" style="display: inline-block; padding: 8px 15px; background: #ccc; color: black; text-decoration: none; border: 1px solid #999; border-radius: 4px;">Kembali</a>
    <a href="{{ route('students.create') }}" style="display: inline-block; padding: 8px 15px; background: #4CAF50; color: white; text-decoration: none; border: 1px solid #45a049; border-radius: 4px;">Tambah Mahasiswa</a>
</p>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

@if ($students->isEmpty())
    <p>Belum ada mahasiswa yang tersimpan.</p>
@else
    <table border="1" cellpadding="10" cellspacing="0">
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
                    <td><a href="{{ route('students.show', $student->student_id) }}">{{ $student->student_id }}</a></td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->address ?? '-' }}</td>
                    <td>{{ $student->phone_number ?? '-' }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student->student_id) }}" style="display: inline-block; padding: 6px 12px; background: #2196F3; color: white; text-decoration: none; border: 1px solid #0b7dda; border-radius: 4px;">Ubah</a>
                        <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding: 6px 12px; background: #f44336; color: white; border: 1px solid #da190b; border-radius: 4px; cursor: pointer;" onclick="return confirm('Hapus mahasiswa ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection