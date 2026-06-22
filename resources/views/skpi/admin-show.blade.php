<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail SKPI Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            min-height: 100vh;
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
            color: #1e293b;
        }

        .top-navbar {
            background: linear-gradient(90deg, #941b1b 0%, #6e1010 100%);
            border-bottom: 3px solid #ffcc00;
            padding: 0 40px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #ffffff;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .brand-area { display: flex; align-items: center; gap: 14px; }
        .brand-area img { height: 46px; width: auto; }
        .brand-text h3 { font-size: 1.2rem; font-weight: 800; letter-spacing: 0.5px; }
        .brand-text p { font-size: 0.75rem; color: #ffcc00; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }

        .user-area { display: flex; align-items: center; gap: 25px; }
        .user-greeting { display: flex; align-items: center; gap: 10px; font-size: 0.95rem; font-weight: 600; color: rgba(255,255,255,0.9); }
        .user-greeting i { color: #ffcc00; font-size: 1.2rem; }

        .btn-logout {
            background-color: rgba(255,255,255,0.1);
            color: #ffffff;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover { background-color: #ffffff; color: #941b1b; }

        .content-body { padding: 40px; max-width: 1300px; width: 100%; margin: 0 auto; flex-grow: 1; }

        .detail-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0,0,0,0.02);
            border: 1px solid #f1f5f9;
            border-top: 6px solid #941b1b;
        }

        .detail-card h1 {
            font-size: 1.7rem;
            color: #941b1b;
            margin-bottom: 30px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .student-meta { display: flex; gap: 20px; margin-bottom: 35px; flex-wrap: wrap; }

        .meta-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 14px 20px;
            border-radius: 8px;
            min-width: 240px;
        }

        .meta-box span { display: block; font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px; }
        .meta-box strong { font-size: 1.1rem; color: #0f172a; font-weight: 700; }

        .table-responsive { width: 100%; overflow-x: auto; margin-bottom: 25px; }

        .custom-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem; }

        .custom-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            padding: 14px 16px;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }

        .custom-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-weight: 500;
            vertical-align: middle;
        }

        .custom-table tr:hover { background-color: #f8fafc; }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-kategori { background: #eff6ff; color: #1d4ed8; }
        .badge-tingkat { background: #f0fdf4; color: #15803d; }
        .badge-klasifikasi { background: #fefce8; color: #a16207; }

        .periode-text { font-size: 0.82rem; line-height: 1.6; }
        .periode-text span { color: #94a3b8; }

        .btn-view {
            background-color: #941b1b;
            color: #ffffff;
            border: none;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-view:hover { background-color: #6e1010; }

        .text-muted { color: #94a3b8; font-style: italic; font-size: 0.85rem; }

        .btn-back {
            background-color: #941b1b;
            color: #ffffff;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(148, 27, 27, 0.15);
        }

        .btn-back:hover { 
            background-color: #6e1010; 
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(110, 16, 16, 0.25);
        }
    </style>
</head>
<body>

    <header class="top-navbar">
        <div class="brand-area">
            <img src="{{ asset('logo.png') }}" alt="Logo UNTAR">
            <div class="brand-text">
                <h3>LINTAR UNIVERSITAS TARUMANAGARA</h3>
                <p>Dashboard</p>
            </div>
        </div>
        <div class="user-area">
            <div class="user-greeting">
                <i class="fa-solid fa-circle-user"></i>
                <span>{{ Auth::user()->name }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </header>

    <main class="content-body">
        <div class="detail-card">
            <h1><i class="fa-solid fa-graduation-cap"></i> Detail SKPI Mahasiswa</h1>

            <div class="student-meta">
                <div class="meta-box">
                    <span>NIM Mahasiswa</span>
                    <strong>{{ $student->student_id }}</strong>
                </div>
                <div class="meta-box">
                    <span>Nama Lengkap</span>
                    <strong>{{ $student->name }}</strong>
                </div>
                <div class="meta-box">
                    <span>Total SKPI</span>
                    <strong>{{ $skpis->count() }} Dokumen</strong>
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Kategori</th>
                            <th>Kegiatan</th>
                            <th>Tingkat</th>
                            <th>Klasifikasi</th>
                            <th>Periode</th>
                            <th>File</th>
                            <th>Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skpis as $skpi)
                        <tr>
                            <td style="text-align:center; color:#64748b; font-weight:700;">{{ $loop->iteration }}</td>
                            <td><span class="badge badge-kategori">{{ $skpi->kategori ?? '-' }}</span></td>
                            <td style="max-width:220px; font-size:0.85rem;">{{ $skpi->kegiatan ?? '-' }}</td>
                            <td><span class="badge badge-tingkat">{{ $skpi->tingkat ?? '-' }}</span></td>
                            <td><span class="badge badge-klasifikasi">{{ $skpi->klasifikasi ?? '-' }}</span></td>
                            <td>
                                @if($skpi->periode_mulai)
                                    <div class="periode-text">
                                        {{ $skpi->periode_mulai }}<br>
                                        <span>s/d</span><br>
                                        {{ $skpi->periode_selesai }}
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($skpi->file_sertifikat)
                                    <a href="{{ asset('storage/' . $skpi->file_sertifikat) }}" target="_blank" class="btn-view">
                                        <i class="fa-solid fa-file-pdf"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted"><i class="fa-solid fa-circle-xmark"></i> Tidak ada</span>
                                @endif
                            </td>
                            <td style="font-size:0.82rem; color:#64748b;">{{ $skpi->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align:center; color:#94a3b8; padding:40px;">
                                <i class="fa-solid fa-folder-open" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                                Tidak ada data SKPI yang diunggah oleh mahasiswa ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('admin.skpi.index') }}" class="btn-back">Kembali</a>
        </div>
    </main>

</body>
</html>