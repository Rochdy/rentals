<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold mb-6 text-center">
        {{ $isEditing ? 'Edit Rental' : 'Create Rental' }}
    </h2>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-gray-700 font-semibold">Title</label>
            <input type="text" wire:model="title" class="w-full border border-gray-300 rounded-lg p-2" required>
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Description</label>
            <textarea wire:model="description" class="w-full border border-gray-300 rounded-lg p-2" required></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Price</label>
            <input type="number" wire:model="price" step="0.01" class="w-full border border-gray-300 rounded-lg p-2" required>
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold">Rental Image</label>
            <input type="file" wire:model="image" class="w-full border border-gray-300 rounded-lg p-2">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($image_url)
                <div class="mt-4">
                    <p class="text-sm text-gray-600">Current Image:</p>
                    <img src="{{ Storage::url($rental->image_url) }}" alt="Rental Image" class="w-auto h-20 object-cover rounded-lg">
                </div>
            @endif
        </div>

        <div class="flex justify-end">
            <a href="{{ route('rentals.index') }}" class="px-4 py-2 text-gray-700 hover:underline">Cancel</a>
            <button type="submit" class="ml-4 px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700">
                {{ $isEditing ? 'Update Rental' : 'Create Rental' }}
            </button>
        </div>
    </form>
</div>