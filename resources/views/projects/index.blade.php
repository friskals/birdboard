<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Welcome</h1>
    @forelse($projects as $project)
    <ul>
        <li>
            <a href="{{$project->path()}}">{{$project->title}}</a>
        </li>
    </ul>
    @empty
    <h5>Project is Empty</h5>
    @endforelse
</body>

</html>