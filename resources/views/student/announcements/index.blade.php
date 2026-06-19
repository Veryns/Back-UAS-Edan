<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Mahasiswa</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 32px;
        }

        .container {
            max-width: 1024px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .announcement-list {
            display: grid;
            gap: 20px;
        }

        .announcement-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
            display: flex;
            flex-direction: column;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .announcement-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 34px rgba(15, 23, 42, 0.1);
        }

        .announcement-card img {
            width: 100%;
            max-height: 240px;
            object-fit: cover;
            display: block;
        }

        .announcement-body {
            padding: 24px;
        }

        .announcement-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .announcement-meta {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 14px;
        }

        .announcement-text {
            color: #334155;
            line-height: 1.75;
            margin-bottom: 16px;
        }

        .back-link {
            display: inline-block;
            padding: 10px 18px;
            background: #941b1b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pengumuman Mahasiswa</h1>
            <p>Hanya bisa dilihat oleh mahasiswa, tanpa akses untuk membuat, mengubah, atau menghapus.</p>
        </div>

        @if($announcements->isEmpty())
            <p>No Announcements.</p>
        @else
            <div class="announcement-list">
                @foreach($announcements as $announcement)
                    <div class="announcement-card" onclick="window.location='{{ route('student.announcements.show', $announcement) }}'">
                        @if($announcement->image_url)
                            <img src="{{ $announcement->image_url }}" alt="{{ $announcement->title }}">
                        @endif
                        <div class="announcement-body">
                            <div class="announcement-title">{{ $announcement->title }}</div>
                            <div class="announcement-meta">{{ $announcement->created_at->format('d M Y') }}</div>
                            <div class="announcement-text">{{ Str::limit($announcement->content, 160) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div style="margin-top: 32px;">
            <a href="{{ route('student.home') }}" class="back-link">Back</a>
        </div>
    </div>
</body>
</html>
