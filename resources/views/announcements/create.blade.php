<!DOCTYPE html>
<html>
<head>
    <title>Buat Pengumuman</title>
</head>
<body>

<h1>Buat Pengumuman Baru</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('announcements.store') }}" enctype="multipart/form-data">
    @csrf

    Judul:<br>
    <input type="text" name="title" value="{{ old('title') }}" required style="width:400px"><br><br>

    Konten:<br>
    <textarea name="content" rows="8" required style="width:400px">{{ old('content') }}</textarea><br><br>

    Gambar (opsional):<br>
    <input type="file" name="image" accept="image/*"><br><br>

    <button type="submit">Simpan</button>
    &nbsp;
    <a href="{{ route('announcements.index') }}">Batal</a>
</form>

</body>
</html>