<?php

namespace App\Livewire\Rentals;

use App\Models\Rental;
use Livewire\Component;
use Livewire\WithPagination;

class RentalsList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.rentals.list', [
            'rentals' => Rental::latest('id')->paginate(12)
        ]);
    }
}
