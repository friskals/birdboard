@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Welcome</h2>
    <form action="{{route('projects')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Submit</button>
            <a href="{{route('projects')}}">Cancel</a>
        </div>
    </form>
</div>
@endsection