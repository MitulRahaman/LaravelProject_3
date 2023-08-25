<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Problem;
use App\Http\Requests\StoreProblemRequest;
use App\Http\Requests\UpdateProblemRequest;
use App\Notifications\ProblemUpdateNotification;
use Illuminate\Support\facades\Storage;
use Illuminate\Support\Str;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $problems = $user->isAdmin ? Problem::latest()->get() : $user->problems;
        return view('problem.index', compact('problems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('problem.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProblemRequest $request)
    {
        $problem = Problem::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        if($request->file('attachment'))
        {
            $ext = $request->file('attachment')->extension();
            $content = file_get_contents($request->file('attachment'));
            $filename = Str::random(25);
            $path = "attachments/$filename.$ext";

            Storage::disk('public')->put($path, $content);
            $problem->update(['attachment'=> $path]);
        }

        return redirect(route('problem.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Problem $problem)
    {
        return view('problem.show', compact('problem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Problem $problem)
    {
        return view('problem.edit', compact('problem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProblemRequest $request, Problem $problem)
    {
        $problem->update($request->except('attachment'));
        
        if($request->has('status'))
        {
            $problem->user->notify(new ProblemUpdateNotification($problem));
        }

        if($request->file('attachment'))
        {
            Storage::disk('public')->delete($problem->attachment);
            $ext = $request->file('attachment')->extension();
            $content = file_get_contents($request->file('attachment'));
            $filename = Str::random(25);
            $path = "attachments/$filename.$ext";

            Storage::disk('public')->put($path, $content);
            $problem->update(['attachment'=> $path]);
        }
        
        return redirect(route('problem.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Problem $problem)
    {
        $problem->delete();
        return redirect(route('problem.index'));
    }
}
