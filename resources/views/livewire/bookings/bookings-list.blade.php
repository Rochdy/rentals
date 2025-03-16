<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-center">All Bookings</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="p-3 text-left">User</th>
                    <th class="p-3 text-left">Rental</th>
                    <th class="p-3 text-left">Start Date</th>
                    <th class="p-3 text-left">End Date</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="p-3">{{ $booking->user->name }}</td>
                        <td class="p-3 font-semibold">
                            <a wire:navigate href="{{ route('rentals.show', $booking->rental->id) }}"
                            class="text-indigo-600 hover:underline">
                                {{ $booking->rental->title }}
                            </a>
                        </td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded-lg text-white text-sm 
                                {{ $booking->rental->isAvailable() ? 'bg-green-500' : 'bg-yellow-500' }}">
                                {{ $booking->rental->isAvailable() ? 'Ended' : 'Not ended' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $bookings->links() }}
    </div>
</div>
