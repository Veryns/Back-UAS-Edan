<h2>Pilihan Skema Pembayaran</h2>


@if($scheme)
    <p>
        Skema saat ini:
        <b>{{ $scheme->scheme_type }}</b>
    </p>
    <br>
@endif

<form method="POST" action="/uang-kuliah/payment-scheme">
    @csrf
    
    <input type="radio" name="scheme" value="FULL" required  {{ ($scheme && $scheme->scheme_type == 'FULL') ? 'checked' : '' }}>
    <b>FULL PAYMENT</b>

    <br>
    Total Tagihan : Rp 9.000.000
    <br>
    Bayar 1 kali tanpa biaya tambahan
    <br><br>

    <input type="radio" name="scheme" value="INSTALLMENT" {{ ($scheme && $scheme->scheme_type == 'INSTALLMENT') ? 'checked' : '' }}>
    <b>TERMIN</b>

    <br>
    Termin 1 : Rp 5.535.000
    <br>
    Termin 2 : Rp 3.690.000
    <br>
    Total : Rp 9.225.000
    <br>
    Biaya tambahan 2.5%
    <br><br>

    <button type="submit">
        Simpan Perubahan
    </button>
</form>