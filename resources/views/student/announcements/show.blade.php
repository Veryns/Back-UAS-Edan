<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $announcement->title }}</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 32px;
        }

        .container {
            max-width: 860px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .hero {
            padding: 32px;
        }

        .hero h1 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #0f172a;
        }

        .hero .meta {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 26px;
        }

        .hero img {
            width: 100%;
            border-radius: 14px;
            object-fit: cover;
            margin-bottom: 26px;
        }

        .content {
            color: #334155;
            line-height: 1.85;
            font-size: 1rem;
            padding-bottom: 32px;
        }

        .back-link {
            display: inline-block;
            margin-top: 24px;
            padding: 12px 20px;
            background: #941b1b;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero">
            <h1>{{ $announcement->title }}</h1>
            <div class="meta">{{ $announcement->created_at->format('d M Y') }}</div>
            @if($announcement->image_url)
                <img src="{{ $announcement->image_url }}" alt="{{ $announcement->title }}">
            @endif
            <div class="content">
                {!! nl2br(e($announcement->content)) !!}
            </div>
            <a href="{{ route('student.announcements.index') }}" class="back-link">Back</a>
        </div>
    </div>
</body>
</html>
