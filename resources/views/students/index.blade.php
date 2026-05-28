<h1>Daftar Mahasiswa</h1>

@if (session('success'))
    <div style="color:green; margin-bottom:10px;">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div style="color:red; margin-bottom:10px;">{{ session('error') }}</div>
@endif

<a href="{{ route('students.create') }}">Tambah Mahasiswa</a>
<br><br>

@if ($students->isEmpty())
    <p>Belum ada mahasiswa yang tersimpan.</p>
@else
    <table border="1" cellpadding="5" cellspacing="0">
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
                        <a href="{{ route('students.show', $student->student_id) }}">
                            {{ $student->student_id }}
                        </a>
                    </td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->address ?? '-' }}</td>
                    <td>{{ $student->phone_number ?? '-' }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student->student_id) }}">Ubah</a>
                        <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
