<x-layouts.app :title="__('Rentals')">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Rental Listings</h1>

        <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
            @foreach($rentals as $rental)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ $rental->image_url ?? asset('images/default-rental-image.jpg')}}" alt="{{ $rental->title }}">

                    <div class="p-4">
                        <h2 class="text-gray-900 text-xl font-semibold">{{ $rental->title }}</h2>
                        <!-- <p class="text-gray-600 text-sm mt-2">{{ Str::limit($rental->description, 100) }}</p> -->

                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-lg font-bold text-indigo-600">${{ number_format($rental->price, 2) }}</span>
                            <a href="{{ route('rentals.show', $rental->id) }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $rentals->links() }}
        </div>
    </div>
</x-layouts.app>