<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Create Proposal</h1>
    <form method="POST" action="{{ route('proposals.store') }}">
        @csrf
        <x-input label="Title" name="title" />
        <x-textarea name="description" class="mt-4" placeholder="Description"></x-textarea>
        <div class="mt-4">
            <x-button type="submit">Save</x-button>
        </div>
    </form>
</div>
