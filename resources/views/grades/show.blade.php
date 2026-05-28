<h1>Detail Nilai</h1>

<p><strong>Grade ID:</strong> {{ $grade->grade_id }}</p>
<p><strong>Student ID:</strong> {{ $grade->student_id }}</p>
<p><strong>Tipe:</strong> {{ $grade->type }}</p>
<p><strong>Nilai:</strong> {{ $grade->score }}</p>

<a href="{{ route('grades.index') }}">Kembali</a>