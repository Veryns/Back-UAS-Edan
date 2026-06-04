<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengumuman</title>
</head>
<body>

<h1>Daftar Pengumuman</h1>

@if (session('success'))
    <p><strong>{{ session('success') }}</strong></p>
@endif

<a href="{{ route('announcements.create') }}">Buat Pengumuman Baru</a>
<br><br>

@if ($announcements->isEmpty())
    <p>Belum ada pengumuman.</p>
@else
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th style="width:50px">No</th>
                <th style="width:300px">Judul</th>
                <th style="width:150px">Tanggal</th>
                <th style="width:120px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('announcements.show', $announcement) }}">
                            {{ $announcement->title }}
                        </a>
                    </td>
                    <td>{{ $announcement->created_at->format('d M Y') }}</td>
                    <td style="text-align:center">
                        <a href="{{ route('announcements.edit', $announcement) }}">Ubah</a>
                        &nbsp;
                        <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus pengumuman ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<br>
<a href="{{ route('home') }}">Kembali ke Home</a>

</body>
</html>