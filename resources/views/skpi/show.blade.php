<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail SKPI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

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
            max-width: 580px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            overflow: hidden;
        }

        .detail-header {
            background: linear-gradient(135deg, #991b1b 0%, #b91c1c 100%);
            padding: 25px 35px;
            border-bottom: 4px solid #ffcc00;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .detail-header i { font-size: 1.8rem; color: #ffcc00; }
        .detail-header h1 { font-size: 1.5rem; color: #ffffff; font-weight: 800; }
        .detail-header p { font-size: 0.8rem; color: rgba(255,255,255,0.85); margin-top: 2px; }

        .detail-body { padding: 35px; }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-row:last-of-type { border-bottom: none; }

        .info-row-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-row-value {
            font-size: 0.9rem;
            font-weight: 700;
            color: #1e293b;
            text-align: right;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-kategori { background: #eff6ff; color: #1d4ed8; }
        .badge-tingkat { background: #f0fdf4; color: #15803d; }

        .file-section {
            margin-top: 24px;
            padding: 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            text-align: center;
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
            margin-top: 8px;
        }

        .btn-view { background-color: #b91c1c; color: #ffffff; }
        .btn-view:hover { background-color: #991b1b; }
        .btn-back { background-color: #ffffff; color: #64748b; border: 1px solid #cbd5e1; margin-top: 12px; }
        .btn-back:hover { background-color: #f1f5f9; }
    </style>
</head>
<body>

    <div class="detail-container">
        <div class="detail-header">
            <i class="fa-solid fa-circle-info"></i>
            <div>
                <h1>Detail SKPI</h1>
                <p>Informasi lengkap sertifikat pendamping ijazah</p>
            </div>
        </div>

        <div class="detail-body">

            <div class="info-row">
                <span class="info-row-label"><i class="fa-solid fa-list"></i> Kategori</span>
                <span class="info-row-value"><span class="badge badge-kategori">{{ $skpi->kategori }}</span></span>
            </div>

            <div class="info-row">
                <span class="info-row-label"><i class="fa-solid fa-flag"></i> Kegiatan</span>
                <span class="info-row-value">{{ $skpi->kegiatan }}</span>
            </div>

            <div class="info-row">
                <span class="info-row-label"><i class="fa-solid fa-earth-asia"></i> Tingkat</span>
                <span class="info-row-value"><span class="badge badge-tingkat">{{ $skpi->tingkat }}</span></span>
            </div>

            <div class="info-row">
                <span class="info-row-label"><i class="fa-solid fa-trophy"></i> Klasifikasi</span>
                <span class="info-row-value">{{ $skpi->klasifikasi }}</span>
            </div>

            <div class="info-row">
                <span class="info-row-label"><i class="fa-solid fa-calendar"></i> Periode</span>
                <span class="info-row-value">{{ $skpi->periode_mulai }} s/d {{ $skpi->periode_selesai }}</span>
            </div>

            <div class="file-section">
                @if($skpi->file_sertifikat)
                    <i class="fa-solid fa-file-pdf" style="font-size:2rem; color:#b91c1c;"></i>
                    <p style="margin-top:8px; font-size:0.85rem; color:#64748b; font-weight:600;">File sertifikat tersedia</p>
                    <a href="{{ asset('storage/' . $skpi->file_sertifikat) }}" target="_blank" class="btn btn-view">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat File Dokumen
                    </a>
                @else
                    <i class="fa-solid fa-file-circle-xmark" style="font-size:2rem; color:#94a3b8;"></i>
                    <p style="margin-top:8px; font-size:0.85rem; color:#94a3b8; font-style:italic;">Tidak ada file dilampirkan</p>
                @endif
            </div>

            <a href="{{ route('skpi.index') }}" class="btn btn-back">Kembali ke Daftar</a>

        </div>
    </div>

</body>
</html>