<h1>Tambah Nilai</h1>

<form method="POST" action="{{ route('grades.store') }}">
    @csrf

    Student ID:
    <br>
    <input type="number" name="student_id" required>
    <br><br>

    Matkul ID:
    <br>
    <input type="number" name="matkul_id" required>
    <br><br>

    Tipe Nilai:
    <br>
    <select name="type" required>
        <option value="UTS">UTS</option>
        <option value="UAS">UAS</option>
        <option value="TUGAS">TUGAS</option>
    </select>
    <br><br>

    Nilai:
    <br>
    <input type="number" name="grade" min="0" max="100" required>
    <br><br>

    <button type="submit">
        Simpan
    </button>
</form>