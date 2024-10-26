{{-- resources/views/highlights/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Highlight Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">{{ $highlight->name }}</h3>
                        <a href="{{ route('highlights.index') }}" class="text-indigo-600 hover:text-indigo-900">Back</a>
                    </div>

                    <div class="flex justify-center mb-6">
                        <img src="{{ Storage::url($highlight->main_image) }}" alt="{{ $highlight->name }}" class="w-1/2 h-auto rounded-lg shadow-lg">
                    </div>

                    <p class="mt-4">{{ $highlight->detail }}</p>

                    <h3 class="mt-6">Additional Images</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($images as $image)
                            <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center">
                                <img
                                    src="{{ Storage::url($image->image) }}"
                                    alt="{{ $image->name }}"
                                    class="w-full h-48 object-contain rounded mb-2"
                                    style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges; image-rendering: pixelated;"
                                >
                                <p class="text-sm font-semibold">{{ $image->name }}</p>
                                <p class="text-sm text-gray-600">{{ $image->detail }}</p>
                            </div>
                        @endforeach
                    </div>

                    <h3 class="mt-6">Related Products</h3>
                    <div class="related-products">
                        <!-- Fetch and display related products here -->
                        <p>No related products found.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
