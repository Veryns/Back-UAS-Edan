@extends('uangkuliah.layout')

@section('content')

<div class="card">
    <h2 style="color:#941b1b;margin-bottom:15px;">
        Tagihan & Pembayaran
    </h2>
    <p>
        <b>Mahasiswa :</b>
        {{ $student->name }}
        ({{ $student->student_id }})
    </p>
    <p>
        <b>Semester :</b>
        {{ $bills->first()->semester ?? '-' }}
    </p>
</div>

<div class="card">
    <table>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Jenis</th>
            <th rowspan="2">Virtual Account</th>
            <th rowspan="2">Deadline</th>
            <th rowspan="2">Tagihan</th>
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
                $tanggalDendae = $payment? $payment->tanggal_bayar: now()->toDateString();
                $denda = $bill->hitungDenda($tanggalDendae);
                $totalRincian = $bill->total_tagihan + $denda;
                $lunas = $totalBayar >= $totalRincian;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $bill->jenis ?? 'Uang Kuliah Semester' }}</td>
                <td>{{ $bill->virtual_account ?? '-' }}</td>
                <td>{{ $bill->deadline ?? '-' }}</td>
                <td>Rp {{ number_format($bill->total_tagihan) }}</td>
                <td>
                    {{ $bill->jenis ?? 'Uang Kuliah' }} : Rp {{ number_format($bill->total_tagihan) }}
                    <br>
                    Denda : Rp {{ number_format($denda) }}
                </td>
                <td>{{ $payment->metode ?? 'MANDIRI' }}</td>
                <td>{{ $payment->tanggal_bayar ?? '-' }}</td>
                <td>Rp {{ number_format($totalBayar) }}</td>
                <td>
                    @if($lunas)
                        <span class="badge approved">
                            LUNAS
                        </span>
                    @else
                        <span class="badge rejected">
                            BELUM LUNAS
                        </span>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>
<a href="/uang-kuliah/menu?student_id={{ $student->student_id }}"class="btn btn-secondary">
    Kembali ke Menu Uang Kuliah
</a>
@endsection