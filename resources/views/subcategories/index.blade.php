<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Subcategories for: ') }} <span class="font-bold">{{ $category->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-800">Subcategories</h3>
                        <a href="{{ route('categories.subcategories.create', $category->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-indigo-500 transition duration-200">
                            Add Subcategory
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($subcategories as $subcategory)
                                    <tr>
                                        <td class="px-4 py-2">{{ $subcategory->name }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('categories.subcategories.edit', [$category->id, $subcategory->id]) }}" class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('categories.subcategories.destroy', [$category->id, $subcategory->id]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-4 py-2 text-center text-gray-500">No subcategories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
