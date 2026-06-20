<h1>Detail Nilai</h1>

<p>
    <strong>ID:</strong>
    {{ $grade->id }}
</p>

<p>
    <strong>Student ID:</strong>
    {{ $grade->student_id }}
</p>

<p>
    <strong>Matkul ID:</strong>
    {{ $grade->matkul_id }}
</p>

<p>
    <strong>Tipe:</strong>
    {{ $grade->type }}
</p>

<p>
    <strong>Nilai:</strong>
    {{ $grade->grade }}
</p>

<br>

<a href="{{ route('grades.edit', $grade->id) }}">
    Edit
</a>

<br><br>

<a href="{{ route('grades.index') }}">
    Kembali
</a>