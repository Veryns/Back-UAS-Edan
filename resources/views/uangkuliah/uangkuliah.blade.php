<h1>Tagihan & Pembayaran</h1>

<p><b>Mahasiswa :</b> {{ $student->name }}({{ $student->student_id }})</p>
<p><b>Semester :</b> {{ $bills->first()->semester ?? '-' }}</p>
<br>
<table border="1" cellpadding="10" style="border-collapse:collapse;">
    <tr style="background-color:#d9d9d9;">
        <th rowspan="2">No</th>
        <th rowspan="2">Jenis</th>
        <th rowspan="2">No. Virtual Account</th>
        <th rowspan="2">Tgl. Batas Bayar</th>
        <th rowspan="2">Jumlah Tagihan</th>
        <th rowspan="2">Rincian</th>
        <th colspan="3">Pembayaran</th>
        <th rowspan="2">Status</th>
    </tr>

    <tr style="background-color:#d9d9d9;">
        <th>Bank</th>
        <th>Tanggal</th>
        <th>Nominal</th>
    </tr>

    @foreach($bills as $index => $bill)
        @php
            $payment = $bill->payments->first();
            $totalBayar = $bill->payments->sum('jumlah_bayar');
            $tanggalDendae = $payment ? $payment->tanggal_bayar : now()->toDateString();
            $denda = $bill->hitungDenda($tanggalDendae);
            $totalRincian = $bill->total_tagihan + $denda;
            $lunas = $totalBayar >= $totalRincian;
        @endphp

        <tr style="background-color:#b7d6d6;">
            <td>{{ $index + 1 }}</td>
            <td>{{ $bill->jenis ?? 'Uang Kuliah semester' }}</td>
            <td>{{ $bill->virtual_account ?? '188885352500' }}</td>
            <td>{{ $bill->deadline ?? '-' }}</td>
            <td>Rp {{ number_format($bill->total_tagihan) }}</td>
            <td>
            {{ $bill->jenis ?? 'Uang Kuliah' }}         : Rp {{ number_format($bill->total_tagihan) }}<br>
            Denda {{ $bill->jenis ?? 'Uang Kuliah' }}   : Rp {{ number_format($denda) }}<br>
            </td>
            <td>{{ $payment->metode ?? 'MANDIRI' }}</td>
            <td>{{ $payment->tanggal_bayar ?? '-' }}</td>
            <td>Rp {{ number_format($totalBayar) }}</td>
            <td>{{ $lunas ? 'LUNAS' : 'BELUM LUNAS' }}</td>
        </tr>
    @endforeach
</table>

<a href="/uang-kuliah/menu?student_id={{ $student->student_id }}">
    <button>Kembali ke Menu Uang Kuliah</button>
</a>