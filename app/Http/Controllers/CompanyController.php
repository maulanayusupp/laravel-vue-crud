<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Company\{StoreRequest, UpdateRequest};
use App\Models\Company;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewCompanyNotification;
use Illuminate\Support\Facades\Notification;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::orderBy('created_at', 'desc')->paginate(30);
        return Inertia::render('Companies/Index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Companies/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('/');
            $data['logo'] = env('APP_URL').'/storage/'.$logoPath;
        }

        $company = Company::create($data);

        // Sending email
        try {
            // Send the email notification to an email address (e.g., admin@example.com)
            Notification::route('mail', 'maulanayusupp@gmail.com')->notify(new NewCompanyNotification($company));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return Inertia::render('Companies/Show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return Inertia::render('Companies/Edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Company $company)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::delete($company->logo);
            }

            $logoPath = $request->file('logo')->store('/');
            $data['logo'] = env('APP_URL').'/storage/'.$logoPath;
        }

        $company->update($data);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
