<h1>Tambah SKPI</h1>

<form method="POST" action="{{ route('skpi.store') }}" enctype="multipart/form-data">
    @csrf
    File Sertifikat:
    <br>
    <input name="file_sertifikat" type="file" accept=".pdf,.jpg,.jpeg,.png" required>
    <br><br>
    <button type="submit">Simpan</button>
</form>

<a href="{{ route('skpi.index') }}">
    <button type="button">Kembali</button>
</a>