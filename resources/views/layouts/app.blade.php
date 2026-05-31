<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mahasiswa')</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --dark: #1a1a2e;
            --blue: #4f8ef7;
            --border: #e2e8f0;
            --muted: #64748b;
            --bg: #f4f6f9;
        }

        body { font-family: 'Segoe UI', sans-serif; background: var(--bg); color: var(--dark); min-height: 100vh; }

        /* navbar */
        nav { background: var(--dark); padding: 0 32px; display: flex; align-items: center; height: 56px; }
        nav a { color: #fff; font-weight: 700; font-size: 16px; text-decoration: none; }
        nav a span { color: var(--blue); }

        /* Layout */
        .container { max-width: 900px; margin: 36px auto; padding: 0 20px; }
        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .page-header h1 { font-size: 22px; font-weight: 700; }

        /* Card */
        .card { background: #fff; border-radius: 8px; border: 1px solid var(--border); padding: 28px 32px; }

        /* Alert */
        .alert { padding: 10px 14px; border-radius: 6px; margin-bottom: 18px; font-size: 14px; }
        .alert-success { background: #ecfdf5; border: 1px solid #6ee7b7; color: #065f46; }
        .alert-error   { background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; }

        /* Button */
        .btn { display: inline-block; padding: 8px 18px; border-radius: 5px; font-size: 14px; font-weight: 600; text-decoration: none; cursor: pointer; border: none; transition: opacity 0.15s; }
        .btn:hover { opacity: 0.85; }
        .btn-primary   { background: var(--dark); color: #fff; }
        .btn-secondary { background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; }
        .btn-danger    { background: #fff; color: #dc2626; border: 1px solid #fca5a5; }
        .btn-danger:hover { background: #fef2f2; opacity: 1; }
        .btn-sm { padding: 5px 12px; font-size: 13px; }

        /* FORM */
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.4px; }
        .form-group input[type="text"] { width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 5px; font-size: 14px; color: var(--dark); background: #f8fafc; transition: border-color 0.15s, box-shadow 0.15s; }
        .form-group input[type="text"]:focus { outline: none; border-color: var(--blue); box-shadow: 0 0 0 3px rgba(79,142,247,0.12); background: #fff; }
        .form-error { font-size: 12px; color: #dc2626; margin-top: 4px; }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        thead tr { border-bottom: 2px solid var(--border); }
        thead th { padding: 10px 12px; text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted); font-weight: 600; }
        tbody tr { border-bottom: 1px solid #f1f5f9; transition: background 0.1s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f8fafc; }
        tbody td { padding: 11px 12px; color: #334155; vertical-align: middle; }

        /* Detail Table */
        .detail-table { width: 100%; border-collapse: collapse; }
        .detail-table tr { border-bottom: 1px solid #f1f5f9; }
        .detail-table tr:last-child { border-bottom: none; }
        .detail-table td { padding: 12px 4px; font-size: 14px; }
        .detail-table td:first-child { width: 140px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px; color: #94a3b8; }
        .detail-table td:last-child { color: var(--dark); }

        /* other stuff idk what to title */
        a.link { color: var(--blue); text-decoration: none; font-size: 13px; }
        a.link:hover { text-decoration: underline; }
        .form-actions { display: flex; gap: 10px; margin-top: 24px; }
        .empty { text-align: center; padding: 40px 0; color: #94a3b8; font-size: 14px; }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('students.index') }}">Data<span>Mahasiswa</span></a>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>