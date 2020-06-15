 <div class="card mt-3">
     <div class="text-xs list-reset">

         @foreach($project->activity as $activity)
         <li class="{{$loop->last ? '': 'mb-1'}}">
             {{$activity->user->name}}
             @include("projects.activity.{$activity->description}")
             <span class="text-grey">{{$activity->created_at->diffForHumans()}}</span>
         </li>
         @endforeach
     </div>
 </div>