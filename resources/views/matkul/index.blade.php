<h1>Daftar Mata Kuliah</h1>

<a href="{{ route('matkul.create') }}">
    <button>Tambah Matkul</button>
</a>

<table border="1">
    <tr>
        <th>Nama</th>
        <th>Kode MatKul</th>
        <th>SKS</th>
        <th>Dosen</th>
        <th>Opsi</th>
    </tr>
    @foreach($matkul as $matkul)
    <tr>
        <td>{{ $matkul->nama }}</td>
        <td>{{ $matkul->kodematkul }}</td>
        <td>{{ $matkul->sks }}</td>
        <td>{{ $matkul->dosen }}</td>
        <td>
            <a href="{{ route('matkul.show', $matkul->id) }}">
                <button>Detail</button>
            </a>
            <a href="{{ route('matkul.edit', $matkul->id) }}">
                <button>Edit</button>
            </a>
            <form method="POST" action="{{ route('matkul.destroy', $matkul->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<a href="{{ route('home') }}">
    <button>Kembali</button>
</a>