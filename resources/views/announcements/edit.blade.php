<!DOCTYPE html>
<html>
<head>
    <title>Ubah Pengumuman</title>
</head>
<body>

<h1>Ubah Pengumuman</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('announcements.update', $announcement) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    Judul:<br>
    <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required style="width:400px"><br><br>

    Konten:<br>
    <textarea name="content" rows="8" required style="width:400px">{{ old('content', $announcement->content) }}</textarea><br><br>

    @if ($announcement->image_url)
        <div>
            <strong>Gambar Saat Ini:</strong><br>
            <img src="{{ $announcement->image_url }}" alt="{{ $announcement->title }}" style="max-width:320px; height:auto; margin-bottom:1rem;">
        </div>
    @endif

    Gambar (opsional):<br>
    <input type="file" name="image" accept="image/*"><br><br>

    <button type="submit">Simpan</button>
    &nbsp;
    <a href="{{ route('announcements.index') }}">Batal</a>
</form>

</body>
</html>