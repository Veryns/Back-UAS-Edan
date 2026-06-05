@extends('layouts.app')

@section('title', 'Cek Kredensial')

@section('content')

<div class="page-header">
    <h1>Cek Kredensial Login</h1>
</div>

<div class="card">
    <form method="POST" action="{{ route('student.credential') }}">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Cek</button>
        </div>
    </form>

    @isset($student)
    <div style="margin-top:24px; padding-top:20px; border-top:1px solid #e2e8f0;">
        <table class="detail-table">
            <tr>
                <td>Nama</td>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $email }}</td>
            </tr>
        </table>
        <p style="margin-top:12px; font-size:13px; color:#94a3b8;">
            * Untuk password, hubungi admin jika lupa.
        </p>
    </div>
    @endisset
</div>

<div style="margin-top:16px;">
    <a href="{{ route('student.login') }}" class="btn btn-secondary">← Login</a>
</div>

@endsection