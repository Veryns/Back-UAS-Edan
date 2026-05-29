<h1>Daftar Nilai</h1>

<a href="{{ route('grades.create') }}">Tambah Nilai</a>
<br><br>

@if ($grades->isEmpty())
    <p>Belum ada nilai yang tersimpan.</p>
@else
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Grade ID</th>
                <th>Student ID</th>
                <th>Tipe</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('grades.show', $grade->grade_id) }}">
                            {{ $grade->grade_id }}
                        </a>
                    </td>
                    <td>{{ $grade->student_id }}</td>
                    <td>{{ $grade->type }}</td>
                    <td>{{ $grade->score }}</td>
                    <td>
                        <form action="{{ route('grades.destroy', $grade->grade_id) }}" method="POST" style="display:inline;">
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