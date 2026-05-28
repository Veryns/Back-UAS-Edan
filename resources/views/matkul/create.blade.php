<h1>Tambah Mata Kuliah</h1>

<form method="POST" action="{{ route('matkul.store') }}">
    @csrf
    Nama:
    <br>
    <input name="nama" required>
    <br><br>
    Kode Matkul:
    <br>
    <input name="kodematkul" required>
    <br><br>
    SKS:
    <br>
    <input name="sks" type="number" min="1" required>
    <br><br>
    Deskripsi:
    <br>
    <textarea name="deskripsi" rows="4"></textarea>
    <br><br>
    Dosen:
    <br>
    <input name="dosen" required>
    <br><br>
    Kode MS Teams:
    <br>
    <input name="kodemsteam">
    <br><br>
    <button type="submit">Simpan</button>
</form>

<a href="{{ route('matkul.index') }}">
    <button>Kembali</button>
</a>