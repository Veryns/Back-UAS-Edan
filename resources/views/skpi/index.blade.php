<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar SKPI - LINTAR UNTAR</title>
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
            padding: 40px 20px;
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
            background: rgba(15, 23, 42, 0.55); 
            z-index: -1;
        }

        .table-container {
            width: 100%;
            max-width: 1000px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.8);
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
            margin-bottom: 30px;
        }

        .table-header {
            background: linear-gradient(135deg, #800f13 0%, #b60000 100%);
            padding: 25px 35px;
            border-bottom: 4px solid #ffcc00; 
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-title i {
            font-size: 1.8rem;
            color: #ffcc00;
        }

        .header-title h1 {
            font-size: 1.5rem;
            color: #ffffff;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .header-title p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
        }

        .table-body {
            padding: 35px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            background-color: #ffffff;
            font-size: 0.95rem;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            padding: 14px 20px;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 16px 20px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 500;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f8fafc; 
        }

        td:first-child {
            font-weight: 700;
            color: #64748b;
            text-align: center;
            width: 70px;
        }

        .file-link {
            color: #1d4ed8;
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }

        .file-link:hover {
            color: #1e40af;
            text-decoration: underline;
        }

        .no-file {
            color: #94a3b8;
            font-size: 0.85rem;
            font-style: italic;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn {
            padding: 10px 18px;
            font-size: 0.85rem;
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Tombol Tambah SKPI */
        .btn-add {
            background-color: #ffcc00;
            color: #1e293b;
            box-shadow: 0 4px 12px rgba(255, 204, 0, 0.2);
        }

        .btn-add:hover {
            background-color: #e6b800;
            transform: translateY(-1px);
        }

        /* Tombol Detail */
        .btn-detail {
            background-color: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .btn-detail:hover {
            background-color: #dbeafe;
        }

        /* Tombol Hapus */
        .btn-delete {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fca5a5;
        }

        .btn-delete:hover {
            background-color: #fee2e2;
        }

        .btn-back {
            background-color: #ffffff;
            color: #64748b;
            border: 1px solid #cbd5e1;
            padding: 12px 24px;
        }

        .btn-back:hover {
            background-color: #f1f5f9;
            color: #334155;
        }

        .action-cell {
            display: flex;
            gap: 8px;
        }

    </style>
</head>
<body>

    <div class="table-container">
        
        <div class="table-header">
            <div class="header-title">
                <i class="fa-solid fa-file-invoice"></i>
                <div>
                    <h1>Daftar SKPI</h1>
                    <p>Surat Keterangan Pendamping Ijazah & Sertifikasi</p>
                </div>
            </div>
            
            <a href="{{ route('skpi.create') }}" class="btn btn-add">
                <i class="fa-solid fa-plus"></i> Tambah SKPI
            </a>
        </div>

        <div class="table-body">
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th>File Sertifikat</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skpis as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            
                            <td>
                                @if($item->file_sertifikat)
                                    <a href="{{ asset('storage/' . $item->file_sertifikat) }}" target="_blank" class="file-link">
                                        <i class="fa-solid fa-file-pdf"></i> Lihat File Sertifikat
                                    </a>
                                @else
                                    <span class="no-file">
                                        <i class="fa-solid fa-file-circle-xmark"></i> Tidak ada file
                                    </span>
                                @endif
                            </td>
                            
                            <td>
                                <div class="action-cell">
                                    
                                    <a href="{{ route('skpi.show', $item->id) }}" class="btn btn-detail">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>

                                    <form method="POST" action="{{ route('skpi.destroy', $item->id) }}" style="display:inline"
                                          onsubmit="return confirm('Yakin ingin menghapus sertifikat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="display: flex; justify-content: flex-start;">
                <a href="{{ route('student.home') }}" class="btn btn-back"> Kembali</a>
            </div>

        </div>

    </div>

</body>
</html>