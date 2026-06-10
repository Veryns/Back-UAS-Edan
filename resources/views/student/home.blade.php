<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - LINTAR UNTAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: #1e293b;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 275px;
            background: linear-gradient(180deg, #941b1b 0%, #6e1010 100%);
            color: #ffffff;
            display: flex;
            flex-direction: column; 
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            box-shadow: 5px 0 25px rgba(110, 16, 16, 0.25);
            border-right: 3px solid #ffcc00;
        }

        .sidebar-header {
            padding: 30px 20px;
            background-color: rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header img {
            height: 44px;
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .sidebar-header-text h3 {
            font-size: 1.1rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.5px;
        }

        .sidebar-header-text p {
            font-size: 0.7rem;
            color: #ffcc00;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 24px 14px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-menu a {
            text-decoration: none;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .sidebar-menu a:hover .menu-item {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.12);
            transform: translateX(6px);
        }

        .sidebar-menu a:focus .menu-item,
        .sidebar-menu a.active .menu-item {
            color: #000000;
            background-color: #ffcc00;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(255, 204, 0, 0.2);
        }

        .sidebar-menu a:focus .menu-item i,
        .sidebar-menu a.active .menu-item i {
            color: #941b1b;
        }

        .sidebar-footer-container {
            margin-top: auto; 
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .sidebar-camp-card {
            position: relative;
            width: 100%;
            height: 100px;
            border-radius: 8px;
            background: url("image_1339a9.jpg") no-repeat center center/cover;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .sidebar-camp-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(360deg, rgba(110, 16, 16, 0.9) 0%, rgba(0, 0, 0, 0.2) 100%);
        }

        .sidebar-camp-text {
            position: absolute;
            bottom: 8px;
            left: 10px;
            right: 10px;
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        }

        /* Tombol Logout */
        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.08);
            color: #ffb3b3;
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 12px;
            font-size: 0.85rem;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background-color: #ffffff;
            color: #941b1b;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .main-content {
            margin-left: 275px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .top-navbar {
            background-color: #ffffff;
            height: 70px;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            border-bottom: 1px solid #edf2f7;
        }

        .user-greeting {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-greeting i {
            color: #941b1b;
            font-size: 1.3rem;
        }

        .user-greeting h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
        }

        .content-body {
            padding: 40px;
            background-color: #f8fafc;
            flex: 1;
        }

        .welcome-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            border-left: 6px solid #941b1b;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.01);
            border: 1px solid #f1f5f9;
            border-left: 6px solid #941b1b;
        }

        .welcome-card h1 {
            font-size: 2rem;
            color: #941b1b;
            margin-bottom: 12px;
            font-weight: 800;
        }

        .welcome-card p {
            color: #4a5568;
            font-size: 0.95rem;
            line-height: 1.7;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        
        <div class="sidebar-header">
            <img src="{{ asset('logo.png') }}" alt="Logo UNTAR">
            <div class="sidebar-header-text">
                <h3>LINTAR</h3>
                <p>Mahasiswa</p>
            </div>
        </div>

        <!-- Menu Navigasi -->
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

        <div class="sidebar-footer-container">
            <form method="POST" action="{{ route('student.logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>

    </div>

    <div class="main-content">
        
        <div class="top-navbar">
            <div class="user-greeting">
                <i class="fa-solid fa-circle-user"></i>
                <h2>Selamat Datang, {{ Auth::guard('student')->user()->name }}</h2>
            </div>
        </div>

        <div class="content-body">
            <div class="welcome-card">
                <h1>Halo, {{ Auth::guard('student')->user()->name }}!</h1>
                <p></p>
            </div>
        </div>

    </div>

</body>
</html>