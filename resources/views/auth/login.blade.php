@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center mt-8">
    <form class="bg-card shadow-md rounded px-8 pt-6 pb-8 mb-4 lg:w-2/5 " method="POST" action="{{ route('login') }}">
        <h2 class="text-2xl font-normal mb-5 text-center">Login</h2>
        @csrf
        <div class="mb-4">
            <label class="block  text-sm font-bold mb-3" for="username">
                Username
            </label>
            <input class="shadow appearance-none border border-muted-light rounded w-full py-2 px-3 " id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block  text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input id="password" type="password" class="shadow appearance-none border border-muted-light rounded w-full py-2 px-3" placeholder="******************" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button class="button mr-3" type="submit">
                Sign In
            </button>

            @if (Route::has('password.request'))
            <a class="text-default inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
                {{ __('Forgot Password?') }}
            </a>
            @endif
        </div>

    </form>

</div>


@endsection