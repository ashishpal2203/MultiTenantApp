<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use Illuminate\Http\Request;
use App\Models\Employee;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        // Fetch report data
        $employeesPerDepartment = Employee::selectRaw('department, COUNT(*) as total')
            ->groupBy('department')
            ->get();

        $averageSalary = Employee::avg('salary');

        return view('reports.index', compact('employeesPerDepartment', 'averageSalary'));
    }

    public function exportCSV()
    {
        $employees = Employee::all();
        $filename = "employees_report.csv";

        return Excel::download(new EmployeesExport, $filename);
    }

    public function exportPDF()
    {
        $employees = Employee::all();
        $pdf = PDF::loadView('reports.pdf', compact('employees'));

        return $pdf->download('employees_report.pdf');
    }
}
