@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Reports</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Department</th>
                <th>Total Employees</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employeesPerDepartment as $report)
            <tr>
                <td>{{ $report->department }}</td>
                <td>{{ $report->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
    <h4>Average Salary: ₹{{ number_format($averageSalary, 2) }}</h4>
    <div class="">
        <a href="{{ route('reports.export.csv') }}" class="btn btn-success">Export as CSV</a>
        <a href="{{ route('reports.export.pdf') }}" class="btn btn-danger">Export as PDF</a>
    </div>
    </div>
</div>
@endsection