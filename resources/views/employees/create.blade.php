@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Employee</h2>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary mb-3">Back to Employees</a>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Position:</label>
            <input type="text" name="position" class="form-control" value="{{ old('position') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Department:</label>
            <select name="department" class="form-control">
                <option value="">All</option>
                <option value="IT" {{ old('department', request('department')) == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="HR" {{ old('department', request('department')) == 'HR' ? 'selected' : '' }}>HR</option>
                <option value="Finance" {{ old('department', request('department')) == 'Finance' ? 'selected' : '' }}>Finance</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Salary:</label>
            <input type="number" name="salary" class="form-control" value="{{ old('salary') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Joining Date:</label>
            <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date') }}" required>
        </div>

       <div class="text-end">
       <button type="submit" class="btn btn-success">Save Employee</button>
       </div>
    </form>
</div>
@endsection