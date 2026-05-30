<h2>Pilihan Skema Pembayaran</h2>

<form method="POST" action="/uang-kuliah/payment-scheme">
    @csrf

    <input
        type="radio"
        name="scheme"
        value="FULL"
        required
    >
    Full Payment

    <br><br>

    <input
        type="radio"
        name="scheme"
        value="INSTALLMENT"
    >
    Cicilan 2 Termin

    <br><br>

    <button type="submit">
        Simpan
    </button>
</form>