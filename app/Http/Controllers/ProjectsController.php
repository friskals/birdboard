<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    public function index()

    {
        $projects =  auth()->user()->accessibleProjects();

        return view('projects.index')->with('projects', $projects);
    }
    public function create()
    {
        return view('projects.create');
    }
    public function store()
    {
        $project = auth()->user()->projects()->create($this->validateRequest());

        if (request()->wantsJson()) {
            return ['message' => $project->path()];
        }
        if ($tasks = request('tasks')) {
            $project->addTasks($tasks);
        }
        return redirect($project->path());
    }
    public function destroy(Project $project)
    {
        $this->authorize('manage', $project);

        $project->delete();

        return redirect('/projects');
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
        return view('projects.edit', compact('project'));
    }
    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validateRequest());

        return redirect($project->path());
    }
    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required|sometimes',
            'description' => 'required|sometimes',
            'notes' => 'nullable'
        ]);
    }
}
