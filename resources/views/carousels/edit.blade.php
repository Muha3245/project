
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Carousel Item') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form action="{{ route('carousels.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $carousel->name) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500" required>
                            </div>

                            <div class="mt-4">
                                <label for="detail" class="block text-sm font-medium text-gray-700">Detail</label>
                                <textarea name="detail" id="detail" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500">{{ old('detail', $carousel->detail) }}</textarea>
                            </div>

                            <div class="mt-4">
                                <label for="main_image" class="block text-sm font-medium text-gray-700">Main Image</label>
                                <input type="file" name="image" id="main_image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500">
                                <small class="text-gray-500">Leave blank to keep the current image.</small>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update Carousel Item
                                </button>
                            </div>
                        </form>

                        <div class="mt-6">
                            <h4 class="font-semibold text-lg">Current Image:</h4>
                            <img src="{{ asset('storage/carousels/' . $carousel->image) }}" alt="{{ $carousel->name }}" class="w-32 h-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

