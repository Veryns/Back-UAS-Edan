<h1>Tagihan & Pembayaran</h1>

<table border="1" cellpadding="10">
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Jenis</th>
        <th rowspan="2">No. Virtual Account</th>
        <th rowspan="2">Tgl. Batas Bayar</th>
        <th rowspan="2">Jumlah Tagihan</th>
        <th rowspan="2">Rincian</th>
        <th colspan="3">Pembayaran</th>
        <th rowspan="2">Status</th>
    </tr>

    <tr>
        <th>Bank</th>
        <th>Tanggal</th>
        <th>Nominal</th>
    </tr>

    @foreach($bills as $index => $bill)
        @php
            $payment = $bill->payments->first();
            $totalBayar = $bill->payments->sum('jumlah_bayar');
        @endphp

        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $bill->jenis ?? 'Uang Kuliah semester' }}</td>
            <td>{{ $bill->virtual_account ?? '18888535250087' }}</td>
            <td>{{ $bill->deadline ?? '-' }}</td>
            <td>Rp {{ number_format($bill->total_tagihan) }}</td>
            <td>Rp {{ number_format($bill->total_tagihan) }}</td>
            <td>{{ $payment->metode ?? 'MANDIRI' }}</td>
            <td>{{ $payment->tanggal_bayar ?? '-' }}</td>
            <td>Rp {{ number_format($totalBayar) }}</td>
            <td>{{ $totalBayar >= $bill->total_tagihan ? 'LUNAS' : 'BELUM LUNAS' }}</td>
        </tr>
    @endforeach
</table>

<a href="{{ route('home') }}">
    <button>Kembali</button>
</a>