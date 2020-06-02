<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return view('projects.index')->with('projects', Project::all());
    }
    public function store()
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Project::create(request(['title', 'description']));
        return redirect('/projects');
    }
    public function show(Project $project)
    {
        return view('projects.show')->with('project', $project);
    }
}
