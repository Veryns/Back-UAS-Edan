<h1>Daftar SKPI</h1>

<a href="{{ route('skpi.create') }}">
    <button>Tambah SKPI</button>
</a>

<table border="1">
    <tr>
        <th>Nama Sertifikat</th>
        <th>Organisasi</th>
        <th>Tahun</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>
    @foreach($skpis as $item)
    <tr>
        <td>{{ $item->nama_sertifikat }}</td>
        <td>{{ $item->organisasi }}</td>
        <td>{{ $item->tahun }}</td>
        <td>{{ $item->deskripsi }}</td>
        <td>
            <a href="{{ route('skpi.show', $item->id) }}">
                <button>Detail</button>
            </a>
            <form method="POST" action="{{ route('skpi.destroy', $item->id) }}">
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