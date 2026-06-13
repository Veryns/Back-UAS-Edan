<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Kuliah - LINTAR UNTAR</title>
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
            background: rgba(15, 23, 42, 0.5); 
            z-index: -1;
        }

        .form-container {
            width: 100%;
            max-width: 700px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.8);
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }

        .form-header {
            background: linear-gradient(135deg, #941b1b 0%, #6e1010 100%);
            padding: 25px 35px;
            border-bottom: 4px solid #ffcc00;
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
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
        }

        .form-body {
            padding: 35px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .full-width {
            grid-column: span 2;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        label i {
            color: #64748b;
            font-size: 0.9rem;
            width: 16px;
            text-align: center;
        }

        input, textarea {
            width: 100%;
            padding: 12px 16px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #1e293b;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s ease-in-out;
        }

        input:focus, textarea:focus {
            background-color: #ffffff;
            border-color: #941b1b;
            box-shadow: 0 0 0 3px rgba(148, 27, 27, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-footer-actions {
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
            border-color: #94a3b8;
        }

        /* Tombol Simpan */
        .btn-submit {
            background-color: #941b1b;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(148, 27, 27, 0.15);
        }

        .btn-submit:hover {
            background-color: #7a1515;
            box-shadow: 0 4px 15px rgba(148, 27, 27, 0.25);
            transform: translateY(-1px);
        }

        /* Animasi Masuk */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <i class="fa-solid fa-square-plus"></i>
            <div>
                <h1>Tambah Mata Kuliah</h1>
                <p>Input data kurikulum baru pada basis data LINTAR</p>
            </div>
        </div>

        <div class="form-body">
            <form method="POST" action="{{ route('matkul.store') }}">
                @csrf
                
                <div class="form-grid">
                    
                    <div class="input-group full-width">
                        <label><i class="fa-solid fa-book"></i> Nama Mata Kuliah</label>
                        <input name="nama" placeholder="Masukkan nama mata kuliah" required>
                    </div>

                    <div class="input-group">
                        <label><i class="fa-solid fa-barcode"></i> Kode Mata Kuliah</label>
                        <input name="kodematkul" placeholder="Contoh: TI2025" required>
                    </div>

                    <div class="input-group">
                        <label><i class="fa-solid fa-layer-group"></i> Bobot SKS</label>
                        <input name="sks" type="number" min="1" placeholder="Jumlah SKS" required>
                    </div>

                    <div class="input-group full-width">
                        <label><i class="fa-solid fa-user-tie"></i> Dosen Pengampu</label>
                        <input name="dosen" placeholder="Nama lengkap dosen beserta gelar" required>
                    </div>

                    <div class="input-group full-width">
                        <label><i class="fa-brands fa-microsoft"></i> Kode Microsoft Teams (Opsional)</label>
                        <input name="kodemsteam" placeholder="Masukkan kode MS Teams">
                    </div>

                    <div class="input-group full-width">
                        <label><i class="fa-solid fa-align-left"></i> Deskripsi Mata Kuliah</label>
                        <textarea name="deskripsi" rows="4" placeholder="Tuliskan deskripsi singkat mengenai mata kuliah"></textarea>
                    </div>

                </div>

                <div class="form-footer-actions">
                    
                    <a href="{{ route('matkul.index') }}" class="btn btn-back">Kembali</a>

                    <button type="submit" class="btn btn-submit">Simpan</button>

                </div>
            </form>
        </div>

    </div>

</body>
</html>