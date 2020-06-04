@extends('layouts.app')
@section('content')
<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between items-center w-full mx-2">
        <h3 class="text-grey text-md font-normal">My Projects</h3>
        <a href="{{route('projects.create')}}" class="button">New Project</a>

    </div>
</header>

<div class="flex flex-wrap -mx-1">
    @forelse($projects as $project)
    <div class="w-1/3 px-3 pb-6">
        <div class="bg-white p-5 rounded-lg shadow" style="height:200px">
            <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-light pl-4">
                <a href="{{$project->path()}}" class="text-black">{{$project->title}}</a>
            </h3>
            <div class="text-grey">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</div>
        </div>
    </div>
    @empty
    <div>No Projects yet</div>
    @endforelse
</div>
@endsection