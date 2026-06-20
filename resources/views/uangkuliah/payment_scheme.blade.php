@extends('uangkuliah.layout')

@section('content')

<div class="card">

    <h2 style="color:#941b1b;margin-bottom:15px;">
        Pilihan Skema Pembayaran
    </h2>

    <p>
        <b>Mahasiswa :</b>
        {{ $student->name }}
        ({{ $student->student_id }})
    </p>
    
    <br>
    
    @if($scheme)
        <p>
            <b>Skema Saat Ini :</b>
            @if($scheme->scheme_type == 'FULL')
                <span class="badge approved">
                    FULL PAYMENT
                </span>
            @else
                <span class="badge pending">INSTALLMENT</span>
            @endif
        </p>
        <br>
    @endif
    <form
        method="POST"
        action="/uang-kuliah/payment-scheme?student_id={{ $student->student_id }}">
        @csrf
        <div class="radio-card">
            <input type="radio" name="scheme" value="FULL" required {{ ($scheme && $scheme->scheme_type == 'FULL') ? 'checked' : '' }}>

            <b style="font-size:18px;">FULL PAYMENT</b>
            <br><br>
            BPP : Rp 9.000.000
            <br>
            SKS : Rp 8.000.000
            <br>
            <b>Total : Rp 17.000.000</b>
            <br><br>
            Bayar 1 kali tanpa biaya tambahan
        </div>
        <div class="radio-card">
            <input type="radio" name="scheme" value="INSTALLMENT" {{ ($scheme && $scheme->scheme_type == 'INSTALLMENT') ? 'checked' : '' }}>
            <b style="font-size:18px;">INSTALLMENT </b>
            <br><br>
            BPP Termin 1 (60%) : Rp 5.535.000
            <br>
            BPP Termin 2 (40%) : Rp 3.690.000
            <br>
            SKS Termin 1 (60%) : Rp 4.920.000
            <br>
            SKS Termin 2 (40%) : Rp 3.280.000
            <br><br>
            <b>Total : Rp 17.425.000</b>
            <br>
            Biaya tambahan 2.5%
        </div>
        <button class="btn" type="submit">
            Simpan Perubahan
        </button>
    </form>
</div>
<br>
<a href="/uang-kuliah/menu?student_id={{ $student->student_id }}" class="btn btn-secondary">
    Kembali ke Menu Uang Kuliah
</a>
@endsection