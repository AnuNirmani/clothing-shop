<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                Sizes Management
            </span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                    Manage your product sizes
                </span>
            </div>

            <!-- Add Size -->
            <div class="bg-gradient-to-r from-pink-50 to-blue-50 rounded-xl shadow-md p-6 mb-6 border border-pink-100 ">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 ">Add New Size</h3>
                <form method="POST" action="{{ route('sizes.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input
                            type="text"
                            name="name"
                            placeholder="Enter size name *"
                            value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-pink-500"
                        >
                        <input
                            type="file"
                            name="photo"
                            accept="image/*"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-pink-500"
                        >
                        <button
                            type="submit"
                            class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white rounded-lg font-semibold px-6 py-3 hover:scale-105 transition-transform duration-200"
                        >
                            Add Size
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b bg-gradient-to-r from-pink-50 to-blue-50">
                    <h3 class="text-lg font-semibold text-gray-900">All Sizes</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-center">
                        <thead>
                            <tr class="bg-gradient-to-r from-pink-50 to-blue-50 border-b">
                                <th class="px-6 py-4 text-xs font-semibold text-gray-700 uppercase">Photo</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-700 uppercase">Name</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-700 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($sizes as $size)
                                @php $editError = session('edit_error_id') == $size->id; @endphp

                                <tr class="hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50">

                                    <!-- PHOTO -->
                                    <td class="px-6 py-4">
                                        @if($size->photo)
                                            <img src="{{ asset('storage/'.$size->photo) }}" 
                                                 alt="{{ $size->name }}"
                                                 class="h-16 w-16 object-cover rounded-lg mx-auto border border-pink-200">
                                        @else
                                            <div class="h-16 w-16 bg-gray-100 rounded-lg mx-auto flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- NAME -->
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <span
                                                id="name-display-{{ $size->id }}"
                                                @if($editError) style="display:none" @endif
                                                class="font-semibold text-pink-600"
                                            >
                                                {{ $size->name }}
                                            </span>

                                            <form
                                                id="edit-form-{{ $size->id }}"
                                                method="POST"
                                                action="{{ route('sizes.update', $size->id) }}"
                                                enctype="multipart/form-data"
                                                @if(!$editError) style="display:none" @endif
                                            >
                                                @csrf
                                                @method('PUT')
                                                <div class="flex gap-2">
                                                    <input
                                                        id="name-input-{{ $size->id }}"
                                                        type="text"
                                                        name="name"
                                                        value="{{ old('name', $size->name) }}"
                                                        class="border rounded-lg px-3 py-2 focus:ring-pink-500"
                                                    >
                                                    <input
                                                        type="file"
                                                        name="photo"
                                                        accept="image/*"
                                                        class="border rounded-lg px-3 py-2 focus:ring-pink-500"
                                                    >
                                                </div>
                                            </form>
                                        </div>
                                    </td>

                                    <!-- ACTIONS -->
                                    <td class="px-6 py-4">
                                        <div
                                            id="action-buttons-{{ $size->id }}"
                                            @if($editError) style="display:none" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                type="button"
                                                onclick="enableEdit({{ $size->id }})"
                                                class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg
                                                    border border-amber-200
                                                    hover:bg-amber-200 hover:text-amber-700 hover:border-amber-500
                                                    transition-all duration-200 ease-in-out
                                                    hover:shadow-md hover:-translate-y-0.5"
                                            >
                                                Edit
                                            </button>

                                            <form action="{{ route('sizes.destroy', $size->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Delete this size?')"
                                                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg
                                                        border border-red-200
                                                        hover:bg-red-200 hover:text-red-700 hover:border-red-500
                                                        transition-all duration-200 ease-in-out
                                                        hover:shadow-md hover:-translate-y-0.5"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </div>

                                        <div
                                            id="edit-buttons-{{ $size->id }}"
                                            @if($editError) style="display:flex" @else class="hidden" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                type="button"
                                                onclick="submitEdit({{ $size->id }})"
                                                class="px-4 py-2 bg-pink-500 text-white rounded-lg"
                                            >
                                                Save
                                            </button>
                                            <button
                                                type="button"
                                                onclick="cancelEdit({{ $size->id }})"
                                                class="px-4 py-2 bg-gray-100 rounded-lg"
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-12 text-center text-gray-500">
                                        No sizes found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-t border-pink-100">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Showing <span class="font-semibold text-pink-600">{{ $sizes->firstItem() ?? 0 }}</span> to <span class="font-semibold text-pink-600">{{ $sizes->lastItem() ?? 0 }}</span> of <span class="font-semibold text-blue-600">{{ $sizes->total() }}</span> results
                        </div>
                        <div class="flex space-x-1">
                            @if ($sizes->onFirstPage())
                                <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $sizes->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-pink-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-pink-300 transition-all duration-200">Previous</a>
                            @endif

                            @foreach ($sizes->getUrlRange(1, $sizes->lastPage()) as $page => $url)
                                @if ($page == $sizes->currentPage())
                                    <span class="px-4 py-2 text-sm font-bold text-white bg-gradient-to-r from-pink-500 to-blue-500 border border-pink-500 rounded-lg shadow-md">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-pink-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-pink-300 transition-all duration-200">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($sizes->hasMorePages())
                                <a href="{{ $sizes->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-blue-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-blue-300 transition-all duration-200">Next</a>
                            @else
                                <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function enableEdit(id) {
            document.getElementById('name-display-' + id).style.display = 'none';
            document.getElementById('edit-form-' + id).style.display = 'block';
            document.getElementById('action-buttons-' + id).style.display = 'none';
            document.getElementById('edit-buttons-' + id).style.display = 'flex';
        }

        function cancelEdit(id) {
            document.getElementById('name-display-' + id).style.display = 'inline';
            document.getElementById('edit-form-' + id).style.display = 'none';
            document.getElementById('action-buttons-' + id).style.display = 'flex';
            document.getElementById('edit-buttons-' + id).style.display = 'none';
        }

        function submitEdit(id) {
            document.getElementById('edit-form-' + id).submit();
        }
    </script>
</x-app-layout>
