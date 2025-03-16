<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-6">Rental Listings</h1>

    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
        @forelse($rentals as $rental)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img class="w-full h-48 object-cover" src="{{ Storage::url($rental->image_url ?? 'images/default-rental-image.jpg') }}" alt="{{ $rental->title }}">

                <div class="p-4">
                    <h2 class="text-gray-900 text-xl font-semibold">{{ Str::of($rental->title)->limit(20); }}</h2>

                    <div class="mt-3 flex justify-between items-center">
                        <span class="text-lg font-bold text-indigo-600">${{ number_format($rental->price, 2) }}</span>

                        <p class="text-lg">
                            <strong>Availability:</strong> 
                            @if ($rental->isAvailable())
                                <span class="text-green-600">Available</span>
                            @else
                                <span class="text-red-600">Booked</span>
                            @endif
                        </p>
                        <a wire:navigate href="{{ route('rentals.show', $rental->id) }}"
                            class="px-4 cursor-pointer py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                            View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center col-span-3 text-gray-500">No rentals available.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $rentals->links() }}
    </div>
</div>
