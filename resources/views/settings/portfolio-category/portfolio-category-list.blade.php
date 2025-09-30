@extends('layouts.app')
@section('content')
    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-semibold mb-4">Portfolio Categories</h2>
                    {{-- Portfolio category content goes here --}}
                    <p>Portfolio category management will be implemented here.</p>
                    @livewire('settings.portfolio-category.portfolio-category-list')
                </div>
            </div>
        </div>
    </div>
@endsection
