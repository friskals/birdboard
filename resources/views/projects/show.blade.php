@extends('layouts.app')
@section('content')
<h3>{{$project->title}}</h3>
<h4>{{$project->description}}</h4>
<a href="{{route('projects')}}">Back</a>
@endsection