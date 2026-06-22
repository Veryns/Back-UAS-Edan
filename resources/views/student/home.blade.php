<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Student - LINTAR UNTAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #f8fafc;
            display: flex;
            overflow-x: hidden;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background-color: #800f13; 
            border-right: 4px solid #ffcc00; 
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 10;
            padding: 30px 0;
        }

        .sidebar-brand {
            padding: 0 25px 30px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand img {
            height: 40px;
            width: auto;
        }

        .brand-text h2 {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 800;
            line-height: 1.1;
        }

        .brand-text p {
            color: #ffcc00;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-top: 2px;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 0 15px;
            flex-grow: 1;
        }

        .sidebar-menu a {
            text-decoration: none;
        }

        .menu-item {
            width: 100%;
            padding: 12px 16px;
            background: none;
            border: none;
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 14px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: left;
        }

        .menu-item i {
            font-size: 1.05rem;
            width: 20px;
            opacity: 0.9;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .sidebar-footer {
            padding: 0 20px;
        }

        .btn-logout {
            width: 100%;
            padding: 12px;
            background-color: rgba(0, 0, 0, 0.2);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
            text-align: center;
        }

        .btn-logout:hover {
            background-color: rgba(0, 0, 0, 0.35);
        }


        .main-container {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-bar {
            height: 75px;
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            padding: 0 40px;
        }

        .user-greeting {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1e293b;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .user-greeting i {
            color: #800f13;
            font-size: 1.2rem;
        }

        .content-body {
            padding: 50px 40px;
            flex-grow: 1;
        }

        .welcome-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border-left: 6px solid #800f13;
        }

        .welcome-card h1 {
            color: #800f13;
            font-size: 2rem;
            font-weight: 800;
        }

        .announcement-section {
            margin-top: 40px;
        }

        .announcement-section h2 {
            font-size: 1.3rem;
            color: #111827;
            margin-bottom: 24px;
            font-weight: 700;
        }

        .announcement-grid {
            display: grid;
            gap: 24px;
        }

        .announcement-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .announcement-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.1);
        }

        .announcement-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .announcement-content {
            padding: 20px;
        }

        .announcement-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: #0f172a;
        }

        .announcement-meta {
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 12px;
        }

        .announcement-text {
            color: #334155;
            line-height: 1.6;
            font-size: 0.92rem;
            margin-bottom: 12px;
        }

        .announcement-link {
            color: #800f13;
            font-weight: 700;
            text-decoration: none;
        }

        .no-announcements {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <img src="/logo.png" alt="Logo">
            <div class="brand-text">
                <h2>LINTAR</h2>
                <p>DASHBOARD</p>
            </div>
        </div>
        
        <ul class="sidebar-menu">
            <a href="{{ route('matkul.index') }}">
                <button class="menu-item">
                    <i class="fa-solid fa-book-bookmark"></i>
                    <span>Mata Kuliah</span>
                </button>
            </a>
            
            <a href="{{ route('student.grades') }}">
                <button class="menu-item">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Grades (Nilai)</span>
                </button>
            </a>
            
            <a href="/uang-kuliah/menu">
                <button class="menu-item">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Uang Kuliah</span>
                </button>
            </a>
            
            <a href="{{ route('skpi.index') }}">
                <button class="menu-item">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>SKPI</span>
                </button>
            </a>
        </ul>

        <!-- Tombol Logout -->
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('student.logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </aside>


    <div class="main-container">
        
        <header class="top-bar">
            <div class="user-greeting">
                <i class="fa-solid fa-circle-user"></i>
                <span>Selamat Datang, {{ Auth::guard('student')->user()->name }}</span>
            </div>
        </header>

        <main class="content-body">
            
            <div class="welcome-card">
                <h1>Halo, {{ Auth::guard('student')->user()->name }}!</h1>
            </div>

            <div class="announcement-section">
                <h2>Pengumuman Terbaru</h2>
                @if($announcements->isEmpty())
                    <div class="no-announcements">
                        <p>Tidak ada pengumuman saat ini.</p>
                    </div>
                @else
                    <div class="announcement-grid">
                        @foreach($announcements as $announcement)
                            <div class="announcement-card" onclick="window.location='{{ route('student.announcements.show', $announcement) }}'">
                                @if($announcement->image_url)
                                    <img src="{{ $announcement->image_url }}" alt="{{ $announcement->title }}">
                                @endif
                                <div class="announcement-content">
                                    <div class="announcement-title">{{ $announcement->title }}</div>
                                    <div class="announcement-meta">{{ $announcement->created_at->format('d M Y') }}</div>
                                    <div class="announcement-text">{{ Str::limit($announcement->content, 150) }}</div>
                                    <span class="announcement-link">Baca selengkapnya →</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </main>
    </div>

</body>
</html>