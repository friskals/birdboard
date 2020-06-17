@extends('layouts.app')

@section('content')
<div class="mx-auto h-full lg:w-1/4  flex justify-center items-center mt-8">
    <form class="bg-card shadow-md rounded px-8 pt-6 pb-8 mb-4 " method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input class="shadow appearance-none border border-muted-light rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="name" name="name" value="{{ old('name') }}" required autocomplete="email" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Email
            </label>
            <input class="shadow appearance-none border border-muted-light rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input id="password" type="password" class="shadow appearance-none border border-muted-light rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="******************" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Confirm Password
            </label>
            <input class="shadow appearance-none border border-muted-light rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="******************" id="password-confirm" type="password" name="password_confirmation" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Register
            </button>

            @if (Route::has('password.request'))
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 mx-2" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif

        </div>
    </form>

</div>


@endsection