<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - LINTAR UNTAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- Reset & Base Styles --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
        }

        /* --- SPLIT LAYOUT CONTAINER --- */
        .login-page-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* --- SISI KIRI: HERO IMAGE & ORNAMEN UNTAR (Inspirasi image_6824df & image_1339a9) --- */
        .hero-side {
            flex: 1.2;
            position: relative;
            /* Memanggil foto gedung UNTAR yang kamu upload */
            background: url("{{ asset('bg-gedung.jpg') }}") no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            overflow: hidden;
        }

        /* Lapisan merah-biru gradasi elegan khas Untar di atas gambar */
        .hero-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(168, 31, 31, 0.75) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 5;
            color: #ffffff;
            width: 100%;
            max-width: 600px;
        }

        /* Ornamen Teks Transparan Raksasa di Latar Belakang (Gaya UNIVET) */
        .bg-ornamen-text {
            position: absolute;
            font-size: 8rem;
            font-weight: 800;
            color: rgba(255, 255, 255, 0.06);
            letter-spacing: 4px;
            line-height: 1;
            text-transform: uppercase;
            user-select: none;
            pointer-events: none;
            bottom: 10%;
            left: -5%;
            white-space: nowrap;
            z-index: 2;
        }

        .hero-tag {
            font-size: 0.9rem;
            font-weight: 700;
            color: #ffcc00; /* Kuning Emas Untar */
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hero-content h2 {
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 15px;
            text-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .hero-content p {
            font-size: 1rem;
            color: #e2e8f0;
            line-height: 1.6;
            opacity: 0.9;
        }

        /* --- SISI KANAN: FORM LOGIN (Bersih & Fokus) --- */
        .form-side {
            flex: 1;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.05);
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        /* Logo Kampus Kecil di Atas Form */
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 35px;
        }

        .brand-logo img {
            height: 45px;
            width: auto;
        }

        .brand-text h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #a81f1f;
        }

        .brand-text p {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }

        .form-header {
            margin-bottom: 25px;
        }

        .form-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1e293b;
        }

        .form-header p {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 5px;
        }

        /* --- INPUT STYLING --- */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 15px 12px 42px;
            border: 1.5px solid #cbd5e1;
            border-radius: 6px;
            font-size: 0.9rem;
            color: #333333;
            outline: none;
            transition: all 0.2s ease;
        }

        .input-wrapper input:focus {
            border-color: #2b82c9; /* Fokus Biru LINTAR */
            box-shadow: 0 0 0 3px rgba(43, 130, 201, 0.15);
        }

        /* --- WARNING ERROR --- */
        .error-message {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #b91c1c;
            padding: 12px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* --- BUTTON STYLING --- */
        .btn-submit {
            width: 100%;
            background-color: #2b82c9; /* Biru Mahasiswa LINTAR */
            color: #ffffff;
            border: none;
            padding: 13px;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 15px;
            box-shadow: 0 4px 12px rgba(43, 130, 201, 0.2);
        }

        .btn-submit:hover {
            background-color: #1d6fa8;
        }

        .btn-back {
            width: 100%;
            background-color: #f8fafc;
            color: #64748b;
            border: 1px solid #cbd5e1;
            padding: 11px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background-color: #f1f5f9;
            color: #1e293b;
        }

        /* --- FOOTER KECIL --- */
        .form-footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.75rem;
            color: #94a3b8;
        }

        /* --- RESPONSIF DI HP --- */
        @media (max-width: 992px) {
            .hero-side { display: none; } /* Sembunyikan sisi gambar jika layar HP */
        }
    </style>
</head>
<body>

    <div class="login-page-container">
        
        <div class="hero-side">
            <div class="hero-overlay"></div>
            
            <div class="hero-content">
                <p class="hero-tag"></i> LINTAR</p>
                <h2>Layanan Informasi Tarumanagara</h2>
                <p>Silakan masuk menggunakan akun resmi Universitas Tarumanagara untuk mengakses Lintar.</p>
            </div>
        </div>

        <div class="form-side">
            <div class="login-box">
                
                <div class="brand-logo">
                    <img src="{{ asset('logo.png') }}" alt="Logo UNTAR">
                    <div class="brand-text">
                        <h3>UNTAR</h3>
                        <p>Universitas Tarumanagara</p>
                    </div>
                </div>

                <div class="form-header">
                    <h1>Login Mahasiswa</h1>
                </div>

                @if($errors->has('email'))
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>{{ $errors->first('email') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('student.login') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="@stu.untar.ac.id" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-submit">Masuk</button>
                </form>

                <a href="{{ route('welcome') }}" style="text-decoration: none;">
                    <button type="button" class="btn-back">
                        </i> Kembali
                    </button>
                </a>
            </div>
        </div>

    </div>

</body>
</html>