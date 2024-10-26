<!-- resources/views/highlights/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Highlights') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Highlights</h3>
                        <a href="{{ route('highlights.create') }}" class="bg-indigo-600 px-3 py-2 text-sm font-semibold text-white rounded-md hover:bg-indigo-500">
                            Add Highlight
                        </a>
                    </div>

                    <div class="mt-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Main Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($highlights as $highlight)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <img src="{{ Storage::url($highlight->main_image) }}" alt="{{ $highlight->name }}" class="h-20 w-20 object-cover rounded">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <a href="{{ route('highlights.highlightImages.index', $highlight->id) }}" class="text-indigo-600 ml-4">{{ $highlight->name }}</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ Str::limit($highlight->detail, 50) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('highlights.edit', $highlight->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                            <form action="{{ route('highlights.destroy', $highlight->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                            </form>
                                            <a href="{{ route('highlights.show', $highlight->id) }}" class="ml-4 bg-blue-500 text-white rounded-md px-3 py-1 hover:bg-blue-600">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($highlights->isEmpty())
                            <div class="mt-4 text-center">
                                <p class="text-gray-500">No highlights found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
