<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Categorys Management</span>
        </h2>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        .root { font-family: 'DM Sans', sans-serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.45s ease forwards; }
        .d1 { animation-delay: 0.05s; }
        .d2 { animation-delay: 0.12s; }
        .d3 { animation-delay: 0.19s; }

        /* ── Cards ── */
        .panel {
            background: white;
            border-radius: 24px;
            border: 1px solid rgba(244,114,182,0.10);
            box-shadow: 0 2px 24px rgba(244,114,182,0.06), 0 1px 4px rgba(0,0,0,0.04);
            overflow: hidden;
            position: relative;
        }
        .panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }
        .panel-pink::before  { background: linear-gradient(90deg, #f9a8d4, #93c5fd); }
        .panel-blue::before  { background: linear-gradient(90deg, #93c5fd, #c4b5fd); }

        /* ── Add form input ── */
        .add-input {
            width: 100%;
            padding: 11px 16px;
            border-radius: 12px;
            border: 1.5px solid #e8d5f0;
            font-size: 13.5px;
            font-family: 'DM Sans', sans-serif;
            color: #1f2937;
            background: white;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .add-input:focus {
            border-color: #f472b6;
            box-shadow: 0 0 0 3px rgba(244,114,182,0.12);
        }
        .add-input::placeholder { color: #c4b5d4; }

        /* ── Inline edit input ── */
        .edit-input {
            padding: 7px 12px;
            border-radius: 10px;
            border: 1.5px solid #f9a8d4;
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            color: #1f2937;
            background: #fdf9ff;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            width: 200px;
        }
        .edit-input:focus {
            border-color: #f472b6;
            box-shadow: 0 0 0 3px rgba(244,114,182,0.10);
        }

        /* ── Add button ── */
        .btn-add {
            padding: 11px 28px;
            background: linear-gradient(135deg, #ec4899, #3b82f6);
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 13.5px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            box-shadow: 0 4px 16px rgba(236,72,153,0.28);
            transition: all 0.2s cubic-bezier(.34,1.56,.64,1);
        }
        .btn-add:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(236,72,153,0.36); }

        /* ── Table ── */
        table { width: 100%; border-collapse: collapse; }
        thead tr {
            background: linear-gradient(135deg, #fdf2f8, #eff6ff);
        }
        th {
            padding: 13px 20px;
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #9ca3af;
            text-align: left;
        }
        th:last-child { text-align: right; }

        tbody tr {
            border-top: 1px solid #f3e8ff;
            transition: background 0.15s ease;
        }
        tbody tr:hover { background: linear-gradient(135deg, #fdf9ff, #f0f9ff); }

        td {
            padding: 14px 20px;
            font-size: 13.5px;
            color: #374151;
            vertical-align: middle;
        }
        td:last-child { text-align: right; }

        /* ── Name badge ── */
        .name-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #be185d;
        }
        .name-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f472b6, #60a5fa);
            flex-shrink: 0;
            display: inline-block;
        }

        /* ── Action buttons ── */
        .btn-edit {
            padding: 6px 14px;
            font-size: 12px; font-weight: 700;
            border-radius: 8px;
            border: 1.5px solid #fde68a;
            background: #fffbeb; color: #92400e;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: all 0.18s ease; display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-edit:hover { background: #fef3c7; border-color: #f59e0b; transform: translateY(-1px); box-shadow: 0 3px 10px rgba(245,158,11,0.2); }

        .btn-delete {
            padding: 6px 14px;
            font-size: 12px; font-weight: 700;
            border-radius: 8px;
            border: 1.5px solid #fecdd3;
            background: #fff1f2; color: #9f1239;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: all 0.18s ease; display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-delete:hover { background: #ffe4e6; border-color: #fb7185; transform: translateY(-1px); box-shadow: 0 3px 10px rgba(251,113,133,0.2); }

        .btn-save {
            padding: 6px 14px;
            font-size: 12px; font-weight: 700;
            border-radius: 8px;
            border: none;
            background: linear-gradient(135deg, #ec4899, #3b82f6);
            color: white;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: all 0.18s ease; display: inline-flex; align-items: center; gap: 5px;
            box-shadow: 0 2px 10px rgba(236,72,153,0.25);
        }
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 16px rgba(236,72,153,0.35); }

        .btn-cancel-sm {
            padding: 6px 14px;
            font-size: 12px; font-weight: 700;
            border-radius: 8px;
            border: 1.5px solid #e5e7eb;
            background: white; color: #6b7280;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: all 0.18s ease; display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-cancel-sm:hover { background: #f9fafb; border-color: #9ca3af; }

        /* ── Empty state ── */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        /* ── Pagination ── */
        .page-btn {
            padding: 7px 13px;
            font-size: 12.5px; font-weight: 600;
            border-radius: 10px;
            border: 1.5px solid #e8d5f0;
            background: white; color: #6b7280;
            text-decoration: none;
            transition: all 0.15s ease;
            display: inline-flex; align-items: center;
        }
        .page-btn:hover { border-color: #f9a8d4; background: #fdf9ff; color: #be185d; }
        .page-btn.active {
            background: linear-gradient(135deg, #ec4899, #3b82f6);
            border-color: transparent; color: white;
            box-shadow: 0 3px 12px rgba(236,72,153,0.3);
        }
        .page-btn.disabled { opacity: 0.35; cursor: not-allowed; pointer-events: none; }

        /* ── Section label ── */
        .section-label { display: flex; align-items: center; gap: 10px; margin-bottom: 18px; padding: 20px 24px 0; }
        .section-label-icon { width: 32px; height: 32px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .section-label h3 { font-family: 'Playfair Display', serif; font-size: 15px; font-weight: 600; color: #1f2937; margin: 0; }

        /* ── Row count badge ── */
        .count-badge {
            display: inline-flex; align-items: center; gap: 4px;
            background: linear-gradient(135deg, #fdf2f8, #eff6ff);
            border: 1px solid #e8d5f0;
            border-radius: 99px; padding: 3px 10px;
            font-size: 11px; font-weight: 700; color: #be185d;
        }
    </style>

    <div class="root" style="background: linear-gradient(135deg,#fdf2f8 0%,#f0f9ff 55%,#fdf4ff 100%); min-height: calc(100vh - 64px); padding: 28px 16px 60px;">
        <div style="max-width: 780px; margin: 0 auto;">

        <div class="mb-8">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">
                    Manage your product categories
                </span>
            </div>

            <!-- Add New Category -->
            <div class="bg-gradient-to-r from-pink-50 to-blue-50 rounded-xl shadow-md p-6 mb-6 border border-pink-100 ">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Category</h3>
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

            <div class="px-6 py-4 bg-gradient-to-r from-pink-50 via-blue-50 to-pink-50 border-t border-pink-100">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Showing <span class="font-semibold text-pink-600">{{ $categories->firstItem() ?? 0 }}</span> to <span class="font-semibold text-pink-600">{{ $categories->lastItem() ?? 0 }}</span> of <span class="font-semibold text-blue-600">{{ $categories->total() }}</span> results
                    </div>
                    <div class="flex space-x-1">
                        @if ($categories->onFirstPage())
                            <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $categories->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-pink-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-pink-300 transition-all duration-200">Previous</a>
                        @endif

                        @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                            @if ($page == $categories->currentPage())
                                <span class="px-4 py-2 text-sm font-bold text-white bg-gradient-to-r from-pink-500 to-blue-500 border border-pink-500 rounded-lg shadow-md">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-pink-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-pink-300 transition-all duration-200">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($categories->hasMorePages())
                            <a href="{{ $categories->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-blue-200 rounded-lg hover:bg-gradient-to-r hover:from-pink-100 hover:to-blue-100 hover:border-blue-300 transition-all duration-200">Next</a>
                        @else
                            <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">Next</span>
                        @endif
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
