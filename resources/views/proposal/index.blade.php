{{-- <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Portfolios</h1>
    <a href="{{ route('portfolios.create') }}" class="text-blue-600 underline">Create Portfolio</a>
</div> --}}

@extends('layouts.app')
@section('content')
    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            Proposals content goes here
            @livewire('proposal.proposal-list')
        </div>
    </div>
@endsection