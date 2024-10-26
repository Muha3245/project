<?php

namespace App\Http\Controllers;

use App\Models\Highlight;
use App\Models\HighlightImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HighlightImageController extends Controller
{
    public function index(Highlight $highlight)
    {
        $images = $highlight->highlightImages;
        return view('highlight_images.index', compact('highlight', 'images'));
    }

    public function create(Highlight $highlight)
    {
        return view('highlight_images.create', compact('highlight'));
    }

    public function store(Request $request, Highlight $highlight)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('public/highlight_images');

        $highlight->highlightImages()->create([
            'image' => $path,
            'name' => $request->name,
            'detail' => $request->detail,
        ]);

        return redirect()->route('highlights.highlightImages.index', $highlight)
                         ->with('success', 'Image added successfully.');
    }

    public function edit(Highlight $highlight, HighlightImage $highlightImage)
    {
        // Ensure the image exists

        return view('highlight_images.edit', compact('highlight', 'highlightImage'));
    }

    public function update(Request $request, Highlight $highlight, HighlightImage $highlightImage)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($highlightImage->image);
            $path = $request->file('image')->store('public/highlight_images');
            $highlightImage->update(['image' => $path]);
        }

        $highlightImage->update([
            'name' => $request->name,
            'detail' => $request->detail,
        ]);

        return redirect()->route('highlights.highlightImages.index', $highlight)
                         ->with('success', 'Image updated successfully.');
    }

    public function destroy(Highlight $highlight, HighlightImage $highlightImage)
    {
        // Ensure the image exists
        if (!$highlightImage) {
            return redirect()->route('highlights.highlightImages.index', $highlight)
                             ->with('error', 'Image not found.');
        }

        Storage::delete($highlightImage->image);
        $highlightImage->delete();

        return redirect()->route('highlights.highlightImages.index', $highlight)
                         ->with('success', 'Image deleted successfully.');
    }
}
