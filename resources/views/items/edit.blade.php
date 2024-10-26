<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Item: {{ $item->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $item->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="main_image" class="block text-sm font-medium text-gray-700">Main Image</label>
                            <input type="file" name="main_image" id="main_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @if($item->main_image)
                                <img src="{{ Storage::url('items/' . $item->main_image) }}" alt="{{ $item->title }}" class="mt-2 w-16 h-16">
                            @endif
                            @error('main_image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $item->price) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $item->quantity) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('quantity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="subcategory_id" class="block text-sm font-medium text-gray-700">Subcategory</label>
                            <select name="subcategory_id" id="subcategory_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $item->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="sizes" class="block text-sm font-medium text-gray-700">Sizes</label>
                            <select name="sizes[]" id="sizes" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @php
                                    $sizesArray = is_array(json_decode($item->sizes)) ? json_decode($item->sizes) : [];
                                @endphp
                                <option value="XL" {{ in_array('XL', $sizesArray) ? 'selected' : '' }}>XL</option>
                                <option value="L" {{ in_array('L', $sizesArray) ? 'selected' : '' }}>L</option>
                                <option value="M" {{ in_array('M', $sizesArray) ? 'selected' : '' }}>M</option>
                                <option value="S" {{ in_array('S', $sizesArray) ? 'selected' : '' }}>S</option>
                            </select>
                            @error('sizes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $item->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Update Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
