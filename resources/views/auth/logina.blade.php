@extends('layouts.guest-layout')
 
@section('title', 'Page Title')
 
@section('content')

    @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
    @endsession

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus/>
        </div>

        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <input type="submit">
        </div>
    </form>

@endsection

