<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LINTAR-SSO</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #333333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hero-banner {
            position: relative;
            height: 380px;
            color: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 10%;
        }

        .banner-content {
            display: flex;
            align-items: center;
            gap: 30px;
            width: 100%;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .title-container h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .title-container h2 {
            font-size: 1.5rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            line-height: 1.3;
            opacity: 0.9;
        }

        .main-content {
            flex: 1;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-top: -80px; 
            position: relative;
            z-index: 5;
        }

        .grid-container a {
            text-decoration: none;
        }

        .card-button {
            width: 100%;
            height: 220px;
            padding: 30px 25px;
            border: none;
            color: #ffffff;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            transition: transform 0.2s ease, filter 0.2s ease;
        }

        .card-button:hover {
            transform: translateY(-5px);
            filter: brightness(1.1);
        }

        .card-button h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 10px;
            width: 100%;
        }

        .card-button p {
            font-size: 0.85rem;
            line-height: 1.6;
            font-weight: 500;
            text-transform: uppercase;
            opacity: 0.9;
        }

        .btn-mahasiswa { background-color: #2b82c9; }
        .btn-admin { background-color: #d91e18; }

        .forgot-password {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .forgot-password a {
            color: #666666;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            text-decoration: underline;
            color: #2b82c9;
        }

        .footer-line {
            height: 1px;
            background-color: #e2e8f0;
            margin-bottom: 20px;
        }

        .footer-bottom {
            font-size: 0.8rem;
            color: #888888;
            padding-bottom: 30px;
        }

        @media (max-width: 768px) {
            .grid-container { grid-template-columns: 1fr; margin-top: -40px; }
            .hero-banner { height: 300px; padding: 0 5%; }
            .banner-content { flex-direction: column; text-align: center; gap: 15px; }
            .title-container h1 { font-size: 1.6rem; }
            .title-container h2 { font-size: 1.1rem; }
            .card-button { height: 180px; }
        }
    </style>
</head>
<body>

    <header class="hero-banner" style="background: linear-gradient(to right, rgba(168, 31, 31, 0.92), rgba(186, 39, 39, 0.85)), url('{{ asset('bg-gedung.jpg') }}') no-repeat center center/cover;">
        <div class="banner-content">
            
            <div class="logo-container">
                <img src="{{ asset('logo.png') }}" alt="Logo Kampus" style="height: 80px; width: auto;">
            </div>
            
            <div class="title-container">
                <h1>SINGLE SIGN ON</h1>
                <h2>LAYANAN INFORMASI TERPADU</h2>
                <h2>UNIVERSITAS TARUMANAGARA</h2>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="grid-container">
            
            <a href="{{ route('student.login') }}">
                <button class="card-button btn-mahasiswa">
                    <h3>Aplikasi Mahasiswa</h3>
                    <p>KLIK DISINI UNTUK LOGIN SEBAGAI MAHASISWA AKTIF UNIVERSITAS</p>
                </button>
            </a>

            <a href="{{ route('login') }}">
                <button class="card-button btn-admin">
                    <h3>Aplikasi Admin</h3>
                    <p>KLIK DISINI UNTUK LOGIN SEBAGAI ADMINISTRATOR</p>
                </button>
            </a>

        </div>
    </main>

</body>
</html>