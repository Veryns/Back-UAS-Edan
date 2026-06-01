<h1>Tambah SKPI</h1>

<form method="POST" action="{{ route('skpi.store') }}" enctype="multipart/form-data">
    @csrf
    Nama Sertifikat:
    <br>
    <input name="nama_sertifikat" required>
    <br><br>
    Organisasi:
    <br>
    <input name="organisasi" required>
    <br><br>
    Tahun:
    <br>
    <input name="tahun" type="number" required>
    <br><br>
    Deskripsi:
    <br>
    <input name="deskripsi">
    <br><br>
    File Sertifikat:
    <br>
    <input name="file_sertifikat" type="file" accept=".pdf,.jpg,.jpeg,.png">
    <br><br>
    <button type="submit">Simpan</button>
</form>

<a href="{{ route('skpi.index') }}">
    <button>Kembali</button>
</a>