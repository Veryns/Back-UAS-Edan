<h1>Ubah Data Mahasiswa</h1>
 
<form method="POST" action="{{ route('students.update', $student->student_id) }}">
    @csrf
    @method('PUT')
    Alamat:
    <br>
    <input name="address" value="{{ $student->address }}">
    <br><br>
    No. Telepon:
    <br>
    <input name="phone_number" value="{{ $student->phone_number }}">
    <br><br>
    <button type="submit">Simpan</button>
</form>