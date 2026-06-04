<!DOCTYPE html>
<html>
<head>
    <title>{{ $announcement->title }}</title>
</head>
<body>

<h1>{{ $announcement->title }}</h1>
<p><small>{{ $announcement->created_at->format('d M Y') }}</small></p>

<p>{{ $announcement->content }}</p>

<a href="{{ route('announcements.edit', $announcement) }}">Ubah</a>
&nbsp;|&nbsp;
<a href="{{ route('announcements.index') }}">Kembali</a>

</body>
</html>