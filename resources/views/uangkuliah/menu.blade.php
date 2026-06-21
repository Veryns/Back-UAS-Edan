@extends('uangkuliah.layout')

@section('content')

<div class="card">
    <h2 style="color:#941b1b;margin-bottom:20px;">
        Menu Uang Kuliah
    </h2>
    {{-- hanya admin yang memilih mahasiswa --}}
    @if(!auth()->guard('student')->check())
    <form method="GET" action="/uang-kuliah/menu">
        <label>
            <b>Pilih Mahasiswa</b>
        </label>
        <select name="student_id">
            <option value="">
                -- Pilih Mahasiswa --
            </option>
            @foreach(\App\Models\Student::all() as $s)
                <option
                    value="{{ $s->student_id }}"
                    {{ request('student_id') == $s->student_id ? 'selected' : '' }}>
                    {{ $s->student_id }}
                    -
                    {{ $s->name }}
                </option>
            @endforeach
        </select>
        <button class="btn" type="submit">
            Pilih
        </button>
    </form>
    @endif
</div>
@if(request('student_id') || auth()->guard('student')->check())
<div class="menu-grid">
    <div class="menu-card">
        <h3>💳 Tagihan & Pembayaran</h3> {{-- windows + . -> ketik di search emoji credit card --}}
        <p>
            Lihat tagihan, virtual account,
            deadline, dan status pembayaran.
        </p>
        <br>
        @if(auth()->guard('student')->check())
            <a class="btn" href="/uang-kuliah">
                Buka Menu
            </a>
        @else
            <a class="btn" href="/uang-kuliah?student_id={{ request('student_id') }}">
                Buka Menu
            </a>
        @endif
    </div>
    <div class="menu-card">
        <h3>📋 Skema Pembayaran</h3> {{-- windows + . -> ketik di search emoji clipboard --}}
        <p>
            Pilih metode pembayaran
            Full Payment atau Installment.
        </p>
        <br>
        @if(auth()->guard('student')->check())
            <a class="btn" href="/uang-kuliah/payment-scheme">
                Buka Menu
            </a>
        @else
            <a class="btn" href="/uang-kuliah/payment-scheme?student_id={{ request('student_id') }}">
                Buka Menu
            </a>
        @endif
    </div>
    <div class="menu-card">
        <h3>⏳ Dispensasi</h3> {{-- windows + . -> ketik di search emoji hourglass --}}
        <p>
            Ajukan perpanjangan
            jatuh tempo pembayaran.
        </p>
        <br>
        @if(auth()->guard('student')->check())
            <a class="btn" href="/uang-kuliah/dispensasi">
                Buka Menu
            </a>
        @else
            <a class="btn" href="/uang-kuliah/dispensasi?student_id={{ request('student_id') }}">
                Buka Menu
            </a>
        @endif
    </div>
</div>
@endif
<br>
<a href="{{ route('home') }}" class="btn btn-secondary">
    Kembali ke Home
</a>
@endsection