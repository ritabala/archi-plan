<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Portfolio</h1>
    <form method="POST" action="{{ route('portfolios.update', $id ?? 0) }}">
        @csrf
        @method('PUT')
        <x-input label="Name" name="name" />
        <x-textarea name="description" class="mt-4" placeholder="Description"></x-textarea>
        <div class="mt-4">
            <x-button type="submit">Update</x-button>
        </div>
    </form>
</div>
