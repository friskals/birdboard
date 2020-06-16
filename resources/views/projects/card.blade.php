<div class="card flex flex-col" style="height:200px">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-light pl-4">
        <a href="{{$project->path()}}" class="text-black">{{$project->title}}</a>
    </h3>
    <div class="text-grey mb-4 flex-1">{{$project->description}}</div>
    @can('manage', $project)
    <form action="{{$project->path()}}" method="post" class="text-right">
        @csrf
        @method('DELETE')
        <button type="submit" class="mt -8 text-xs">Delete</button>
    </form>
    @endcan
</div>