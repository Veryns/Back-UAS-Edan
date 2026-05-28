<h1>Detail Mata Kuliah</h1>

<p>Nama: {{ $matkul->nama }}</p>
<p>Kode: {{ $matkul->kodematkul }}</p>
<p>SKS: {{ $matkul->sks }}</p>
<p>Deskripsi: {{ $matkul->deskripsi }}</p>
<p>Dosen: {{ $matkul->dosen }}</p>
<p>Kode MS Teams: {{ $matkul->kodemsteam }}</p>

<a href="{{ route('matkul.edit', $matkul->id) }}">
    <button>Edit</button>
</a>

<a href="{{ route('matkul.index') }}">
    <button>Kembali</button>
</a>