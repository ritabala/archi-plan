{{-- <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Create Proposal</h1>
    <form method="POST" action="{{ route('proposal.store') }}">
        @csrf
        <x-input label="Title" name="title" />
        <x-textarea name="description" class="mt-4" placeholder="Description"></x-textarea>
        <div class="mt-4">
            <x-button type="submit">Save</x-button>
        </div>
    </form>
</div>
 --}}

@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8 py-4">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{-- {{ __('portfolio.create') }} --}}
proposal 
        </h2>
        {{-- <a href="{{ route('portfolio.index') }}" 
            class="px-3 py-1 text-md bg-gray-600 text-white rounded-md hover:bg-gray-700">
            {{ __('common.back') }}
        </a> --}}
    </div>
    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            {{-- @livewire('membership.create-edit-membership') --}}
        </div>
    </div>
@endsection