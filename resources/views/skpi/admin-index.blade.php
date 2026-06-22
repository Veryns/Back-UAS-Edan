<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar SKPI Mahasiswa - LINTAR UNTAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            min-height: 100vh;
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
        }

        /* --- TOP NAVIGATION BAR --- */
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .brand-area {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-area img {
            height: 46px;
            width: auto;
        }

        .brand-text h3 {
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .brand-text p {
            font-size: 0.75rem;
            color: #ffcc00;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .user-greeting {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
        }

        .user-greeting i {
            color: #ffcc00;
            font-size: 1.2rem;
        }

        .btn-logout {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background-color: #ffffff;
            color: #941b1b;
            border-color: #ffffff;
        }

        /* --- MAIN CONTENT AREA (FULL WIDTH) --- */
        .content-body {
            padding: 40px;
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
            flex-grow: 1;
        }

        .table-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 25px rgba(0,0,0,0.02);
            border: 1px solid #f1f5f9;
            border-top: 6px solid #941b1b;
        }

        .table-card h1 {
            color: #941b1b;
            font-size: 1.7rem;
            font-weight: 800;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Search Bar */
        .search-wrapper { margin-bottom: 28px; }

        .search-form {
            display: flex;
            align-items: center;
            gap: 0;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            overflow: hidden;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            max-width: 520px;
        }

        .search-form:focus-within {
            border-color: #941b1b;
            box-shadow: 0 0 0 3px rgba(148, 27, 27, 0.1);
        }

        .search-icon { padding: 0 16px; color: #94a3b8; font-size: 1rem; flex-shrink: 0; }

        .search-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 14px 0;
            font-size: 0.95rem;
            color: #334155;
            background: transparent;
            font-weight: 500;
        }

        .search-input::placeholder { color: #94a3b8; }

        .search-btn {
            padding: 14px 24px;
            background-color: #941b1b;
            color: #ffffff;
            border: none;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-btn:hover { background-color: #6e1010; }

        .search-clear {
            padding: 0 12px;
            color: #94a3b8;
            font-size: 0.85rem;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: color 0.2s;
            flex-shrink: 0;
        }

        .search-clear:hover { color: #475569; }

        .search-result-info { margin-top: 10px; font-size: 0.85rem; color: #64748b; font-weight: 500; }
        .search-result-info span { color: #941b1b; font-weight: 700; }

        .table-responsive { width: 100%; overflow-x: auto; margin-bottom: 20px; }

        .custom-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem; }

        .custom-table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            padding: 16px;
            border-bottom: 2px solid #e2e8f0;
        }

        .custom-table td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-weight: 500;
        }

        .custom-table tr:hover { background-color: #f8fafc; }

        .badge-count {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .btn-action {
            background-color: #941b1b;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-action:hover { background-color: #6e1010; }

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

        .btn-back:hover { background-color: #cbd5e1; color: #1e293b; }

        .pagination-wrapper { margin-top: 20px; }
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
        <div class="table-card">
            <h1><i class="fa-solid fa-folder-open"></i> Daftar SKPI Mahasiswa</h1>

            {{-- Search Bar --}}
            <div class="search-wrapper">
                <form method="GET" action="{{ route('admin.skpi.index') }}" class="search-form">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input
                        type="text"
                        name="nim"
                        class="search-input"
                        placeholder="Masukkan NIM Mahasiswa yang valid"
                        value="{{ request('nim') }}"
                        autocomplete="off"
                    >
                    @if(request('nim'))
                        <a href="{{ route('admin.skpi.index') }}" class="search-clear">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                    <button type="submit" class="search-btn">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                </form>

                @if(request('nim'))
                    <p class="search-result-info">
                        Menampilkan hasil untuk NIM: <span>{{ request('nim') }}</span>
                        - <span>{{ $students->total() }}</span> mahasiswa
                    </p>
                @endif
            </div>
            
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jumlah SKPI</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>
                                <span class="badge-count">{{ $student->skpis->count() }} Dokumen</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.skpi.show', $student->student_id) }}" class="btn-action">
                                    <i class="fa-solid fa-eye"></i> Lihat SKPI
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:#94a3b8; padding:40px;">
                                <i class="fa-solid fa-inbox" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                                @if(request('nim'))
                                    Tidak ditemukan mahasiswa dengan NIM <strong>{{ request('nim') }}</strong>.
                                @else
                                    Belum ada mahasiswa yang upload SKPI.
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $students->links() }}
            </div>

            <a href="{{ route('home') }}" class="btn-back">Kembali</a>
        </div>
    </main>

</body>
</html>