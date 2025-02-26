<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index(Request $request)
{
    $query = new Employee(); 
    
    if ($request->filled('department')) {
        $query = $query->where('department', $request->department);
    }

    if ($request->filled('position')) {
        $query = $query->where('position', 'LIKE', "%{$request->position}%");
    }

    if ($request->filled('min_salary')) {
        $query = $query->where('salary', '>=', $request->min_salary);
    }

    if ($request->filled('max_salary')) {
        $query = $query->where('salary', '<=', $request->max_salary);
    }

    if ($request->filled('search')) {
        $query = $query->where(function ($q) use ($request) {
            $q->where('name', 'LIKE', "%{$request->search}%")
              ->orWhere('email', 'LIKE', "%{$request->search}%");
        });
    }

    $employees = $query->paginate(10);

    return view('employees.index', compact('employees'));
}

    

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees_' . Auth::user()->tenant_id . ',email',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
        ]);

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'department' => $request->department,
            'salary' => $request->salary,
            'joining_date' => $request->joining_date,
        ]);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }


    public function edit($id)
    {
        $employee = Employee::where('id', $id)->firstOrFail();
        return view('employees.edit', compact('employee'));
    }


    public function update(Request $request, Employee $employee)
    {
      
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
        ]);


        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->firstOrFail();
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
