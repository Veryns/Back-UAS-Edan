<h1>Tambah Mahasiswa</h1>
 
<form method="POST" action="{{ route('students.store') }}">
    @csrf
    Nama:
    <br>
    <input name="name" required>
    <br><br>
    Alamat:
    <br>
    <input name="address">
    <br><br>
    No. Telepon:
    <br>
    <input name="phone_number">
    <br><br>
    <button type="submit">Simpan</button>
</form>
 