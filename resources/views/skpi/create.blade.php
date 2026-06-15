<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah SKPI - LINTAR UNTAR</title>
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

        .form-container {
            width: 100%;
            max-width: 600px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.8);
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }

        .form-header {
            background: linear-gradient(135deg, #991b1b 0%, #b91c1c 100%);
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
            color: rgba(255, 255, 255, 0.85);
            margin-top: 2px;
        }

        .form-body {
            padding: 35px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        label {
            font-size: 0.9rem;
            font-weight: 700;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-dropzone {
            position: relative;
            width: 100%;
            padding: 40px 20px;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background-color: #f8fafc;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .file-dropzone:hover {
            border-color: #b91c1c;
            background-color: #fef2f2;
        }

        .file-dropzone i {
            font-size: 2.5rem;
            color: #64748b;
            margin-bottom: 12px;
            transition: color 0.2s;
        }

        .file-dropzone:hover i {
            color: #b91c1c;
        }

        .file-dropzone input[type="file"] {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .dropzone-text h4 {
            font-size: 0.95rem;
            color: #334155;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .dropzone-text p {
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 500;
        }

        .file-name-preview {
            margin-top: 8px;
            font-size: 0.85rem;
            color: #dc2626;
            font-weight: 700;
            display: none;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .form-footer-actions {
            margin-top: 35px;
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


    </style>
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <div>
                <h1>Upload SKPI</h1>
                <p>Tambahkan file sertifikat pendukung kelulusan akademik</p>
            </div>
        </div>

        <!-- Bagian Input Form -->
        <div class="form-body">
            <form method="POST" action="{{ route('skpi.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="input-group">
                    <label>File Sertifikat</label>
                    
                    <div class="file-dropzone">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        <div class="dropzone-text">
                            <h4>Pilih file atau seret ke sini</h4>
                        </div>
                        
                        <!-- Input File Asli -->
                        <input type="file" name="file_sertifikat" accept=".pdf,.jpg,.jpeg,.png" required onchange="showFileName(this)">
                    </div>
                    
                    <div class="file-name-preview" id="file-name-display">
                        <i class="fa-solid fa-circle-check"></i> <span id="file-title"></span>
                    </div>
                </div>

                <div class="form-footer-actions">
                    
                    <!-- Tombol Kembali -->
                    <a href="{{ route('skpi.index') }}" class="btn btn-back">Kembali</a>

                    <!-- Tombol Simpan Merah -->
                    <button type="submit" class="btn btn-submit">Simpan</button>

                </div>
            </form>
        </div>

    </div>

    <!-- untuk menampilkan nama file -->
    <script>
        function showFileName(input) {
            var displayContainer = document.getElementById('file-name-display');
            var titleSpan = document.getElementById('file-title');
            
            if (input.files && input.files.length > 0) {
                titleSpan.textContent = input.files[0].name;
                displayContainer.style.display = 'inline-flex';
            } else {
                displayContainer.style.display = 'none';
            }
        }
    </script>

</body>
</html>