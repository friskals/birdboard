@extends('layouts.app')

@section('content')

<div class="mx-auto h-full  flex justify-center items-center mt-8">
    <form class="lg:w-1/2 bg-card  shadow-md rounded px-8 pt-6 pb-8 mb-4 " method="POST" action="{{ isset($project) ? $project->path() : route('projects.store') }}" method="POST">
        <h1 class="text-2xl font-normal mb-10 text-center items-center">Adding awesome project</h1>
        @csrf

        @if(isset($project))
        @method('PATCH')
        @endif

        <div class="mb-4">
            <label class="block text-default text-sm font-bold mb-2" for="title">
                Title
            </label>
            <input class="shadow appearance-none border border-muted-light rounded w-full py-2 px-3 text-default leading-tight focus:outline-none focus:shadow-outline" type="text" name="title" id="title" value="{{isset($project) ? $project->title : ''}}" required>

            <div class="mb-6">
                <label class="block text-default text-sm font-bold my-3 mb-2" for="description">
                    Description
                </label>
                <textarea rows="5" class="shadow appearance-none border border-muted-light rounded w-full py-2 px-3 text-default leading-tight focus:outline-none focus:shadow-outline" class="form-control" name="description" id="description">
                {{isset($project) ?trim($project->description): ''}}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <button class="button" type="submit">
                    {{isset($project) ? 'Update' : 'Create'}}</button>
                <a href="{{route('projects.index')}}" class="text-default no-underline">Cancel</a>
            </div>
            @if($errors->any())
            <ul class="field mt-6 list-reset">
                @foreach($errors->all() as $error)
                <li class="text-sm text-red-600 ">{{$error}}</li>
                @endforeach
            </ul>
            @endif
    </form>

</div>
@endsection