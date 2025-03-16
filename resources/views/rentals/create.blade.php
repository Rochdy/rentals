<x-layouts.app :title="__('Rentals')">
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Add a New Rental</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <strong>Whoops! Something went wrong.</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rentals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="title" class="block text-gray-700 font-semibold">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-semibold">Description</label>
            <textarea id="description" name="description" rows="4"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="price" class="block text-gray-700 font-semibold">Price ($)</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <div>
            <label for="image" class="block text-gray-700 font-semibold">Rental Image</label>
            <input type="file" id="image" name="image"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('rentals.index') }}" class="px-4 py-2 text-gray-700 hover:underline">Cancel</a>
            <button type="submit"
                class="ml-4 px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                Save Rental
            </button>
        </div>
    </form>
</div>
</x-layouts.app>