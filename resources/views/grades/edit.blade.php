<h1>Ubah Nilai</h1>

<form method="POST" action="{{ route('grades.update', $grade->id) }}">

    @csrf
    @method('PUT')

    Student ID:
    <br>
    <input
        type="number"
        name="student_id"
        value="{{ $grade->student_id }}"
        required
    >
    <br><br>

    Matkul ID:
    <br>
    <input
        type="number"
        name="matkul_id"
        value="{{ $grade->matkul_id }}"
        required
    >
    <br><br>

    Tipe Nilai:
    <br>

    <select name="type" required>

        <option value="UTS"
            {{ $grade->type == 'UTS' ? 'selected' : '' }}>
            UTS
        </option>

        <option value="UAS"
            {{ $grade->type == 'UAS' ? 'selected' : '' }}>
            UAS
        </option>

        <option value="TUGAS"
            {{ $grade->type == 'TUGAS' ? 'selected' : '' }}>
            TUGAS
        </option>

    </select>

    <br><br>

    Nilai:
    <br>

    <input
        type="number"
        name="grade"
        value="{{ $grade->grade }}"
        min="0"
        max="100"
        required
    >

    <br><br>

    <button type="submit">
        Simpan
    </button>

</form>