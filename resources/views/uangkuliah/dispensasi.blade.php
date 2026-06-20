@extends('uangkuliah.layout')

@section('content')

<div class="card">
    <h2 style="color:#941b1b;margin-bottom:15px;">
        Ajukan Dispensasi Baru
    </h2>
    <p>
        <b>Mahasiswa :</b>
        {{ $student->name }}
        ({{ $student->student_id }})
    </p>
    <br>
    <form method="POST" action="/uang-kuliah/dispensasi">
        @csrf
        <input type="hidden" name="student_id" value="{{ $student->student_id }}">
        <label>
            <b>Pilih Tagihan</b>
        </label>
        <select name="bill_id" required>
            @foreach($bills as $bill)
                <option value="{{ $bill->id }}">
                    {{ $bill->jenis }} | Deadline : {{ $bill->deadline }}
                </option>
            @endforeach
        </select>
        <label>
            <b>Perpanjangan (Hari)</b>
        </label>
        <input type="number" name="extension_days" placeholder="Masukkan jumlah hari" required>
        <label>
            <b>Alasan Dispensasi</b>
        </label>
        <textarea name="reason" placeholder="Masukkan alasan pengajuan dispensasi" required></textarea>
        <button class="btn" type="submit">
            Ajukan Dispensasi
        </button>
    </form>
</div>
<div class="card">
    <h2 style="color:#941b1b;margin-bottom:15px;">
        Riwayat Pengajuan
    </h2>
    <table>
        <tr>
            <th>Jenis Tagihan</th>
            <th>Perpanjangan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach($dispensations as $d)
        <tr>
            <td>{{ $d->bill ? $d->bill->jenis : 'Tagihan Sudah Dihapus' }}</td>
            <td>{{ $d->extension_days }} Hari</td>
            <td>
                @if($d->status == 'Pending')
                    <span class="badge pending">
                        Pending
                    </span>
                @elseif($d->status == 'Approved')
                    <span class="badge approved">
                        Approved
                    </span>
                @else
                    <span class="badge rejected">
                        Rejected
                    </span>
                @endif
            </td>
            <td>
                @if($d->status === 'Pending')
                    <form
                        action="/uang-kuliah/dispensasi/{{ $d->id }}/approve"
                        method="POST"
                        style="display:inline">
                        @csrf
                        <button class="btn">
                            Approve
                        </button>
                    </form>
                    <form
                        action="/uang-kuliah/dispensasi/{{ $d->id }}/reject"
                        method="POST"
                        style="display:inline">
                        @csrf
                        <button class="btn btn-secondary">
                            Reject
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
<a href="/uang-kuliah/menu?student_id={{ $student->student_id }}" class="btn btn-secondary">
    Kembali ke Menu Uang Kuliah
</a>
@endsection