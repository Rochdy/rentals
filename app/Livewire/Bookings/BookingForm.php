<?php

namespace App\Livewire\Bookings;

use App\Models\Rental;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BookingForm extends Component
{
    #[Validate('required|date|after:today')] 
    public $start_date;

    #[Validate('required|date|after_or_equal:start_date')] 
    public $end_date;

    #[Validate('required')] 
    public $payment_method;

    public $rental;

    public function mount(Rental $rental)
    {
        if (!$rental || !$rental->isAvailable()) {
            session()->flash('error', 'This rental is no longer available.');
            return redirect()->route('rentals.show', ['rental' => $rental]);
        }

        $this->rental = $rental;
    }

    public function submit()
    {
        try {
            $this->validate();

            $booking = $this->rental->bookings()->create([
                'user_id' => auth()->id(),
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            // simulate loading for payment
            sleep(3);

            $booking->payment()->create([
                'status' => 'success',
                'payment_method' => $this->payment_method,
                'amount' => $booking->rental->price
            ]);

            $this->dispatch('bookingProcessed');
            session()->flash('message', 'Booking successfully created!');
            return redirect()->route('rentals.show', ['rental' => $this->rental->id]);
        } catch (ValidationException $e) {
            $this->dispatch('bookingFailed');
            throw $e;
        }
    }
    
    public function render()
    {
        return view('livewire.bookings.booking-form');
    }
}
