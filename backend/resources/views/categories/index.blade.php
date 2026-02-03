<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Categories Management</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-8">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                    Manage your product categories
                </span>
            </div>

            <!-- Add New Category -->
            <div class="bg-gradient-to-r from-pink-50 to-blue-50 rounded-xl shadow-md p-6 mb-6 border border-pink-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Category</h3>
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                        <input
                            type="text"
                            name="name"
                            placeholder="Enter category name *"
                            value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-pink-500"
                            required
                        >
                        <button
                            type="submit"
                            class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white rounded-lg font-semibold px-6 py-3 hover:scale-105 transition-transform duration-200"
                        >
                            Add Category
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b bg-gradient-to-r from-pink-50 to-blue-50">
                    <h3 class="text-lg font-semibold text-gray-900">All Categories</h3>
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
                            @forelse($categories as $category)
                                @php $editError = session('edit_error_id') == $category->id; @endphp
                                <tr class="hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50">

                                    <!-- Name -->
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <span
                                                id="name-display-{{ $category->id }}"
                                                @if($editError) style="display:none" @endif
                                                class="font-semibold text-pink-600"
                                            >
                                                {{ $category->name }}
                                            </span>

                                            <form
                                                id="edit-form-{{ $category->id }}"
                                                method="POST"
                                                action="{{ route('categories.update', $category->id) }}"
                                                @if(!$editError) style="display:none" @endif
                                            >
                                                @csrf
                                                @method('PUT')
                                                <input
                                                    id="name-input-{{ $category->id }}"
                                                    type="text"
                                                    name="name"
                                                    value="{{ old('name', $category->name) }}"
                                                    class="border rounded-lg px-3 py-2 focus:ring-pink-500"
                                                >
                                            </form>
                                        </div>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4">
                                        <div
                                            id="action-buttons-{{ $category->id }}"
                                            @if($editError) style="display:none" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                type="button"
                                                onclick="enableEdit({{ $category->id }})"
                                                class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg border border-amber-200 hover:bg-amber-200 hover:text-amber-700 hover:border-amber-500 transition-all duration-200 ease-in-out hover:shadow-md hover:-translate-y-0.5"
                                            >
                                                Edit
                                            </button>

                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Delete this category?')"
                                                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg border border-red-200 hover:bg-red-200 hover:text-red-700 hover:border-red-500 transition-all duration-200 ease-in-out hover:shadow-md hover:-translate-y-0.5"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </div>

                                        <div
                                            id="edit-buttons-{{ $category->id }}"
                                            @if($editError) style="display:flex" @else class="hidden" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                type="button"
                                                onclick="submitEdit({{ $category->id }})"
                                                class="px-4 py-2 bg-pink-500 text-white rounded-lg"
                                            >
                                                Save
                                            </button>
                                            <button
                                                type="button"
                                                onclick="cancelEdit({{ $category->id }})"
                                                class="px-4 py-2 bg-gray-100 rounded-lg"
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-gray-500">
                                        No categories found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
