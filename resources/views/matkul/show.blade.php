<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mata Kuliah - LINTAR UNTAR</title>
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
            background: rgba(15, 23, 42, 0.5); 
            z-index: -1;
        }

        .detail-container {
            width: 100%;
            max-width: 750px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.8);
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }

        .detail-header {
            background: linear-gradient(135deg, #941b1b 0%, #6e1010 100%);
            padding: 25px 35px;
            border-bottom: 4px solid #ffcc00; /* Garis Emas Untar */
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
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-body {
            padding: 35px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 24px;
        }

        .full-width {
            grid-column: span 2;
        }

        .info-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 16px 20px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .info-card:hover {
            border-color: #cbd5e1;
            background-color: #f1f5f9;
        }

        .info-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-label i {
            font-size: 0.9rem;
            color: #941b1b;
        }

        .info-value {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1e293b;
        }

        .code-badge {
            font-family: 'Courier New', Courier, monospace;
            background: #edf2f7;
            padding: 2px 8px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
        }

        .sks-badge {
            background: #fffbeb;
            color: #b7791f;
            border: 1px solid #fef3c7;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .description-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 20px;
            border-radius: 10px;
            margin-top: 4px;
        }

        .description-text {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #334155;
            font-weight: 500;
            white-space: pre-line;
        }

        .detail-footer-actions {
            margin-top: 30px;
            padding-top: 20px;
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

        /* Tombol Kembali */
        .btn-back {
            background-color: #ffffff;
            color: #64748b;
            border: 1px solid #cbd5e1;
        }

        .btn-back:hover {
            background-color: #f1f5f9;
            color: #334155;
        }

        .btn-edit {
            background-color: #dd6b20;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(221, 107, 32, 0.2);
        }

        .btn-edit:hover {
            background-color: #c05621;
            transform: translateY(-1px);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>
<body>

    <div class="detail-container">
        
        <div class="detail-header">
            <i class="fa-solid fa-circle-info"></i>
            <div>
                <h1>Detail Mata Kuliah</h1>
                <p>Informasi Lengkap Kurikulum Portal LINTAR</p>
            </div>
        </div>

        <div class="detail-body">
            
            <div class="info-grid">
                
                <div class="info-card full-width">
                    <div class="info-label"><i class="fa-solid fa-book"></i> Nama Mata Kuliah</div>
                    <div class="info-value" style="color: #941b1b; font-size: 1.2rem;">{{ $matkul->nama }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">Kode Mata Kuliah</div>
                    <div class="info-value"><span class="code-badge">{{ $matkul->kodematkul }}</span></div>
                </div>

                <div class="info-card">
                    <div class="info-label"><i class="fa-solid fa-layer-group"></i> Bobot SKS</div>
                    <div class="info-value"><span>{{ $matkul->sks }} SKS</span></div>
                </div>

                <div class="info-card full-width">
                    <div class="info-label"><i class="fa-solid fa-user-tie"></i> Dosen Pengampu</div>
                    <div class="info-value">{{ $matkul->dosen }}</div>
                </div>

                <div class="info-card full-width">
                    <div class="info-label"><i class="fa-brands fa-microsoft"></i> Kode Microsoft Teams</div>
                    <div class="info-value" style="font-family: monospace; color: #4a5568;">
                        {{ $matkul->kodemsteam ?? '-' }}
                    </div>
                </div>

                <div class="info-card full-width">
                    <div class="info-label"><i class="fa-solid fa-align-left"></i> Deskripsi Ringkas</div>
                    <div class="description-box">
                        <div class="description-text">
                            {{ $matkul->deskripsi ?? 'Tidak ada deskripsi untuk mata kuliah ini.' }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="detail-footer-actions">
                
                <a href="{{ route('matkul.index') }}" class="btn btn-back">Kembali</a>

                @if(Auth::guard('student')->guest())
                    <a href="{{ route('matkul.edit', $matkul->id) }}" class="btn btn-edit">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Data
                    </a>
                @endif

            </div>

        </div>

    </div>

</body>
</html>