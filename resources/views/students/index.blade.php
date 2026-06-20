@extends('layouts.app')

@section('title', 'Student List')

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

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
        color: #334155;
    }

    .table-custom th,
    .table-custom td {
        padding: 16px 14px;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    .table-custom th {
        background: #f8fafc;
        color: #0f172a;
        text-align: left;
        font-weight: 700;
    }

    .table-custom tbody tr:hover {
        background: #f1f5f9;
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

    .table-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .table-actions form {
        display: inline;
    }
</style>

<div class="dashboard-wrapper">
    <div class="page-header">
        <div>
            <h1>Student List</h1>
            <p>Manage student data quickly and view full details for each entry.</p>
        </div>
        <div class="actions">
            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
        </div>
    </div>

    @if (session('success'))
        <div class="message-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="message-error">{{ session('error') }}</div>
    @endif

    <div class="card">
        @if ($students->isEmpty())
            <div class="message-error" style="background:#f8fafc; border-color:#cbd5e1; color:#475569;">No students have been saved yet.</div>
        @else
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Major</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('students.show', $student->student_id) }}">{{ $student->student_id }}</a></td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->program_studi ?? '-' }}</td>
                            <td>{{ $student->address ?? '-' }}</td>
                            <td>{{ $student->phone_number ?? '-' }}</td>
                            <td class="table-actions">
                                <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-primary" style="padding:8px 12px;font-size:0.9rem;">Edit</a>
                                <form action="{{ route('students.destroy', $student->student_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding:8px 12px;font-size:0.9rem;" onclick="return confirm('Delete this student?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection