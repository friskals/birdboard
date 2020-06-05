@extends('layouts.app')
@section('content')
<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between items-end w-full mx-2">
        <p class="text-grey text-md font-normal"><a href="{{route('projects')}}">My Projects</a> /{{$project->title}}</p>
        <a href="{{route('projects.create')}}" class="button">New Project</a>
    </div>
</header>
<main class="">
    <div class="lg:flex">
        <div class="lg:w-3/4 px-3 mb-6">

            <div class="mb-8">
                <h2 class="text-lg text-grey font-normal mb-3">Task</h2>
                <!-- task -->
                @foreach($project->tasks as $task)
                <div class="card mb-3">{{$task->body}}</div>
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
                <textarea class="card w-full mb-3" style="min-height : 300px">Lorem Ipsum</textarea>
            </div>
        </div>
        <div class="lg:w-1/4 px-3">
            @include('projects.card')
        </div>
    </div>
</main>

@endsection