<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                Classifications Management
            </span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg shadow-md mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-8">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                    Manage your product classifications
                </span>
            </div>

            <!-- Add Classification -->
            <div class="bg-gradient-to-r from-pink-50 to-blue-50 rounded-xl shadow-md p-6 mb-6 border border-pink-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Classification</h3>
                <form method="POST" action="{{ route('classifications.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input
                            type="text"
                            name="name"
                            placeholder="Enter classification name *"
                            value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-pink-500"
                        >
                        <button
                            type="submit"
                            class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white rounded-lg font-semibold px-6 py-3 hover:scale-105 transition-transform duration-200"
                        >
                            Add Classification
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b bg-gradient-to-r from-pink-50 to-blue-50">
                    <h3 class="text-lg font-semibold text-gray-900">All Classifications</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-center">
                        <thead>
                            <tr class="bg-gradient-to-r from-pink-50 to-blue-50 border-b">
                                <th class="px-6 py-4 text-xs font-semibold text-gray-700 uppercase">Name</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-700 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @forelse($classifications as $classification)
                                @php $editError = session('edit_error_id') == $classification->id; @endphp

                                <tr class="hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50">

                                    <!-- NAME -->
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <span
                                                id="name-display-{{ $classification->id }}"
                                                @if($editError) style="display:none" @endif
                                                class="font-semibold text-pink-600"
                                            >
                                                {{ $classification->name }}
                                            </span>

                                            <form
                                                id="edit-form-{{ $classification->id }}"
                                                method="POST"
                                                action="{{ route('classifications.update', $classification->id) }}"
                                                @if(!$editError) style="display:none" @endif
                                            >
                                                @csrf
                                                @method('PUT')
                                                <input
                                                    id="name-input-{{ $classification->id }}"
                                                    type="text"
                                                    name="name"
                                                    value="{{ old('name', $classification->name) }}"
                                                    class="border rounded-lg px-3 py-2 focus:ring-pink-500"
                                                >
                                            </form>
                                        </div>
                                    </td>

                                    <!-- ACTIONS -->
                                    <td class="px-6 py-4">
                                        <div
                                            id="action-buttons-{{ $classification->id }}"
                                            @if($editError) style="display:none" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                onclick="enableEdit({{ $classification->id }})"
                                                class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg
                                                        border border-amber-200
                                                        hover:bg-amber-200 hover:text-amber-700 hover:border-amber-500
                                                        transition-all duration-200 ease-in-out
                                                        hover:shadow-md hover:-translate-y-0.5"
                                                        >
                                                Edit
                                            </button>

                                            <form
                                                method="POST"
                                                action="{{ route('classifications.destroy', $classification->id) }}"
                                                onsubmit="return confirm('Are you sure?')"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
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
                                            id="edit-buttons-{{ $classification->id }}"
                                            @if(!$editError) style="display:none" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                onclick="document.getElementById('edit-form-{{ $classification->id }}').submit()"
                                                class="bg-green-50 text-green-700 px-4 py-2 rounded-lg border border-green-200 hover:bg-green-100 transition"
                                            >
                                                Save
                                            </button>
                                            <button
                                                onclick="cancelEdit({{ $classification->id }})"
                                                class="bg-gray-50 text-gray-700 px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-100 transition"
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-12 text-center text-gray-500">
                                        No classifications found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-t border-pink-100">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Showing <span class="font-semibold text-pink-600">{{ $classifications->firstItem() ?? 0 }}</span> to <span class="font-semibold text-pink-600">{{ $classifications->lastItem() ?? 0 }}</span> of <span class="font-semibold text-blue-600">{{ $classifications->total() }}</span> results
                        </div>
                        <div class="flex space-x-1">
                            @if ($classifications->onFirstPage())
                                <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                            @else
                                <a href="{{ $classifications->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-pink-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-pink-300 transition-all duration-200">Previous</a>
                            @endif

                            @foreach ($classifications->getUrlRange(1, $classifications->lastPage()) as $page => $url)
                                @if ($page == $classifications->currentPage())
                                    <span class="px-4 py-2 text-sm font-bold text-white bg-gradient-to-r from-pink-500 to-blue-500 border border-pink-500 rounded-lg shadow-md">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-pink-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-pink-300 transition-all duration-200">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($classifications->hasMorePages())
                                <a href="{{ $classifications->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-blue-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-blue-300 transition-all duration-200">Next</a>
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
            document.getElementById('name-display-' + id).style.display = 'block';
            document.getElementById('edit-form-' + id).style.display = 'none';
            document.getElementById('action-buttons-' + id).style.display = 'flex';
            document.getElementById('edit-buttons-' + id).style.display = 'none';
        }
    </script>
</x-app-layout>
