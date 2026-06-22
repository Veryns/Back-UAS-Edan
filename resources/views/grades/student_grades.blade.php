@if(!$grades->isEmpty())
    <h1>Nilai Student {{ $grades->first()->student_id }}</h1>
@else
    <h1>Nilai Student</h1>
@endif

<a href="{{ route('home') }}">Kembali ke Home</a>

<br><br>

@if ($grades->isEmpty())

    <p>Tidak ada nilai untuk student ini.</p>

@else

<table border="1" cellpadding="5" cellspacing="0">

    <thead>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Student ID</th>
            <th>Matkul ID</th>
            <th>Tipe</th>
            <th>Nilai</th>
            <th>IPK</th>
        </tr>
    </thead>

    <tbody>

        @foreach ($grades as $grade)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>
                    <a href="{{ route('grades.show', $grade->id) }}">
                        {{ $grade->id }}
                    </a>
                </td>

                <td>{{ $grade->student_id }}</td>

                <td>{{ $grade->matkul_id }}</td>

                <td>{{ $grade->type }}</td>

                <td>{{ $grade->grade }}</td>

                @php
                $key = $grade->student_id . '-' . $grade->matkul_id;
                @endphp

                <td>
                    @if(isset($ipkData[$key]) && $ipkData[$key] !== null)
                        {{ number_format($ipkData[$key], 2) }}
                    @endif
                </td>

            </tr>

        @endforeach

    </tbody>

</table>

@endif