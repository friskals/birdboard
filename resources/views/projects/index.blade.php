@extends('layouts.app')
@section('content')
<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between items-end w-full mx-2">
        <h3 class="text-muted text-base font-light">
            My Projects
        </h3>
        <a href="" @click.prevent="$modal.show('new-project')" class="button no-underline text-white">
            New Project
        </a>
    </div>
</header>

<main class="lg:flex lg:flex-wrap -mx-1">
    @forelse($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6">
        @include('projects.card')
    </div>
    @empty
    <h3 class="mx-3">No Projects yet</h3>
    @endforelse
</main>
<new-project-modal></new-project-modal>

@endsection