<?php

namespace App\Http\Controllers;

use App\Models\Highlight;
use App\Models\HighlightImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::with('highlightImages')->paginate(10);
        return view('highlights.index', compact('highlights'));
    }

    public function create()
    {
        return view('highlights.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mainImage = $request->file('main_image')->store('public/highlights');

        $highlight = Highlight::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'main_image' => $mainImage,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('public/highlight_images');
                HighlightImage::create([
                    'highlight_id' => $highlight->id,
                    'image' => $imagePath,
                    'name' => $request->name,
                    'detail' => $request->detail,
                ]);
            }
        }

        return redirect()->route('highlights.index')->with('success', 'Highlight created successfully.');
    }

    public function edit(Highlight $highlight)
    {
        return view('highlights.edit', compact('highlight'));
    }

    public function update(Request $request, Highlight $highlight)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            Storage::delete($highlight->main_image);
            $mainImage = $request->file('main_image')->store('public/highlights');
            $highlight->update(['main_image' => $mainImage]);
        }

        $highlight->update([
            'name' => $request->name,
            'detail' => $request->detail,
        ]);

        return redirect()->route('highlights.index')->with('success', 'Highlight updated successfully.');
    }

    public function destroy(Highlight $highlight)
    {
        Storage::delete($highlight->main_image);
        $highlight->highlightImages()->each(function ($image) {
            Storage::delete($image->image);
            $image->delete();
        });
        $highlight->delete();

        return redirect()->route('highlights.index')->with('success', 'Highlight deleted successfully.');
    }

    public function show(Highlight $highlight)

    {

        $images = $highlight->highlightImages ;
        // dd($images);

        return view('highlights.show', compact('highlight','images'));
    }
}
