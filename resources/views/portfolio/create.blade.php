@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8 py-4">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('portfolio.create') }}
        </h2> --}}
        {{-- <a href="{{ route('portfolio.index') }}" 
            class="px-3 py-1 text-md bg-gray-600 text-white rounded-md hover:bg-gray-700">
            {{ __('common.back') }}
        </a> --}}
    </div>
    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            @livewire('portfolio.create-edit-portfolio')
        </div>
    </div>
@endsection