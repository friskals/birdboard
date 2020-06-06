<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()

    {
        $projects =  auth()->user()->projects;
        return view('projects.index')->with('projects', $projects);
    }
    public function create()
    {
        return view('projects.create');
    }
    public function store()
    {
        $attribute = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);
        $project = auth()->user()->projects()->create($attribute);


        return redirect($project->path());
    }
    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', [
            'project' => $project
        ]);
    }
    public function edit(Project $project)
    {
        return view('projects.create', compact('project'));
    }
    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $attribute = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);
        $project->update($attribute);

        return redirect($project->path());
    }
}
