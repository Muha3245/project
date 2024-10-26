<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::paginate(10);
        return view('carousels.index', compact('carousels'));
    }

    public function create()
    {
        return view('carousels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename = '';
        if ($request->hasFile('image')) { // Changed from main_image to image
            $image = $request->file('image'); // Changed from mainImage to image
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // Store the image in the 'public/carousels' directory
            $image->storeAs('public/carousels', $filename);
        }

        Carousel::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'image' => $filename, // Changed from main_image to image
        ]);

        return redirect()->route('carousels.index')->with('success', 'Carousel item created successfully.');
    }

    public function edit(Carousel $carousel)
    {
        return view('carousels.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Changed from main_image to image
        ]);

        $filename = $carousel->image; // Keep the old filename initially

        if ($request->hasFile('image')) { // Changed from main_image to image
            $image = $request->file('image'); // Changed from mainImage to image
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Delete old image if it exists
            if ($carousel->image) { // Changed from main_image to image
                Storage::delete('public/carousels/' . $carousel->image); // Changed from main_image to image
            }

            // Store the new image in the 'public/carousels' directory
            $image->storeAs('public/carousels', $filename);
        }

        $carousel->update([
            'name' => $request->name,
            'detail' => $request->detail,
            'image' => $filename, // Changed from main_image to image
        ]);

        return redirect()->route('carousels.index')->with('success', 'Carousel item updated successfully.');
    }

    public function destroy(Carousel $carousel)
    {
        if ($carousel->image) { // Changed from main_image to image
            Storage::delete('public/carousels/' . $carousel->image); // Changed from main_image to image
        }
        $carousel->delete();
        return redirect()->route('carousels.index')->with('success', 'Carousel item deleted successfully.');
    }
}
