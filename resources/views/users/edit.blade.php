<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="text" value="{{ old('name',$user->name) }}" name="name" id="name" autocomplete="name"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder=" Name">
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="text" value="{{ old('email',$user->email) }}" name="email" id="name" autocomplete="name"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="EMAIL">
                                    </div>
                                    @error('email')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-6 grid grid-cols-1 sm:grid-cols-4 gap-4">
                                    @if ($roles->isNotEmpty())
                                        @foreach ($roles as $role)
                                            <div class="flex items-center">
                                                {{--  --}}
                                                <input {{ ($hasRoles->contains($role->id)) ? 'checked' : '' }} type="checkbox"  name="role[]" value="{{ $role->name }}"
                                                       id="permission_{{ $role->id }}"
                                                       class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                                <label for="permission_{{ $role->id }}"
                                                       class="ml-2 block text-sm text-gray-900">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Move button below the input field -->
                            <div class="sm:col-span-4">
                                <div class="mt-6 flex items-center justify-start">
                                    <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
