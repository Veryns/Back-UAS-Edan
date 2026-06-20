<!DOCTYPE html>
<html>
<head>
    <title>Modul Uang Kuliah</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Plus Jakarta Sans',sans-serif;
        }

        body{
            background:#f1f5f9;
        }

        .navbar{
            background:#a31217;
            color:white;
            padding:18px 30px;
            font-size:22px;
            font-weight:700;
            box-shadow:0 2px 10px rgba(0,0,0,.15);
        }

        .container{
            width:90%;
            max-width:1100px;
            margin:25px auto;
        }

        .card{
            background:white;
            border-radius:16px;
            padding:24px;
            margin-bottom:20px;
            box-shadow:0 4px 12px rgba(0,0,0,.08);
        }

        h1,h2,h3{
            color:#a31217;
        }

        p{
            line-height:1.8;
        }

        .btn{
            background:#a31217;
            color:white;
            border:none;
            padding:10px 18px;
            border-radius:8px;
            cursor:pointer;
            text-decoration:none;
            display:inline-block;
            transition:.25s;
            font-weight:500;
        }

        .btn:hover{
            background:#841014;
            transform:translateY(-1px);
        }

        .btn-secondary{
            background:#64748b;
        }

        .btn-secondary:hover{
            background:#475569;
        }

        .menu-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
        }

        .menu-card{
            background:white;
            border-radius:16px;
            padding:24px;
            box-shadow:0 4px 12px rgba(0,0,0,.08);
            transition:.3s;
        }

        .menu-card:hover{
            transform:translateY(-4px);
        }

        .menu-card h3{
            margin-bottom:10px;
        }


        /* TABLE */
        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
            background:white;
            border:1px solid #94a3b8;
        }

        table th{
            background:#a31217;
            color:white;
            padding:14px;
            text-align:center;
            border:1px solid #94a3b8;
            font-weight:600;
        }

        table td{
            padding:14px;
            text-align:center;
            vertical-align:middle;
            border:1px solid #94a3b8;
        }

        table tr:nth-child(even){
            background:#f8fafc;
        }

        table tr:hover{
            background:#eef2ff;
        }

        /* BADGE */
        .badge{
            padding:8px 16px;
            border-radius:999px;
            font-size:13px;
            font-weight:600;
            display:inline-block;
        }

        .pending{
            background:#fef3c7;
            color:#92400e;
        }

        .approved{
            background:#dcfce7;
            color:#166534;
        }

        .rejected{
            background:#fee2e2;
            color:#991b1b;
        }

        /* RADIO CARD */
        .radio-card{
            border:2px solid #e5e7eb;
            background:#fafafa;
            border-radius:12px;
            padding:20px;
            margin-bottom:16px;
            transition:.25s;
            box-shadow:0 2px 8px rgba(0,0,0,.05);
        }

        .radio-card:hover{
            border-color:#a31217;
            transform:translateY(-2px);
        }

        .radio-card input[type="radio"]{
            margin-right:10px;
            transform:scale(1.15);
        }

        /* FORM */
        input[type=text],
        input[type=number],
        textarea,
        select{
            width:100%;
            padding:12px;
            border:1px solid #d1d5db;
            border-radius:8px;
            margin-top:8px;
            margin-bottom:15px;
            font-size:14px;
        }

        input:focus,
        textarea:focus,
        select:focus{
            outline:none;
            border-color:#a31217;
        }

        textarea{
            resize:none;
            height:90px;
        }

        label{
            font-weight:600;
        }

    </style>
</head>

<body>

    <div class="navbar">
        Sistem Uang Kuliah
    </div>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>