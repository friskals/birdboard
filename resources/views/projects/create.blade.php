@extends('layouts.app')

@section('content')

<div class="mx-auto h-full  flex justify-center items-center mt-8">
    <form class="lg:w-1/2 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 " method="POST" action="{{ isset($project) ? $project->path() : route('projects') }}" method="POST">

        <h1 class="text-2xl font-normal mb-10 text-center items-center">Adding awesome project</h1>
        @csrf

        @if(isset($project))
        @method('PATCH')
        @endif

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Title
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="title" id="title" value="{{isset($project) ? $project->title : ''}}" required>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" class="form-control" name="description" id="description">
                {{isset($project) ? $project->description : ''}}</textarea>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    {{isset($project) ? 'Update' : 'Create'}}</button>
                <a href="{{route('projects')}}">Cancel</a>
            </div>
            @if($errors->any())
            @foreach($errors as $error)
            <div class="field">
                <li>{{$error}}</li>
            </div>
            @endforeach
            @endif
    </form>

</div>
@endsection