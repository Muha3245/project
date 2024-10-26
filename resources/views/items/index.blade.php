<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Items List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Item</a>

                    <table class="min-w-full border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">Title</th>
                                <th class="border border-gray-300 px-4 py-2">Main Image</th>
                                <th class="border border-gray-300 px-4 py-2">Price</th>
                                <th class="border border-gray-300 px-4 py-2">Quantity</th>
                                <th class="border border-gray-300 px-4 py-2">Sizes</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>

                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('item_images.index', $item->id) }}" class="text-indigo-600 hover:underline">
                                            {{ $item->title }}
                                        </a>
                                    </td>

                                    <td class="border border-gray-300 px-4 py-2">
                                        <img src="{{ Storage::url('items/' . $item->main_image) }}" alt="{{ $item->title }}" class="w-16 h-16">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">${{ $item->price }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $item->quantity }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ implode(', ', json_decode($item->sizes)) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('items.edit', $item->id) }}" class="text-blue-500">Edit</a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
