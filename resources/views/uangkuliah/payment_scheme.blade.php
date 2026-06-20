<h2>Pilihan Skema Pembayaran</h2>

@if($scheme)
    <p>
        Skema saat ini:
        <b>{{ $scheme->scheme_type }}</b>
    </p>
    <br>
@endif

<form method="POST" action="/uang-kuliah/payment-scheme?student_id={{ $student->student_id }}">
    @csrf

    <input type="radio" name="scheme" value="FULL" required {{ ($scheme && $scheme->scheme_type == 'FULL') ? 'checked' : '' }}>
    <b>FULL PAYMENT</b>
    <br>
    BPP : Rp 9.000.000
    <br>
    SKS : Rp 8.000.000
    <br>
    Total : Rp 17.000.000
    <br>
    Bayar 1 kali tanpa biaya tambahan
    <br><br>

    <input type="radio" name="scheme" value="INSTALLMENT" {{ ($scheme && $scheme->scheme_type == 'INSTALLMENT') ? 'checked' : '' }}>
    <b>INSTALLMENT</b>
    <br>
    BPP Termin 1 (60%) : Rp 5.535.000 &nbsp;— jatuh tempo 30 hari
    <br>
    BPP Termin 2 (40%) : Rp 3.690.000 &nbsp;— jatuh tempo 60 hari
    <br>
    SKS Termin 1 (60%) : Rp 4.920.000 &nbsp;— jatuh tempo 90 hari
    <br>
    SKS Termin 2 (40%) : Rp 3.280.000 &nbsp;— jatuh tempo 120 hari
    <br>
    Total : Rp 17.425.000
    <br>
    Biaya tambahan 2.5%
    <br><br>

    <button type="submit">
        Simpan Perubahan
    </button>
</form>

<a href="/uang-kuliah/menu?student_id={{ $student->student_id }}">
    <button>Kembali ke Menu Uang Kuliah</button>
</a>