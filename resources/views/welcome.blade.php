<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LINTAR-SSO - Universitas Tarumanagara</title>
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
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 40px 20px;
            overflow-x: hidden;
            background-color: #1e293b;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('{{ asset('bg-gedung.jpg') }}') no-repeat center center/cover;
            z-index: -2;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.6); 
            z-index: -1;
        }

        .sso-container {
            width: 100%;
            max-width: 900px;
            display: flex;
            flex-direction: column;
            gap: 40px;
            animation: fadeIn 0.5s ease-out;
        }

        .banner-content {
            display: flex;
            align-items: center;
            gap: 30px;
            width: 100%;
            justify-content: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
            padding: 15px;
            border-radius: 12px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .title-container {
            text-align: left;
        }

        .title-container h1 {
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 4px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .title-container h2 {
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            line-height: 1.4;
            color: #ffcc00; 
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            width: 100%;
        }

        .grid-container a {
            text-decoration: none;
        }

        .card-button {
            width: 100%;
            height: 220px;
            padding: 35px 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: center;
            cursor: pointer;
            border-radius: 16px;
            backdrop-filter: blur(12px); 
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-mahasiswa { 
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.65) 0%, rgba(29, 78, 216, 0.45) 100%); 
        }
        
        .btn-admin { 
            background: linear-gradient(135deg, rgba(148, 27, 27, 0.65) 0%, rgba(185, 28, 28, 0.45) 100%); 
        }

        /* Efek saat Kartu Disorot (Hover) */
        .card-button:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.35);
        }

        .btn-mahasiswa:hover {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.8) 0%, rgba(29, 78, 216, 0.6) 100%);
        }

        .btn-admin:hover {
            background: linear-gradient(135deg, rgba(148, 27, 27, 0.8) 0%, rgba(185, 28, 28, 0.6) 100%);
        }

        .card-button:hover::after {
            transform: scale(1.1) translate(-10px, -10px);
            opacity: 0.18;
        }

        .card-button h3 {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 12px;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-button p {
            font-size: 0.8rem;
            line-height: 1.6;
            font-weight: 600;
            letter-spacing: 0.5px;
            opacity: 0.9;
            text-transform: uppercase;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>
<body>

    <div class="sso-container">
        
        <header class="banner-content">
            <div class="logo-container">
                <img src="{{ asset('logo.png') }}" alt="Logo Kampus" style="height: 85px; width: auto;">
            </div>
            
            <div class="title-container">
                <h1>SINGLE SIGN ON</h1>
                <h2>LAYANAN INFORMASI TERPADU (LINTAR)</h2>
                <h2>UNIVERSITAS TARUMANAGARA</h2>
            </div>
        </header>

        <main class="main-content">
            <div class="grid-container">
                
                <a href="{{ route('student.login') }}">
                    <button class="card-button btn-mahasiswa">
                        <h3><i class="fa-solid fa-graduation-cap"></i> Aplikasi Mahasiswa</h3>
                        <p>Klik disini untuk login sebagai mahasiswa aktif universitas</p>
                    </button>
                </a>

                <a href="{{ route('login') }}">
                    <button class="card-button btn-admin">
                        <h3><i class="fa-solid fa-user-shield"></i> Aplikasi Admin</h3>
                        <p>Klik disini untuk login sebagai administrator</p>
                    </button>
                </a>

            </div>
        </main>

    </div>

</body>
</html>