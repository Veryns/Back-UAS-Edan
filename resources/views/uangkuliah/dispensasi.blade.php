<h2>Ajukan Dispensasi Baru</h2>

<p>
    <b>Mahasiswa:</b>
    {{ $student->name }}
    ({{ $student->student_id }})
</p>

<form method="POST" action="/uang-kuliah/dispensasi">

    @csrf

    <input
        type="hidden"
        name="student_id"
        value="{{ $student->student_id }}">

    <select name="bill_id" required>

        @foreach($bills as $bill)

            <option value="{{ $bill->id }}">
                {{ $bill->jenis }}
                |
                Deadline:
                {{ $bill->deadline }}
            </option>

        @endforeach

    </select>

    <br><br>

    <input
        type="number"
        name="extension_days"
        placeholder="Jumlah hari"
        required>

    <br><br>

    <textarea
        name="reason"
        placeholder="Alasan dispensasi"
        required></textarea>

    <br><br>

    <button type="submit">
        Ajukan
    </button>

</form>

<br><br>

<h2>Riwayat Pengajuan</h2>

<table border="1">

<tr>
    <th>Jenis</th>
    <th>Hari</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($dispensations as $d)

<tr>

    <td>{{ $d->bill ? $d->bill->jenis : 'Tagihan Sudah Dihapus' }}</td>
    <td>{{ $d->extension_days }}</td>
    <td>{{ $d->status }}</td>

    <td>

        @if($d->status === 'Pending')
            <form
                action="/uang-kuliah/dispensasi/{{ $d->id }}/approve"
                method="POST"
                style="display:inline">

                @csrf

                <button>
                    Approve
                </button>

            </form>

            <form
                action="/uang-kuliah/dispensasi/{{ $d->id }}/reject"
                method="POST"
                style="display:inline">

                @csrf

                <button>
                    Reject
                </button>

            </form>

        @endif

    </td>

</tr>

@endforeach

</table>

<br><br>

<a href="/uang-kuliah/menu?student_id={{ $student->student_id }}">
    <button>Kembali ke Menu Uang Kuliah</button>
</a>