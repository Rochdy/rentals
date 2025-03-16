<?php

namespace App\Livewire\Rentals;

use App\Models\Rental;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class RentalForm extends Component
{
    use WithFileUploads;

    public ?Rental $rental;

    #[Validate('required|string|max:255')]
    public string $title;

    #[Validate('required|string')]
    public string $description;

    #[Validate('required|numeric|min:0')]
    public float $price;

    #[Validate('nullable|image|max:1000')]
    public $image;

    public ?string $image_url = null;

    public bool $isEditing = false;

    public function mount(?Rental $rental)
    {
        if ($rental->id !== null) {
            $this->rental = $rental;
            $this->title = $rental->title;
            $this->description = $rental->description;
            $this->price = $rental->price;
            $this->image_url = $rental->image_url;
            $this->isEditing = true;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            $uniqueId = Str::uuid();
            $imagePath = $this->image->storeAs('images', $uniqueId . '.' . $this->image->extension(), 'public');
        } else {
            $imagePath = $this->image_url;
        }

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image_url' => $imagePath
        ];

        if ($this->isEditing) {
            $this->rental->update($data);
            session()->flash('message', 'Rental updated successfully!');
        } else {
            Rental::create($data);
            session()->flash('message', 'Rental created successfully!');
        }

        return redirect()->route('rentals.index');
    }

    public function render()
    {
        return view('livewire.rentals.rental-form');
    }
}
