<h2>Cari Nilai Mahasiswa</h2>

<form id="studentSearch">
    <input type="number" id="studentId" placeholder="Student ID" required>
    <button type="submit">Cari</button>
</form>

<script>
document.getElementById('studentSearch').addEventListener('submit', function(e) {
    e.preventDefault();
    const studentId = document.getElementById('studentId').value;
    window.location.href = '/grades/' + studentId;
});
</script>

<h1>Daftar Nilai</h1>

@if(Auth::guard('student')->guest())
<a href="{{ route('grades.create') }}">Tambah Nilai</a>
<br><br>
@endif

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
                @if(Auth::guard('student')->guest())
                <th>Aksi</th>
                @endif
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
                    @if(Auth::guard('student')->guest())
                    <td>
                        <form action="{{ route('grades.destroy', $grade->grade_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif