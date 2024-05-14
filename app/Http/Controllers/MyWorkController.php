<?php
namespace App\Http\Controllers;

use App\Http\Requests\WorkRequest;
use App\Models\Work;
use Illuminate\Http\Request;

class MyWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAnyEmployer', Work::class);
        return view(
            'my_work.index',
            [
                'works' => auth()->user()->employer
                    ->works()
                    ->with(['employer', 'workApplications', 'workApplications.user'])
                    ->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Work::class);
        return view('my_work.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkRequest $request)
    {
        $this->authorize('create', Work::class);
        auth()->user()->employer->works()->create($request->validated());

        return redirect()->route('my-work.index')
            ->with('success', 'Job created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $myWork)
    {
        $this->authorize('update', $myWork);
        return view('my_work.edit', ['work' => $myWork]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkRequest $request, Work $myWork)
    {
        $this->authorize('update', $myWork);
        $myWork->update($request->validated());

        return redirect()->route('my-work.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $myWork)
    {
        $myWork->delete();
        return redirect()->route('my-work.index')
            ->with('success', 'Job deleted.');
    }
}
