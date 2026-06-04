<h2>Ajukan Dispensasi Baru</h2>

<form method="POST"
      action="/uang-kuliah/dispensasi">

    @csrf

    <select name="bill_id" required>
        @foreach($bills as $bill)
            <option value="{{ $bill->id }}">
                {{ $bill->jenis }}
            </option>
        @endforeach
    </select>

    <br><br>

    <input type="number" name="requested_days" placeholder="Jumlah hari" required>

    <br><br>

    <textarea name="reason" placeholder="Alasan dispensasi" required> </textarea>

    <br><br>

    <button type="submit">
        Ajukan
    </button>

</form>

<h2>Riwayat Pengajuan</h2>

<table border="1">
<tr>
    <th>Jenis</th>
    <th>Hari</th>
    <th>Status</th>
</tr>

@foreach($dispensations as $d)

<tr>
    <td>{{ $d->bill->jenis }}</td>
    <td>{{ $d->requested_days }}</td>
    <td>{{ $d->status }}</td>
</tr>

@endforeach
</table>