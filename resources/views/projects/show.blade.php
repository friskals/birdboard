@extends('layouts.app')
@section('content')
<header class="flex items-center mb-6 pb-4">
    <div class="flex justify-between items-end w-full">
        <p class="text-muted font-light">
            <a href="/projects" class="text-muted no-underline hover:underline">My Projects</a>
            / {{ $project->title }}
        </p>

        <div class="flex items-center">
            @foreach ($project->members as $member)
            <img src="{{ gravatar_url($member->email) }}" alt="{{ $member->name }}'s avatar" class="rounded-full w-8 mr-2">
            @endforeach

            <img src="{{ gravatar_url($project->owner->email) }}" alt="{{ $project->owner->name }}'s avatar" class="rounded-full w-8 mr-2">

            <a href="{{ $project->path().'/edit' }}" class="button ml-4">Edit Project</a>
        </div>
    </div>
</header>
<main class="">
    <div class="lg:flex">
        <div class="lg:w-3/4 px-3 mb-6">

            <div class="mb-8">
                <h2 class="text-lg text-grey font-normal mb-3">Task</h2>
                <!-- task -->
                @foreach($project->tasks as $task)
                <div class="card mb-3">
                    <form action="{{$task->path()}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="flex">
                            <input name="body" value="{{$task->body}}" class="w-full {{$task->completed?'text-grey':''}}">
                            <input type="checkbox" name="completed" onchange="this.form.submit()" {{$task->completed?'checked':''}}>
                        </div>
                    </form>
                </div>
                @endforeach
                <div class="card mb-3">
                    <form action="{{$project->path().'/tasks'}}" method="POST">

                        @csrf

                        <input placeholder="Add a new task" class="w-full" name="body">
                    </form>
                </div>
            </div>
            <div>
                <h2 class="text-lg text-grey font-normal mb-3">General note</h2>
                <!--general node -->
                <form method="POST" action="{{$project->path()}}">
                    @csrf
                    @method('PATCH')
                    <textarea name="notes" class="card w-full mb-3" style="min-height : 300px" placeholder="Anything special that you want to make a note of?">
                    {{trim($project->notes)}}
                    </textarea>
                    <button type="submit" class="button">Save</button>
                    @include('projects.errors')
                </form>
            </div>
        </div>
        <div class="lg:w-1/4 px-3">
            @include('projects.card')

            @include('projects.activity.card')

            @can('manage', $project)
            @include('projects.invite')
            @endcan
        </div>
    </div>
</main>

@endsection