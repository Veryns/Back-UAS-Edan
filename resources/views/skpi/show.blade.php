<h1>Detail SKPI</h1>

<p>Nama Sertifikat: {{ $skpi->nama_sertifikat }}</p>
<p>Organisasi: {{ $skpi->organisasi }}</p>
<p>Tahun: {{ $skpi->tahun }}</p>
<p>Deskripsi: {{ $skpi->deskripsi }}</p>
<p>
    File:
    @if($skpi->file_sertifikat)
        <a href="{{ asset('storage/' . $skpi->file_sertifikat) }}" target="_blank">
            <button>Lihat File</button>
        </a>
    @else
        Tidak ada file
    @endif
</p>

<a href="{{ route('skpi.index') }}">
    <button>Kembali</button>
</a>