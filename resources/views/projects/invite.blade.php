<div class="card flex flex-col mt-3" style="height:200px">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-light pl-4">
        <a href="{{$project->path()}}" class="text-black">Invite a User</a>
    </h3>
    <form action="{{$project->path().'/invitations'}}" method="post">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" id="email" class="border border-grey-900 rounded w-full py-2 px-3" placeholder="Email address">
        </div>
        <button type="submit" class="button">Invite</button>
    </form>
    @include('projects.errors',['bag'=>'invitations'])
</div>