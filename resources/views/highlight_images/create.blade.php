<!-- resources/views/highlight_images/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Highlight Image for: ') }} {{ $highlight->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <form action="{{ route('highlights.highlightImages.store', $highlight->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mt-4">
                            <label for="detail" class="block text-sm font-medium text-gray-700">Detail</label>
                            <textarea name="detail" id="detail" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>

                        <div class="mt-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500">Save Image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
