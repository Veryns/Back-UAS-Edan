<h1>Edit Mata Kuliah</h1>

<form method="POST" action="{{ route('matkul.update', $matkul->id) }}">
    @csrf
    @method('PUT')
    Nama:
    <br>
    <input name="nama" value="{{ $matkul->nama }}" required>
    <br><br>
    Kode Matkul:
    <br>
    <input name="kodematkul" value="{{ $matkul->kodematkul }}" required>
    <br><br>
    SKS:
    <br>
    <input name="sks" type="number" min="1" value="{{ $matkul->sks }}" required>
    <br><br>
    Deskripsi:
    <br>
    <textarea name="deskripsi" rows="4">{{ $matkul->deskripsi }}</textarea>
    <br><br>
    Dosen:
    <br>
    <input name="dosen" value="{{ $matkul->dosen }}" required>
    <br><br>
    Kode MS Teams:
    <br>
    <input name="kodemsteam" value="{{ $matkul->kodemsteam }}">
    <br><br>
    <button type="submit">Update</button>
</form>

<a href="{{ route('matkul.index') }}">
    <button>Kembali</button>
</a>