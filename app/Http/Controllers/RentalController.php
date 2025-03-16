<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    /**
     * Display a listing of rentals.
     */
    public function index()
    {
        $rentals = Rental::latest()->paginate(12);
        return view('rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new rental.
     */
    public function create()
    {
        return view('rentals.create');
    }

    /**
     * Store a newly created rental in the database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rental = new Rental($request->except('image'));

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rentals', 'public');
            $rental->image_url = '/storage/' . $imagePath;
        }

        $rental->save();

        return redirect()->route('rentals.index')->with('success', 'Rental created successfully.');
    }

    /**
     * Display the specified rental.
     */
    public function show(Rental $rental)
    {
        return view('rentals.show', compact('rental'));
    }
}