<h1>Ubah Nilai</h1>

<form method="POST" action="{{ route('grades.update', $grade->grade_id) }}">
    @csrf
    @method('PUT')

    Tipe Nilai:
    <br>
    <select name="type" required>
        <option value="UTS" {{ $grade->type == 'UTS' ? 'selected' : '' }}>UTS</option>
        <option value="UAS" {{ $grade->type == 'UAS' ? 'selected' : '' }}>UAS</option>
        <option value="TUGAS" {{ $grade->type == 'TUGAS' ? 'selected' : '' }}>TUGAS</option>
    </select>
    <br><br>

    Score:
    <br>
    <input type="number" name="score" value="{{ $grade->score }}" min="0" max="100" required>
    <br><br>

    <button type="submit">Simpan</button>
</form>