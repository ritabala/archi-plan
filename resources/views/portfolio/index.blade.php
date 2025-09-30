@extends('layouts.app')
@section('content')
    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            {{-- @livewire('membership.membership-management') --}}
            Portfolio content goes here
            @livewire('portfolio.portfolio-list')
        </div>
    </div>
@endsection