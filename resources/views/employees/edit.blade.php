@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Employee</h2>
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

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
        </div>

        <div class="form-group">
            <label>Position:</label>
            <input type="text" name="position" class="form-control" value="{{ $employee->position }}" required>
        </div>

        <div class="form-group">
            <label>Department:</label>
            <select name="department" class="form-control">
                <option value="">Select Department</option>
                <option value="IT" {{ old('department', $employee->department) == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="HR" {{ old('department', $employee->department) == 'HR' ? 'selected' : '' }}>HR</option>
                <option value="Finance" {{ old('department', $employee->department) == 'Finance' ? 'selected' : '' }}>Finance</option>
            </select>
        </div>

        <div class="form-group">
            <label>Salary:</label>
            <input type="number" name="salary" class="form-control" value="{{ $employee->salary }}" required>
        </div>

        <div class="form-group">
            <label>Joining Date:</label>
            <input type="date" name="joining_date" class="form-control" value="{{ $employee->joining_date }}" required>
        </div>

      <div class="text-end">
      <button type="submit" class="btn btn-success mt-3">Update Employee</button>
      </div>
    </form>
</div>
@endsection