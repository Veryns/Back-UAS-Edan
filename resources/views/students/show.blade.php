@extends('layouts.app')

@section('title', 'Student Profile')

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
    .btn-primary,
    .btn-danger {
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

    .btn-danger {
        background: #dc2626;
        border-color: #dc2626;
        color: #fff;
    }

    .btn-danger:hover {
        background: #b91c1c;
        border-color: #b91c1c;
    }

    .card {
        background: #ffffff;
        padding: 30px;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
        border: 1px solid #e2e8f0;
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

    .form-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }
</style>

<div class="dashboard-wrapper">
    <div class="page-header">
        <div>
            <h1>Student Profile</h1>
            <p>View student details and use the actions to edit or delete the record.</p>
        </div>
        <div class="actions">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-primary">Edit Student</a>
            <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this student?')">Delete</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="detail-grid">
            <strong>Student ID</strong>
            <span>{{ $student->student_id }}</span>

            <strong>Name</strong>
            <span>{{ $student->name }}</span>

            <strong>Major</strong>
            <span>{{ $student->program_studi ?? '-' }}</span>

            <strong>Address</strong>
            <span>{{ $student->address ?? '-' }}</span>

            <strong>Phone Number</strong>
            <span>{{ $student->phone_number ?? '-' }}</span>
        </div>
    </div>
</div>

@endsection