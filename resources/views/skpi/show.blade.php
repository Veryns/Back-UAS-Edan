<h1>Detail SKPI</h1>

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