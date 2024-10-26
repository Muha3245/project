<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Subcategory for: ') }} {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('categories.subcategories.store', $category->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Subcategory Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <p class="mt-1 text-sm text-gray-600">{{ $category->name }}</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                Create Subcategory
                            </button>
                            <a href="{{ route('categories.subcategories.index', $category->id) }}" class="text-indigo-600 hover:text-indigo-900">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
