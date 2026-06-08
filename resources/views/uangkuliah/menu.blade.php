<!DOCTYPE html>
<html>
<head>
    <title>Uang Kuliah</title>
</head>
<body>

    <h2>Menu Uang Kuliah</h2>

    <form method="GET" action="/uang-kuliah/menu">
        <label>Pilih Mahasiswa:</label>
        <select name="student_id">
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach(\App\Models\Student::all() as $s)
                <option value="{{ $s->student_id }}" {{ request('student_id') == $s->student_id ? 'selected' : '' }}>
                    {{ $s->student_id }} - {{ $s->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Pilih</button>
    </form>

    <br>

    @if(request('student_id'))
        <a href="/uang-kuliah?student_id={{ request('student_id') }}">
            <button>Tagihan & Pembayaran</button>
        </a>

        <br><br>

        <a href="/uang-kuliah/payment-scheme?student_id={{ request('student_id') }}">
            <button>Pilihan Skema Pembayaran</button>
        </a>

        <br><br>

        <a href="/uang-kuliah/dispensasi?student_id={{ request('student_id') }}">
            <button>Dispensasi</button>
        </a>
    @endif

</body>
</html>