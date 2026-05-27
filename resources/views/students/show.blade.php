<h1>Detail Mahasiswa</h1>
 
<p><strong>NIM:</strong> {{ $student->student_id }}</p>
<p><strong>Nama:</strong> {{ $student->name }}</p>
<p><strong>Alamat:</strong> {{ $student->address ?? '-' }}</p>
<p><strong>No. Telepon:</strong> {{ $student->phone_number ?? '-' }}</p>
 
<a href="{{ route('students.edit', $student->student_id) }}">Ubah</a>
&nbsp;|&nbsp;
<a href="{{ route('students.index') }}">Kembali</a>