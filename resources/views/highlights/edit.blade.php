<!-- resources/views/highlights/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Highlight: ') }} {{ $highlight->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <form action="{{ route('highlights.update', $highlight->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ $highlight->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mt-4">
                            <label for="detail" class="block text-sm font-medium text-gray-700">Detail</label>
                            <textarea name="detail" id="detail" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $highlight->detail }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="main_image" class="block text-sm font-medium text-gray-700">Main Image</label>
                            <input type="file" name="main_image" id="main_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500">Update Highlight</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
