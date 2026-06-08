<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - KRRS UNTAR</title>
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
            min-height: 100vh;
            display: flex;
        }

        .login-page-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .hero-side {
            flex: 1.2;
            position: relative;
            background: url("{{ asset('bg-gedung.jpg') }}") no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(168, 31, 31, 0.8) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 5;
            color: #ffffff;
            width: 100%;
            max-width: 600px;
        }

        .hero-tag {
            font-size: 0.9rem;
            font-weight: 700;
            color: #ffcc00; 
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
            border-color: #a81f1f; 
            box-shadow: 0 0 0 3px rgba(168, 31, 31, 0.15);
        }

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

        .btn-submit {
            width: 100%;
            background-color: #a81f1f;
            color: #ffffff;
            border: none;
            padding: 13px;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 15px;
            box-shadow: 0 4px 12px rgba(168, 31, 31, 0.2);
        }

        .btn-submit:hover {
            background-color: #8c1a1a;
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
    </style>
</head>
<body>

    <div class="login-page-container">
        
        <div class="hero-side">
            <div class="hero-overlay"></div>
            
            <div class="hero-content">
                <p class="hero-tag">Portal Admin</p>
                <h2>Sistem Administrasi Kampus</h2>
                <p>Portal khusus admin.</p>
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

                <!-- Judul Form -->
                <div class="form-header">
                    <h1>Login Admin</h1>
                </div>

                @if ($errors->any())
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span><strong>Error!</strong> {{ $errors->first('email') }}</span>
                    </div>
                @endif

                <!-- Form Post -->
                <form method="POST" action="/login">
                    @csrf
                    
                    <!-- Input Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="@untar.ac.id" required>
                        </div>
                    </div>
                    
                    <!-- Input Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>
                    
                    <!-- Tombol Login -->
                    <button type="submit" class="btn-submit">Login Admin</button>
                </form>

                <!-- Tombol Kembali -->
                <a href="{{ route('welcome') }}" style="text-decoration: none;">
                    <button type="button" class="btn-back">Kembali</button>
                </a>
            </div>
        </div>

    </div>

</body>
</html>