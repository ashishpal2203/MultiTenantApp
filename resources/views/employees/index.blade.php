@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employees</h2>
   <div class="text-end"> <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a></div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('employees.index') }}" class="mb-4">
    <div class="row">
        <!-- Department Filter -->
        <div class="col-md-1">
            <label>Department:</label>
            <select name="department" class="form-control">
                <option value="">All</option>
                <option value="IT" {{ request('department') == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="HR" {{ request('department') == 'HR' ? 'selected' : '' }}>HR</option>
                <option value="Finance" {{ request('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
            </select>
        </div>

        <div class="col-md-2">
            <label>Position:</label>
            <input type="text" name="position" class="form-control" placeholder="Search Position" value="{{ request('position') }}">
        </div>

        <div class="col-md-2">
            <label>Min Salary:</label>
            <input type="number" name="min_salary" class="form-control" placeholder="Min Salary" value="{{ request('min_salary') }}">
        </div>

        <div class="col-md-2">
            <label>Max Salary:</label>
            <input type="number" name="max_salary" class="form-control" placeholder="Max Salary" value="{{ request('max_salary') }}">
        </div>

        <div class="col-md-3">
            <label>Search:</label>
            <input type="text" name="search" class="form-control" placeholder="Search by Name or Email" value="{{ request('search') }}">
        </div>

        <div class="col-md-2 text-end">
        <label class="w-100">&nbsp;</label>
            <button type="submit" class="btn btn-primary btn-block">Search</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-block">Reset</a>
        </div>
        
       
    </div>
</form>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($employees->isEmpty())
                <tr>
                    <td colspan="6" class="text-center text-muted fw-bold">No employees found.</td>
                </tr>
            @else
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>₹{{ $employee->salary }}</td>
                        <td>
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        
    </table>
</div>
@endsection
