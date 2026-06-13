<!DOCTYPE html>
<html>
<head>
    <title>{{ $announcement->title }}</title>
</head>
<body>

<h1>{{ $announcement->title }}</h1>
<p><small>{{ $announcement->created_at->format('d M Y') }}</small></p>

@if ($announcement->image_url)
    <div>
        <img src="{{ $announcement->image_url }}" alt="{{ $announcement->title }}" style="max-width:100%; height:auto; margin-bottom:1rem;">
    </div>
@endif

<p>{{ $announcement->content }}</p>

<a href="{{ route('announcements.edit', $announcement) }}">Ubah</a>
&nbsp;|&nbsp;
<a href="{{ route('announcements.index') }}">Kembali</a>

</body>
</html>