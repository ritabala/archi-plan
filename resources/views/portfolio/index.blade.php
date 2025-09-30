{{-- <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Portfolios</h1>
    <a href="{{ route('portfolios.create') }}" class="text-blue-600 underline">Create Portfolio</a>
</div> --}}

@extends('layouts.app')
@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4 sm:px-6 lg:px-8 py-4 dark:text-gray-200 ">
        {{ 'Portfolio' }}
        {{-- {{ __('membership.title') }} --}}
    </h2>

    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            {{-- @livewire('membership.membership-management') --}}
            hello Portfolio content goes here
        </div>
    </div>
@endsection