<?php

namespace App\Livewire\Rentals;

use App\Models\Rental;
use Livewire\Component;

class RentalShow extends Component
{
    public $rental;
    public $isAvailable;

    public function mount(Rental $rental)
    {
        $this->rental = $rental;
        $this->isAvailable = $rental->isAvailable();
    }

    public function checkAvailability()
    {
        $this->isAvailable = $this->rental->fresh()->isAvailable();
    }

    public function render()
    {
        return view('livewire.rentals.show');
    }
}
