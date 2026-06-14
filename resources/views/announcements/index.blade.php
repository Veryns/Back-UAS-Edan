<!DOCTYPE html>
<html>
<head>
    <title>Announcement</title>
</head>
<body>

<h1>Announcements</h1>

@if (session('success'))
    <p><strong>{{ session('success') }}</strong></p>
@endif

<div style="display: flex; flex-wrap: wrap; align-items: center; gap: 1rem; margin-bottom: 1rem;">
    <a href="{{ route('announcements.create') }}" style="display:inline-block; padding:0.75rem 1.25rem; background:#2563eb; color:white; text-decoration:none; border-radius:0; font-weight:600;">Create Announcement</a>
    <a href="{{ route('home') }}" style="display:inline-block; padding:0.75rem 1.25rem; background:#6b7280; color:white; text-decoration:none; border-radius:0;">Back to Home</a>
</div>

@if ($announcements->isEmpty())
    <p>No Announcements.</p>
@else
    <ol style="list-style-position: inside; padding: 0;">
        @foreach ($announcements as $announcement)
            <li onclick="window.location='{{ route('announcements.show', $announcement) }}'" style="margin-bottom: 1.5rem; border: 1px solid #ccc; padding: 1rem; border-radius: 8px; display: flex; gap: 1rem; align-items: center; cursor: pointer;">
                <div style="flex-shrink: 0; width: 100px; height: 100px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f4f4f4; border-radius: 8px;">
                    @if ($announcement->image_url)
                        <img src="{{ $announcement->image_url }}" alt="{{ $announcement->title }}" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    @else
                        <span style="color: #777; font-size: 0.9rem; text-align: center;">No Image</span>
                    @endif
                </div>
                <div style="flex: 1;">
                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center; justify-content: space-between;">
                        <span style="color: #1f2937; font-weight: 700;">{{ $announcement->title }}</span>
                        <span style="color: #555; font-size: 0.95rem;">{{ $announcement->created_at->format('d M Y') }}</span>
                    </div>
                    <p style="margin: 0.75rem 0 0; color: #444; max-width: 720px;">{{ Str::limit($announcement->content, 120) }}</p>
                </div>
                <div style="display: flex; gap: 0.5rem; align-items: center;">
                    <a href="{{ route('announcements.edit', $announcement) }}" onclick="event.stopPropagation()" style="padding: 0.5rem 0.75rem; background: #e5e7eb; color: #111827; text-decoration: none; border-radius: 0;">Edit</a>
                    <form action="{{ route('announcements.destroy', $announcement) }}" method="POST" style="margin: 0;" onclick="event.stopPropagation()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="event.stopPropagation(); return confirm('Hapus pengumuman ini?')" style="padding: 0.5rem 0.75rem; background: #ef4444; color: white; border: none; cursor: pointer; border-radius: 0;">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ol>
@endif

</body>
</html>