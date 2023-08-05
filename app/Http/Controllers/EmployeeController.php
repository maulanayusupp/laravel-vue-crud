<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Employee\{StoreRequest, UpdateRequest};
use App\Models\Employee;
use App\Models\Company;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')
            ->with('company')
            ->paginate(30);
        return Inertia::render('Employees/Index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('created_at', 'desc')->get();
        return Inertia::render('Employees/Create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Employee::create($data);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $companies = Company::orderBy('created_at', 'desc')->get();
        return Inertia::render('Employees/Show', compact('employee', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::orderBy('created_at', 'desc')->get();
        return Inertia::render('Employees/Edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Employee $employee)
    {
        $data = $request->validated();

        $employee->update($data);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
