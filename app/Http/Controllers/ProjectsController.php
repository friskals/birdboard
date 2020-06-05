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
        $project = auth()->user()->projects()->create(request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]));


        return redirect($project->path());
    }
    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }
        return view('projects.show', [
            'project' => $project
        ]);
    }
}
