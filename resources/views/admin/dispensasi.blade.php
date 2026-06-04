<table border="1">

<tr>
    <th>Mahasiswa</th>
    <th>Tagihan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($dispensations as $d)

<tr>

<td>{{ $d->student_id }}</td>

<td>{{ $d->bill->jenis }}</td>

<td>{{ $d->status }}</td>

<td>

<form action="/admin/dispensasi/{{ $d->id }}/approve"
      method="POST">

    @csrf

    <input type="number"
           name="extension_days"
           placeholder="Hari">

    <button>
        ACC
    </button>

</form>

<form action="/admin/dispensasi/{{ $d->id }}/reject"
      method="POST">

    @csrf

    <button>
        Reject
    </button>

</form>

</td>

</tr>

@endforeach
</table>