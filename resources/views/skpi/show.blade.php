<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail SKPI - LINTAR UNTAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            padding: 60px 20px;
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

        .detail-container {
            width: 100%;
            max-width: 550px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.8);
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }

        .detail-header {
            background: linear-gradient(135deg, #991b1b 0%, #b91c1c 100%);
            padding: 25px 35px;
            border-bottom: 4px solid #ffcc00;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .detail-header i {
            font-size: 1.8rem;
            color: #ffcc00;
        }

        .detail-header h1 {
            font-size: 1.5rem;
            color: #ffffff;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .detail-header p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.85);
            margin-top: 2px;
        }

        .detail-body {
            padding: 35px;
        }

        .info-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .info-card .icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .icon-success {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fee2e2;
        }

        .icon-empty {
            background-color: #f1f5f9;
            color: #94a3b8;
            border: 1px solid #e2e8f0;
        }

        .info-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
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
            justify-content: center;
            gap: 8px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 100%;
        }

        .btn-view {
            background-color: #b91c1c;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(185, 28, 28, 0.15);
            margin-top: 5px;
        }

        .btn-view:hover {
            background-color: #991b1b;
            box-shadow: 0 4px 15px rgba(185, 28, 28, 0.3);
            transform: translateY(-1px);
        }

        .btn-back {
            background-color: #ffffff;
            color: #64748b;
            border: 1px solid #cbd5e1;
            margin-top: 12px;
        }

        .btn-back:hover {
            background-color: #f1f5f9;
            color: #334155;
        }


    </style>
</head>
<body>

    <div class="detail-container">
        
        <div class="detail-header">
            <i class="fa-solid fa-circle-info"></i>
            <div>
                <h1>Detail Informasi SKPI</h1>
                <p>Verifikasi lampiran file sertifikat</p>
            </div>
        </div>

        <!-- Bagian Isi Utama -->
        <div class="detail-body">
            
            <div class="info-card">
                @if($skpi->file_sertifikat)
                    <!-- Tampilan Jika file Tersedia -->
                    <div class="icon-wrapper icon-success">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div>
                        <p class="info-label">Status Dokumen</p>
                        <p class="info-value">Sertifikat Tersedia</p>
                    </div>
                    
                    <!-- Link Lihat file Asli -->
                    <a href="{{ asset('storage/' . $skpi->file_sertifikat) }}" target="_blank" class="btn btn-view">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat File Dokumen
                    </a>
                @else
                    <!-- Tampilan Jika file Kosong -->
                    <div class="icon-wrapper icon-empty">
                        <i class="fa-solid fa-file-circle-xmark"></i>
                    </div>
                    <div>
                        <p class="info-label">Status Dokumen</p>
                        <p class="info-value" style="color: #94a3b8; font-style: italic;">Tidak ada file dilampirkan</p>
                    </div>
                @endif
            </div>

            <!-- Tombol Kembali Ke Halaman Indeks SKPI -->
            <a href="{{ route('skpi.index') }}" class="btn btn-back">Kembali ke Daftar</a>

        </div>

    </div>

</body>
</html>