<h1>Daftar SKPI</h1>

<a href="{{ route('skpi.create') }}">
    <button>Tambah SKPI</button>
</a>

<table border="1">
    <tr>
        <th>No</th>
        <th>File Sertifikat</th>
        <th>Aksi</th>
    </tr>
    @foreach($skpis as $index => $item)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>
            @if($item->file_sertifikat)
                <a href="{{ asset('storage/' . $item->file_sertifikat) }}" target="_blank">
                    Lihat File
                </a>
            @else
                Tidak ada file
            @endif
        </td>
        <td>
            <a href="{{ route('skpi.show', $item->id) }}">
                <button>Detail</button>
            </a>

            <form method="POST" action="{{ route('skpi.destroy', $item->id) }}" style="display:inline"
                onsubmit="return confirm('Yakin ingin menghapus sertifikat ini?')">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<a href="{{ route('student.home') }}">
    <button>Kembali</button>
</a>