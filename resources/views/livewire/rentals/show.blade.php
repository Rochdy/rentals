<div class="container mx-auto px-4 py-8" wire:poll.5s="checkAvailability">
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden relative">
        @if (auth()->user() && auth()->user()->isAdmin())
        <div class="flex absolute top-5 left-5">

            <a wire:navigate href="{{ route('rentals.edit', $rental->id) }}" class="cursor-pointer px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                Edit Rental
            </a>
        </div>
        @endif
        <img class="w-full h-64 object-cover" src="{{ Storage::url($rental->image_url) }}" alt="{{ $rental->title }}">

        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-900">{{ $rental->title }}</h1>
            <p class="text-gray-700 text-lg mt-4">{{ $rental->description }}</p>

            <div class="mt-6 flex justify-between items-center">
                <span class="text-2xl font-bold text-indigo-600">${{ number_format($rental->price, 2) }}</span>

                @auth
                    @if ($isAvailable)
                        <span class="text-green-600">
                        <span class="animate-pulse w-3 h-3 bg-green-500 rounded-full inline-block"></span>
    
                        Available</span>
                        <a wire:navigate href="{{ route('rentals.booking', $rental->id) }}" class="cursor-pointer px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Book Now
                        </a>
                    @else
                        <p class="text-red-600 font-semibold">This rental is not available for booking.</p>
                    @endif
                @endauth
                @guest
                    <p class="text-orange-400 font-semibold">
                       <a wire:navigate href="{{ route('login') }}">
                            Login to rent this
                       </a>
                    </p>
                @endguest

            </div>
        </div>
    </div>

</div>