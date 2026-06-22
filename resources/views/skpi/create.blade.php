<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah SKPI</title>
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

        .form-container {
            width: 100%;
            max-width: 600px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #991b1b 0%, #b91c1c 100%);
            padding: 25px 35px;
            border-bottom: 4px solid #ffcc00;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .form-header i { font-size: 1.8rem; color: #ffcc00; }
        .form-header h1 { font-size: 1.5rem; color: #ffffff; font-weight: 800; }
        .form-header p { font-size: 0.8rem; color: rgba(255,255,255,0.85); margin-top: 2px; }

        .form-body { padding: 35px; }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        label {
            font-size: 0.9rem;
            font-weight: 700;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        select, input[type="date"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #334155;
            background: #f8fafc;
            transition: border-color 0.2s;
        }

        select:focus, input[type="date"]:focus {
            outline: none;
            border-color: #b91c1c;
            background: #fff;
        }

        select:disabled {
            background: #f1f5f9;
            color: #94a3b8;
            cursor: not-allowed;
        }

        .periode-row { display: flex; gap: 12px; }
        .periode-row .input-group { flex: 1; }

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

        .file-dropzone:hover { border-color: #b91c1c; background-color: #fef2f2; }
        .file-dropzone i { font-size: 2.5rem; color: #64748b; margin-bottom: 12px; }
        .file-dropzone:hover i { color: #b91c1c; }

        .file-dropzone input[type="file"] {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .dropzone-text h4 { font-size: 0.95rem; color: #334155; font-weight: 700; margin-bottom: 4px; }
        .dropzone-text p { font-size: 0.8rem; color: #64748b; }

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

        .btn-back { background-color: #ffffff; color: #64748b; border: 1px solid #cbd5e1; }
        .btn-back:hover { background-color: #f1f5f9; }
        .btn-submit { background-color: #b91c1c; color: #ffffff; }
        .btn-submit:hover { background-color: #991b1b; transform: translateY(-1px); }

        .form-error { font-size: 0.8rem; color: #dc2626; margin-top: 2px; }

        .hint {
            font-size: 0.78rem;
            color: #94a3b8;
            font-style: italic;
            margin-top: 2px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-header">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <div>
                <h1>Upload SKPI</h1>
                <p>Tambahkan sertifikat pendamping ijazah</p>
            </div>
        </div>

        <div class="form-body">
            <form method="POST" action="{{ route('skpi.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Kategori --}}
                <div class="input-group">
                    <label><i class="fa-solid fa-list"></i> Kategori</label>
                    <select name="kategori" id="kategori" required onchange="updateKegiatan()">
                        <option value="">Pilih Kategori</option>
                        <option value="Penalaran dan Keilmuan">Penalaran dan Keilmuan</option>
                        <option value="Bakat dan Minat">Bakat dan Minat</option>
                        <option value="Kewirausahaan">Kewirausahaan</option>
                        <option value="Organisasi">Organisasi</option>
                        <option value="Kepedulian Sosial">Kepedulian Sosial</option>
                        <option value="Lain">Lain-lain</option>
                    </select>
                    @error('kategori') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- Kegiatan --}}
                <div class="input-group">
                    <label>Kegiatan</label>
                    <select name="kegiatan" id="kegiatan" required disabled>
                        <option value="">Pilih Kategori Terlebih Dahulu</option>
                    </select>
                    <span class="hint" id="kegiatan-hint">Pilih kategori terlebih dahulu sebelum memilih kegiatan.</span>
                    @error('kegiatan') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- Tingkat --}}
                <div class="input-group">
                    <label>Tingkat</label>
                    <select name="tingkat" required>
                        <option value="">Pilih Tingkat</option>
                        <option value="Internasional">Internasional</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Wilayah (Regional)">Wilayah (Regional)</option>
                        <option value="Universitas">Universitas</option>
                        <option value="Fakultas">Fakultas</option>
                        <option value="Departemen">Departemen</option>
                    </select>
                    @error('tingkat') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- Klasifikasi --}}
                <div class="input-group">
                    <label>Klasifikasi</label>
                    <select name="klasifikasi" required>
                        <option value="">Pilih Klasifikasi</option>
                        <option value="Juara I">Juara I</option>
                        <option value="Juara II">Juara II</option>
                        <option value="Juara III">Juara III</option>
                        <option value="Peserta">Peserta</option>
                        <option value="Panitia">Panitia</option>
                        <option value="Aktif">Aktif</option>
                    </select>
                    @error('klasifikasi') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                {{-- Periode --}}
                <div class="periode-row">
                    <div class="input-group">
                        <label><i class="fa-solid fa-calendar"></i> Periode Mulai</label>
                        <input type="date" name="periode_mulai" required>
                        @error('periode_mulai') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="input-group">
                        <label><i class="fa-solid fa-calendar-check"></i> Periode Selesai</label>
                        <input type="date" name="periode_selesai" required>
                        @error('periode_selesai') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- File --}}
                <div class="input-group">
                    <label><i class="fa-solid fa-file"></i> File Pendukung/Bukti</label>
                    <div class="file-dropzone">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        <div class="dropzone-text">
                            <h4>Pilih file atau seret ke sini</h4>
                            <p>Format jpg/png/pdf, maksimal 10 MB</p>
                        </div>
                        <input type="file" name="file_sertifikat" accept=".pdf,.jpg,.jpeg,.png" required onchange="showFileName(this)">
                    </div>
                    <div class="file-name-preview" id="file-name-display">
                        <i class="fa-solid fa-circle-check"></i> <span id="file-title"></span>
                    </div>
                    @error('file_sertifikat') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-footer-actions">
                    <a href="{{ route('skpi.index') }}" class="btn btn-back">Kembali</a>
                    <button type="submit" class="btn btn-submit">Simpan</button>
                </div>

            </form>
        </div>
    </div>

    <script>
        const kegiatanOptions = {
            'Penalaran dan Keilmuan': [
                'Olimpiade / Debat / Karya Tulis / Lomba Sejenisnya',
                'Mengikuti Kegiatan / Forum Ilmiah (Seminar, Lokakarya, Workshop, Pameran, atau yang sejenisnya)',
                'Karya Ilmiah yang Dipublikasikan dalam Jurnal Ilmiah',
                'Memiliki Hak Atas Kekayaan Intelektual (HKI atau Paten)',
                'Karya Populer yang Diterbitkan di Surat Kabar / Majalah / Media Lainnya',
                'Menghasilkan Karya yang didanai Pemerintah / Pihak Lainnya',
                'Memberikan Pelatihan / Bimbingan Dalam Penyusunan Karya Tulis',
                'Asisten Mahasiswa / Asisten Dosen',
                'Menghasilkan Karya yang tidak dipublikasikan',
                'Menghasilkan Karya yang dipublikasikan',
                'Mengikuti Kuliah Tamu',
                'Terlibat dalam Penelitian atau Pengabdian Kepada Masyarakat (PKM)',
                'Memberikan Pelatihan Kegiatan Kemahasiswaan',
                'Pertukaran Mahasiswa',
                'Magang',
                'Sertifikasi Profesional',
            ],
            'Bakat dan Minat': [
                'Kejuaraan Kegiatan Minat dan Bakat',
                'Kejuaraan Kegiatan Minat dan Bakat (Olahraga, Seni dan Kerohanian)',
                'Menjadi Pelatih / Wasit Kegiatan Minat dan Bakat',
                'Menjadi Mitra Tanding',
                'Menjadi Duta Anti Narkoba / Bidang Lainnya',
                'Menghasilkan Karya Seni (Konser / Pameran Seni / Pentas Seni / Puisi / Fotografi / Teater)',
            ],
            'Kewirausahaan': [
                'Mengelola Kewirausahaan',
            ],
            'Organisasi': [
                'Pengurus Organisasi',
                'Mengikuti Latihan Kepemimpinan Manajemen Mahasiswa (LKMM)',
                'Mengikuti Latihan Kepemimpinan (LK)',
                'Panitia dalam Suatu Kegiatan Kemahasiswaan',
            ],
            'Kepedulian Sosial': [
                'Mengikuti Pelaksanaan Bakti Sosial',
                'Penanganan Bencana Alam dikoordinasikan Untar',
                'Bantuan Pembimbingan Rutin (Pelayanan Ibadah, TPA, PAUD)',
                'Kegiatan Lain Individual Sosial',
            ],
            'Lain': [
                'Berpartisipasi dalam Kegiatan Alumni',
                'Melakukan Kunjungan / Studi Banding',
                'Magang Penelitian',
                'Kegiatan Jati Diri',
                'PRADIKTI',
            ],
        };

        function updateKegiatan() {
            const kategori = document.getElementById('kategori').value;
            const kegiatanSelect = document.getElementById('kegiatan');
            const hint = document.getElementById('kegiatan-hint');

            kegiatanSelect.innerHTML = '<option value="">Pilih Kegiatan</option>';

            if (kategori && kegiatanOptions[kategori]) {
                kegiatanSelect.disabled = false;
                hint.style.display = 'none';
                kegiatanOptions[kategori].forEach(function(item) {
                    const option = document.createElement('option');
                    option.value = item;
                    option.textContent = item;
                    kegiatanSelect.appendChild(option);
                });
            } else {
                kegiatanSelect.disabled = true;
                hint.style.display = 'block';
            }
        }

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