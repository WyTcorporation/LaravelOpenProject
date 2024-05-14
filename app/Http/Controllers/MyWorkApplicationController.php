<?php

namespace App\Http\Controllers;

use App\Models\WorkApplication;
use Illuminate\Http\Request;

class MyWorkApplicationController extends Controller
{
    public function index()
    {
        $applications = auth()->user()->workApplications()
            ->with([
                'work' => fn($query) => $query->withCount('workApplications')
                    ->withAvg('workApplications', 'expected_salary'),
                'work.employer'
            ])
            ->latest()->get();
        return view('my_work_application.index', compact('applications'));
    }

    public function destroy(WorkApplication $application)
    {
        $application->delete();
        return redirect()->back()->with(
            'success',
            'Work application removed.'
        );
    }
}
