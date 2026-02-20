<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Types Management</span>
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

            {{-- ── Dark Hero Bar ── --}}
            <div class="fade-up d1" style="margin-bottom:24px;position:relative;border-radius:24px;overflow:hidden;padding:26px 32px;background:linear-gradient(135deg,#130826,#1e0d4a,#0a1628);box-shadow:0 20px 60px rgba(13,5,32,0.3);">
                <div style="position:absolute;top:-40px;right:-30px;width:180px;height:180px;background:radial-gradient(circle,rgba(244,114,182,0.18) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-20px;left:45%;width:140px;height:140px;background:radial-gradient(circle,rgba(96,165,250,0.12) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:relative;z-index:1;display:flex;align-items:center;gap:18px;">
                    <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(244,114,182,0.22),rgba(96,165,250,0.18));border:1px solid rgba(244,114,182,0.28);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-5 h-5" style="color:#f9a8d4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="color:rgba(249,168,212,0.6);font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.3em;margin:0 0 3px;font-family:'DM Sans',sans-serif;">✦ Inventory · Configuration</p>
                        <h1 style="color:white;font-size:20px;font-weight:700;margin:0;font-family:'Playfair Display',serif;">Types Management</h1>
                        <p style="color:rgba(255,255,255,0.32);font-size:12px;margin:3px 0 0;font-family:'DM Sans',sans-serif;">Organise and manage your product type catalogue</p>
                    </div>
                    <div style="margin-left:auto;">
                        <span class="count-badge">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ $types->total() }} {{ Str::plural('type', $types->total()) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- ── Flash messages ── --}}
            @if(session('success'))
            <div class="fade-up d1" style="margin-bottom:16px;background:#f0fdf4;border:1.5px solid #bbf7d0;border-radius:14px;padding:12px 18px;display:flex;align-items:center;gap:10px;">
                <svg class="w-4 h-4" style="color:#059669;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                <span style="font-size:13.5px;font-weight:600;color:#065f46;">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="fade-up d1" style="margin-bottom:16px;background:#fff1f2;border:1.5px solid #fecdd3;border-radius:14px;padding:12px 18px;display:flex;align-items:center;gap:10px;">
                <svg class="w-4 h-4" style="color:#ef4444;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span style="font-size:13.5px;font-weight:600;color:#9f1239;">{{ $errors->first() }}</span>
            </div>
            @endif

            {{-- ── Add New Type ── --}}
            <div class="panel panel-pink fade-up d2" style="margin-bottom:18px;">
                <div class="section-label">
                    <div class="section-label-icon" style="background:linear-gradient(135deg,#fce7f3,#dbeafe);">
                        <svg class="w-4 h-4" style="color:#f472b6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <h3>Add New Type</h3>
                </div>

                <div style="padding: 0 24px 22px;">
                    <form method="POST" action="{{ route('types.store') }}">
                        @csrf
                        <div style="display:flex;gap:12px;align-items:center;">
                            <input type="text" name="name" placeholder="Enter type name…"
                                   value="{{ old('name') }}"
                                   class="add-input" style="flex:1;">
                            <button type="submit" class="btn-add">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add Type
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── Types Table ── --}}
            <div class="panel panel-blue fade-up d3">
                <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 24px 14px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="section-label-icon" style="background:linear-gradient(135deg,#dbeafe,#ede9fe);">
                            <svg class="w-4 h-4" style="color:#60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:15px;font-weight:600;color:#1f2937;margin:0;">All Types</h3>
                    </div>
                    <span style="font-size:11px;color:#9ca3af;background:#f3f4f6;padding:3px 10px;border-radius:99px;font-weight:600;">
                        Page {{ $types->currentPage() }} of {{ $types->lastPage() }}
                    </span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th style="padding-left:24px;">Type Name</th>
                            <th style="padding-right:24px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($types as $type)
                        @php $editError = session('edit_error_id') == $type->id; @endphp
                        <tr>
                            {{-- Name cell --}}
                            <td style="padding-left:24px;">
                                <div id="name-display-{{ $type->id }}" class="name-badge" @if($editError) style="display:none;" @endif>
                                    <span class="name-dot"></span>
                                    {{ $type->name }}
                                </div>

                                <form id="edit-form-{{ $type->id }}"
                                      method="POST" action="{{ route('types.update', $type->id) }}"
                                      @if(!$editError) style="display:none;" @endif>
                                    @csrf @method('PUT')
                                    <input id="name-input-{{ $type->id }}" type="text" name="name"
                                           value="{{ old('name', $type->name) }}"
                                           class="edit-input">
                                </form>
                            </td>

                            {{-- Actions cell --}}
                            <td style="padding-right:24px;">
                                {{-- Default buttons --}}
                                <div id="action-buttons-{{ $type->id }}"
                                     @if($editError) style="display:none;" @else style="display:flex;justify-content:flex-end;gap:8px;" @endif>
                                    <button type="button" onclick="enableEdit({{ $type->id }})" class="btn-edit">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </button>
                                    <form action="{{ route('types.destroy', $type->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this type?')" class="btn-delete">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>

                                {{-- Edit mode buttons --}}
                                <div id="edit-buttons-{{ $type->id }}"
                                     @if($editError) style="display:flex;justify-content:flex-end;gap:8px;" @else style="display:none;" @endif>
                                    <button type="button" onclick="submitEdit({{ $type->id }})" class="btn-save">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Save
                                    </button>
                                    <button type="button" onclick="cancelEdit({{ $type->id }})" class="btn-cancel-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Cancel
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">
                                <div class="empty-state">
                                    <div style="width:56px;height:56px;border-radius:18px;background:linear-gradient(135deg,#fce7f3,#eff6ff);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                                        <svg class="w-6 h-6" style="color:#c4b5d4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <p style="font-family:'Playfair Display',serif;font-size:16px;font-weight:600;color:#374151;margin-bottom:5px;">No types yet</p>
                                    <p style="font-size:12.5px;color:#9ca3af;">Add your first product type using the form above</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div style="padding:16px 24px;background:linear-gradient(135deg,#fdf9ff,#f0f9ff);border-top:1px solid #f3e8ff;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                    <p style="font-size:12.5px;color:#6b7280;margin:0;">
                        Showing
                        <span style="font-weight:700;color:#be185d;">{{ $types->firstItem() ?? 0 }}</span>–<span style="font-weight:700;color:#be185d;">{{ $types->lastItem() ?? 0 }}</span>
                        of
                        <span style="font-weight:700;color:#3b82f6;">{{ $types->total() }}</span>
                        types
                    </p>
                    <div style="display:flex;gap:6px;align-items:center;flex-wrap:wrap;">
                        @if($types->onFirstPage())
                            <span class="page-btn disabled">← Prev</span>
                        @else
                            <a href="{{ $types->previousPageUrl() }}" class="page-btn">← Prev</a>
                        @endif

                        @foreach($types->getUrlRange(1, $types->lastPage()) as $page => $url)
                            @if($page == $types->currentPage())
                                <span class="page-btn active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($types->hasMorePages())
                            <a href="{{ $types->nextPageUrl() }}" class="page-btn">Next →</a>
                        @else
                            <span class="page-btn disabled">Next →</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function enableEdit(id) {
            document.getElementById('name-display-' + id).style.display    = 'none';
            document.getElementById('edit-form-' + id).style.display       = 'block';
            document.getElementById('action-buttons-' + id).style.display  = 'none';
            document.getElementById('edit-buttons-' + id).style.display    = 'flex';
            document.getElementById('edit-buttons-' + id).style.justifyContent = 'flex-end';
            document.getElementById('edit-buttons-' + id).style.gap        = '8px';
            document.getElementById('name-input-' + id).focus();
        }

        function cancelEdit(id) {
            document.getElementById('name-display-' + id).style.display    = 'flex';
            document.getElementById('edit-form-' + id).style.display       = 'none';
            document.getElementById('action-buttons-' + id).style.display  = 'flex';
            document.getElementById('edit-buttons-' + id).style.display    = 'none';
        }

        function submitEdit(id) {
            document.getElementById('edit-form-' + id).submit();
        }

        // Press Enter to save while editing
        document.querySelectorAll('.edit-input').forEach(input => {
            input.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const id = input.id.replace('name-input-', '');
                    submitEdit(id);
                }
                if (e.key === 'Escape') {
                    const id = input.id.replace('name-input-', '');
                    cancelEdit(id);
                }
            });
        });
    </script>
</x-app-layout>