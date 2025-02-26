<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmployeeApiController extends Controller
{
    public function index()
    {
        $employees = Employee::get();
        return response()->json($employees);
    }

    public function store(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email',
        'position' => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'salary' => 'required|numeric|min:0',
        'joining_date' => 'required|date_format:d-m-Y', 
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Convert date format from "DD-MM-YYYY" to "YYYY-MM-DD"
    $formattedDate = Carbon::createFromFormat('d-m-Y', $request->joining_date)->format('Y-m-d');

    $employee = Employee::create([
        'name' => $request->name,
        'email' => $request->email,
        'position' => $request->position,
        'department' => $request->department,
        'salary' => $request->salary,
        'joining_date' => $formattedDate, // Store in correct format
    ]);

    return response()->json(['message' => 'Employee created successfully', 'employee' => $employee], 201);
}
    public function show($id)
    {
        $employee = Employee::where('id', $id)->firstOrFail();

        return response()->json($employee);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::where('id', $id)
            ->firstOrFail();
    
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date_format:d-m-Y', // Validate DD-MM-YYYY input
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Convert date format before updating
        $formattedDate = Carbon::createFromFormat('d-m-Y', $request->joining_date)->format('Y-m-d');
    
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'department' => $request->department,
            'salary' => $request->salary,
            'joining_date' => $formattedDate, // Store in correct format
        ]);
    
        return response()->json(['message' => 'Employee updated successfully', 'employee' => $employee], 200);
    }

    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->firstOrFail();

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
