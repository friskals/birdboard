@if(count($activity->changes['after']) == 1)
updated the {{ key($activity->changes['after']) }} of the project
@else
updated the Project
@endif