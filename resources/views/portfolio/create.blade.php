<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Create Portfolio</h1>
    <form method="POST" action="{{ route('portfolios.store') }}">
        @csrf
        <x-input label="Name" name="name" />
        <x-textarea name="description" class="mt-4" placeholder="Description"></x-textarea>
        <div class="mt-4">
            <x-button type="submit">Save</x-button>
        </div>
    </form>
</div>
