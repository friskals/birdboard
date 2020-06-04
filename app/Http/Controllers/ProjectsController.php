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
        auth()->user()->projects()->create(request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]));


        return redirect('/projects');
    }
    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }
        return view('projects.show')->with('project', $project);
    }
}
