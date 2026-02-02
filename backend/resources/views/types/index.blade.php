<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                Types Management
            </span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                    Manage your product types and categories
                </span>
            </div>

            <!-- Add Type -->
            <div class="bg-gradient-to-r from-pink-50 to-blue-50 rounded-xl shadow-md p-6 mb-6 border border-pink-100 ">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 ">Add New Type</h3>
                <form method="POST" action="{{ route('types.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input
                            type="text"
                            name="name"
                            placeholder="Enter type name *"
                            value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-pink-500"
                        >
                        <button
                            type="submit"
                            class="bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white rounded-lg font-semibold px-6 py-3 hover:scale-105 transition-transform duration-200"
                            bg-gradient-to-r from-pink-400 via-pink-500 to-blue-400 hover:from-pink-500 hover:to-blue-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 flex items-center space-x-2
                        >
                            Add Type
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b bg-gradient-to-r from-pink-50 to-blue-50">
                    <h3 class="text-lg font-semibold text-gray-900">All Types</h3>
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
                            @forelse($types as $type)
                                @php $editError = session('edit_error_id') == $type->id; @endphp

                                <tr class="hover:bg-gradient-to-r hover:from-pink-50 hover:to-blue-50">

                                    <!-- NAME -->
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <span
                                                id="name-display-{{ $type->id }}"
                                                @if($editError) style="display:none" @endif
                                                class="font-semibold text-pink-600"
                                            >
                                                {{ $type->name }}
                                            </span>

                                            <form
                                                id="edit-form-{{ $type->id }}"
                                                method="POST"
                                                action="{{ route('types.update', $type->id) }}"
                                                @if(!$editError) style="display:none" @endif
                                            >
                                                @csrf
                                                @method('PUT')
                                                <input
                                                    id="name-input-{{ $type->id }}"
                                                    type="text"
                                                    name="name"
                                                    value="{{ old('name', $type->name) }}"
                                                    class="border rounded-lg px-3 py-2 focus:ring-pink-500"
                                                >
                                            </form>
                                        </div>
                                    </td>

                                    <!-- ACTIONS -->
                                    <td class="px-6 py-4">
                                        <div
                                            id="action-buttons-{{ $type->id }}"
                                            @if($editError) style="display:none" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                type="button"
                                                    onclick="enableEdit({{ $type->id }})"
                                                    class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg
                                                        border border-amber-200
                                                        hover:bg-amber-200 hover:text-amber-700 hover:border-amber-500
                                                        transition-all duration-200 ease-in-out
                                                        hover:shadow-md hover:-translate-y-0.5"
                                             >
                                                Edit
                                            </button>


                                            <form action="{{ route('types.destroy', $type->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            <button
                                                type="submit"
                                                    onclick="return confirm('Delete this type?')"
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
                                            id="edit-buttons-{{ $type->id }}"
                                            @if($editError) style="display:flex" @else class="hidden" @endif
                                            class="flex justify-center gap-3"
                                        >
                                            <button
                                                type="button"
                                                onclick="submitEdit({{ $type->id }})"
                                                class="px-4 py-2 bg-pink-500 text-white rounded-lg"
                                            >
                                                Save
                                            </button>
                                            <button
                                                type="button"
                                                onclick="cancelEdit({{ $type->id }})"
                                                class="px-4 py-2 bg-gray-100 rounded-lg"
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-12 text-center text-gray-500">
                                        No types found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t">
                    {{ $types->links() }}
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
