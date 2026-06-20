<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah - LINTAR UNTAR</title>
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
            align-items: flex-start;
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
            background: rgba(15, 23, 42, 0.45); 
            z-index: -1;
        }

        .table-container {
            width: 100%;
            max-width: 1140px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.8);
            overflow: hidden;
            animation: fadeIn 0.4s ease-out;
        }

        .table-header-section {
            background: linear-gradient(135deg, #941b1b 0%, #6e1010 100%);
            padding: 30px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid #ffcc00;
            position: relative;
        }

        .table-header-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: linear-gradient(rgba(255, 204, 0, 0.05) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 204, 0, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
            pointer-events: none;
        }

        .table-title h1 {
            font-size: 1.7rem;
            color: #ffffff;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }

        .table-title p {
            font-size: 0.85rem;
            color: #ffcc00; 
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-top: 4px;
        }

        .table-content-body {
            padding: 35px;
        }

        .responsive-table-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            margin-bottom: 25px;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
        }

        th {
            background: linear-gradient(180deg, #801414 0%, #610b0b 100%);
            color: #ffcc00; /* Teks Judul Kolom Emas */
            font-weight: 700;
            padding: 14px 18px;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.8px;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        th:last-child {
            border-right: none;
        }

        td {
            padding: 14px 18px;
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid #edf2f7;
            color: #2d3748;
            font-weight: 600;
            vertical-align: middle;
        }

        td:last-child {
            border-right: none;
        }

        tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        tr:hover td {
            background-color: #fffbeb !important; 
        }

        .matkul-name {
            font-weight: 700;
            color: #941b1b; 
        }

        .matkul-code {
            font-family: 'Courier New', Courier, monospace;
            font-weight: 700;
            color: #1a202c;
            background-color: #edf2f7;
            padding: 4px 8px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .sks-badge {
            background-color: #fffbeb;
            color: #b7791f;
            border: 1px solid #fef3c7;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .btn {
            padding: 8px 14px;
            font-size: 0.8rem;
            font-weight: 700;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* Tombol Tambah Matkul */
        .btn-create {
            background-color: #ffcc00;
            color: #000000;
            padding: 10px 18px;
            font-size: 0.85rem;
            box-shadow: 0 2px 6px rgba(255, 204, 0, 0.3);
            border: 1px solid #e6b800;
        }

        .btn-create:hover {
            background-color: #e6b800;
            transform: translateY(-1px);
        }

        /* Tombol Aksi Kolom */
        .btn-detail {
            background-color: #3182ce;
            color: #ffffff;
        }

        .btn-detail:hover { background-color: #2b6cb0; }

        .btn-edit {
            background-color: #dd6b20;
            color: #ffffff;
        }

        .btn-edit:hover { background-color: #c05621; }

        .btn-delete {
            background-color: #e53e3e;
            color: #ffffff;
        }

        .btn-delete:hover { background-color: #c53030; }

        /* Tombol Kembali */
        .btn-back {
            background-color: #4a5568;
            color: #ffffff;
            padding: 10px 16px;
        }

        .btn-back:hover {
            background-color: #2d3748;
        }

        .action-cell {
            display: flex;
            gap: 6px;
        }

        .inline-form {
            display: inline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            body { padding: 20px 10px; }
            .table-header-section { flex-direction: column; text-align: center; gap: 15px; }
            .btn-create { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

    <div class="table-container">
        
        <div class="table-header-section">
            <div class="table-title">
                <h1><i class="fa-solid fa-folder-open" style="color: #ffcc00; margin-right: 8px;"></i> Daftar Mata Kuliah</h1>
                <p>Sistem Informasi Akademik Tarumanagara</p>
            </div>
            
            @if(Auth::guard('student')->guest())
                <a href="{{ route('matkul.create') }}" class="btn btn-create">
                    <i class="fa-solid fa-square-plus"></i> Tambah Matkul Baru
                </a>
            @endif
        </div>

        <div class="table-content-body">
            
            <div class="responsive-table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center;">No</th>
                            <th style="width: 35%;">Nama Mata Kuliah</th>
                            <th style="width: 15%;">Kode MatKul</th>
                            <th style="width: 12%;">Bobot SKS</th>
                            <th style="width: 18%;">Dosen Pengampu</th>
                            <th style="width: 15%;">Aksi Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matkuls as $index => $matkul)
                        <tr>
                            <td style="text-align: center; color: #718096;">{{ $index + 1 }}</td>
                            
                            <td><span class="matkul-name">{{ $matkul->nama }}</span></td>
                            
                            <td><span class="matkul-code">{{ $matkul->kodematkul }}</span></td>
                            
                            <td>
                                <span class="sks-badge">
                                    {{ $matkul->sks }} SKS
                                </span>
                            </td>
                            
                            <td style="font-size: 0.85rem; color: #4a5568;">{{ $matkul->dosen }}</td>
                            
                            <td>
                                <div class="action-cell">
                                    <a href="{{ route('matkul.show', $matkul->id) }}" class="btn btn-detail" title="Lihat Detail">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                    
                                    @if(Auth::guard('student')->guest())
                                        <a href="{{ route('matkul.edit', $matkul->id) }}" class="btn btn-edit" title="Ubah Data">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        
                                        <form method="POST" action="{{ route('matkul.destroy', $matkul->id) }}" style="display:inline" 
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mata kuliah ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete" title="Hapus Data">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-footer-actions">
                @if(Auth::guard('student')->check())
                    <a href="{{ route('student.home') }}" class="btn btn-back">Kembali</a>
                @else
                    <a href="{{ route('home') }}" class="btn btn-back">Kembali</a>
                @endif
            </div>

        </div>
    </div>

</body>
</html>