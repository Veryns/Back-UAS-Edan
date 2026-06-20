@extends('layouts.app')

@section('title', 'Edit Student')

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

    .detail-grid {
        display: grid;
        grid-template-columns: minmax(140px, 220px) 1fr;
        gap: 14px 24px;
        align-items: center;
        margin-bottom: 24px;
    }

    .detail-grid strong {
        color: #0f172a;
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

    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        background: #ffffff;
        color: #0f172a;
        font-size: 0.95rem;
    }

    .form-control:focus {
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
            <h1>Edit Student</h1>
            <p>Update the student's address and phone number.</p>
        </div>
        <div class="actions">
            <a href="{{ route('students.show', $student->student_id) }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    @if (session('success'))
        <div class="message-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="message-error">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="detail-grid">
            <strong>Name</strong>
            <span>{{ $student->name }}</span>

            <strong>Student ID</strong>
            <span>{{ $student->student_id }}</span>

            <strong>Major</strong>
            <span>{{ $student->program_studi ?? '-' }}</span>
        </div>

        <form method="POST" action="{{ route('students.update', $student->student_id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address', $student->address) }}" class="form-control">
                @error('address')<div class="message-error" style="margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" class="form-control">
                @error('phone_number')<div class="message-error" style="margin-top:8px; font-weight:500;">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('students.show', $student->student_id) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection