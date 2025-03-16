<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'image_url'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailable()
    {
        $today = Carbon::today();

        return !$this->bookings()
            ->where('end_date', '>=', $today)
            ->exists();
    }
}
