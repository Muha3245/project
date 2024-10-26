<?php

namespace App\Http\Controllers;

use App\Models\ItemImage;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemImageController extends Controller
{
    public function index(Item $item)
    {
        // Fetch item images for the specific item and paginate
        $itemImages = $item->itemImages()->paginate(10); // Assuming `itemImages()` is defined in the Item model
        return view('item_images.index', compact('itemImages', 'item'));
    }

    public function create(Item $item)
    {
        return view('item_images.create', compact('item'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'exists:items,id',
            'coloure' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $imagePath = $image->storeAs('public/item_images', $filename);
        // dd($request);

        ItemImage::create([
            'item_id' => $request->item_id,
            'image' => $filename,
            'coloure' => $request->coloure,
        ]);

        return redirect()->route('item_images.index', ['item' => $request->item_id])
            ->with('success', 'Image added successfully.');
    }

    public function edit(Item $item, ItemImage $image)
{
    return view('item_images.edit', compact('item', 'image'));
}

public function update(Request $request, $itemId, $imageId)
{
    $itemImage = ItemImage::findOrFail($imageId); // Find the image

    // Validation
    $request->validate([
        'item_id' => 'exists:items,id',
        'coloure' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Assign new values
    $itemImage->item_id = $request->item_id;
    $itemImage->coloure = $request->coloure;

    // If a new image is uploaded, update the image
    if ($request->hasFile('image')) {
        Storage::disk('public')->delete('item_images/' . $itemImage->image);

        $image = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('public/item_images', $filename);

        $itemImage->image = $filename;
    }

    $itemImage->save();

    return redirect()->route('item_images.index', ['item' => $itemImage->item_id])
        ->with('success', 'Image updated successfully.');
}


    public function destroy(ItemImage $itemImage)
    {
        Storage::disk('public')->delete('item_images/' . $itemImage->image);

        $itemImage->delete();

        return redirect()->route('item_images.index', ['item' => $itemImage->item_id])
            ->with('success', 'Image deleted successfully.');
    }
}
