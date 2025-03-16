<?php

namespace App\Livewire\Bookings;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;

class BookingsList extends Component
{
    use WithPagination;

    public function render()
    {
        $bookings = Booking::with(['user', 'rental'])
            ->orderBy('start_date', 'asc')
            ->paginate(10);

        return view('livewire.bookings.bookings-list', compact('bookings'));
    }
}
