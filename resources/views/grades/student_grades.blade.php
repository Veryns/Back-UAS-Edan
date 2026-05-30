<h1>Nilai Student {{ $studentId }}</h1>

<a href="{{ route('grades.index') }}">Kembali ke Daftar Nilai</a>

<br><br>

@if ($grades->isEmpty())
    <p>Tidak ada nilai untuk student ini.</p>
@else
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Grade ID</th>
                <th>Student ID</th>
                <th>Tipe</th>
                <th>Nilai</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endif