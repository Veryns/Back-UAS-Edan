@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<style>
    .dashboard-wrapper {
        padding: 40px;
        background: #f8fafc;
        min-height: 100vh;
        color: #0f172a;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .page-header h1 {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .page-header p {
        color: #475569;
        max-width: 620px;
        line-height: 1.7;
    }

    .actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .btn,
    .btn-secondary,
    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 18px;
        border-radius: 10px;
        border: 1px solid transparent;
        text-decoration: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-secondary {
        background: #64748b;
        border-color: #64748b;
        color: #fff;
    }

    .btn-secondary:hover {
        background: #475569;
        border-color: #475569;
    }

    .btn-primary {
        background: #941b1b;
        border-color: #941b1b;
        color: #fff;
    }

    .btn-primary:hover {
        background: #6e1010;
        border-color: #6e1010;
    }

    .card {
        background: #ffffff;
        padding: 30px;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
        border: 1px solid #e2e8f0;
        max-width: 720px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
        color: #0f172a;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        background: #ffffff;
        color: #0f172a;
        font-size: 0.95rem;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: #941b1b;
        box-shadow: 0 0 0 4px rgba(148, 27, 27, 0.08);
    }

    .message-success,
    .message-error {
        padding: 16px;
        border-radius: 14px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .message-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .message-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .form-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }
</style>

<div class="dashboard-wrapper">
    <div class="page-header">
        <div>
            <h1>Add Student</h1>
            <p>Fill in the student information below to add a new record.</p>
        </div>
        <div class="actions">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    @if (session('success'))
        <div class="message-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="message-error">{{ session('error') }}</div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('students.store') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Name <span style="color:#d00;">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control">
                @error('name')<div class="message-error" style="margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control">
                @error('address')<div class="message-error" style="margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" class="form-control">
                @error('phone_number')<div class="message-error" style="margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="program_studi" class="form-label">Major <span style="color:#d00;">*</span></label>
                <select id="program_studi" name="program_studi" required class="form-select">
                    <option value="" disabled {{ old('program_studi') ? '' : 'selected' }}>Select Major</option>
                    <option value="Sistem Informasi" {{ old('program_studi') == 'Sistem Informasi' ? 'selected' : '' }}>Information Systems</option>
                    <option value="Teknik Informatika" {{ old('program_studi') == 'Teknik Informatika' ? 'selected' : '' }}>Computer Science</option>
                </select>
                @error('program_studi')<div class="message-error" style="margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-control">
                @error('email')<div class="message-error" style="margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" required class="form-control">
                @error('password')<div class="message-error" style="margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection