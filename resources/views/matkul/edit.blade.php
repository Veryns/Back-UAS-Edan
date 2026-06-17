<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah - LINTAR UNTAR</title>
    <!-- Font modern & Font Awesome Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- Reset & Base Styles --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* --- BACKGROUND FULL FOTO UNTAR TRANSPARAN --- */
        body {
            min-height: 100vh;
            padding: 50px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            background-color: #1e293b;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url("/bg-gedung.jpg") no-repeat center center/cover;
            z-index: -2;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.6); 
            z-index: -1;
        }

        /* --- KARTU PUTIH BERSIH --- */
        .form-container {
            width: 100%;
            max-width: 650px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.8);
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }

        /* Header di dalam Kartu (Tema Merah) */
        .form-header {
            background: linear-gradient(135deg, #991b1b 0%, #b91c1c 100%);
            padding: 25px 35px;
            border-bottom: 4px solid #ffcc00; /* Garis Emas Untar */
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .form-header i {
            font-size: 1.8rem;
            color: #ffcc00;
        }

        .form-header h1 {
            font-size: 1.5rem;
            color: #ffffff;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .form-header p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.85);
            margin-top: 2px;
        }

        /* Area Isi Form */
        .form-body {
            padding: 35px;
        }

        /* Susunan Layout Form Dua Kolom (Untuk Kode & SKS) */
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Elemen Input, Textarea, dan Form Control */
        input, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #1e293b;
            font-weight: 500;
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #b91c1c;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(185, 28, 28, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* --- AREA TOMBOL AKSI --- */
        .form-footer-actions {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn {
            padding: 12px 24px;
            font-size: 0.9rem;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Tombol Kembali (Biasa) */
        .btn-back {
            background-color: #ffffff;
            color: #64748b;
            border: 1px solid #cbd5e1;
        }

        .btn-back:hover {
            background-color: #f1f5f9;
            color: #334155;
        }

        /* Tombol Perbarui (Merah) */
        .btn-submit {
            background-color: #b91c1c;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(185, 28, 28, 0.15);
        }

        .btn-submit:hover {
            background-color: #991b1b;
            box-shadow: 0 4px 15px rgba(185, 28, 28, 0.3);
            transform: translateY(-1px);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive View HP */
        @media (max-width: 640px) {
            body { padding: 20px 10px; }
            .form-body { padding: 25px 20px; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
            .form-footer-actions { flex-direction: column-reverse; }
            .btn { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

    <div class="form-container">
        
        <!-- Header Atas Kartu Form -->
        <div class="form-header">
            <i class="fa-solid fa-pen-to-square"></i>
            <div>
                <h1>Edit Mata Kuliah</h1>
                <p>Ubah rincian informasi dan detail kelas mata kuliah aktif</p>
            </div>
        </div>

        <!-- Bagian Input Form -->
        <div class="form-body">
            <form method="POST" action="{{ route('matkul.update', $matkul->id) }}">
                @csrf
                @method('PUT')
                
                <!-- Nama Mata Kuliah -->
                <div class="input-group">
                    <label><i class="fa-solid fa-book"></i> Nama Mata Kuliah</label>
                    <input name="nama" value="{{ $matkul->nama }}" placeholder="Contoh: Pemrograman Web" required>
                </div>

                <!-- Baris Gabungan: Kode & SKS -->
                <div class="form-row">
                    <!-- Kode Matkul -->
                    <div class="input-group">
                        <label>Kode Mata Kuliah</label>
                        <input name="kodematkul" value="{{ $matkul->kodematkul }}" placeholder="Contoh: MK001" required>
                    </div>

                    <!-- Jumlah SKS -->
                    <div class="input-group">
                        <label>Bobot SKS</label>
                        <input name="sks" type="number" min="1" value="{{ $matkul->sks }}" required>
                    </div>
                </div>

                <!-- Deskripsi Mata Kuliah -->
                <div class="input-group">
                    <label><i class="fa-solid fa-align-left"></i> Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="4" placeholder="Tulis deskripsi atau silabus mata kuliah di sini...">{{ $matkul->deskripsi }}</textarea>
                </div>

                <!-- Nama Dosen Pengampu -->
                <div class="input-group">
                    <label><i class="fa-solid fa-user-tie"></i> Dosen Pengampu</label>
                    <input name="dosen" value="{{ $matkul->dosen }}" placeholder="Nama Lengkap Dosen beserta Gelar" required>
                </div>

                <!-- Kode Microsoft Teams -->
                <div class="input-group" style="margin-bottom: 5px;">
                    <label><i class="fa-brands fa-microsoft"></i> Kode MS Teams (Opsional)</label>
                    <input name="kodemsteam" value="{{ $matkul->kodemsteam }}" placeholder="Contoh: abc123f">
                </div>

                <div class="form-footer-actions">
                    
                    <!-- Kembali -->
                    <a href="{{ route('matkul.index') }}" class="btn btn-back">Batal</a>

                    <!-- Perbarui Data -->
                    <button type="submit" class="btn btn-submit">Perbarui Data</button>

                </div>
            </form>
        </div>

    </div>

</body>
</html>