<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Edit Type</span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-2 border-pink-100">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('types.update', $type->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Type Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $type->name) }}" 
                                class="mt-1 block w-full rounded-lg border-pink-200 shadow-sm focus:border-pink-400 focus:ring-2 focus:ring-pink-300 @error('name') border-red-500 @enderror" 
                                required 
                                placeholder="e.g., T-Shirt, Jeans, Dress, etc.">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{ route('types.index') }}" class="bg-white border-2 border-gray-300 hover:bg-gray-50 text-gray-700 font-bold py-3 px-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                                Update Type
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
