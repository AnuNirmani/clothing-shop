<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Colors Management</span>
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

        /* ── Panels ── */
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
        .panel-pink::before   { background: linear-gradient(90deg, #f9a8d4, #93c5fd); }
        .panel-blue::before   { background: linear-gradient(90deg, #93c5fd, #c4b5fd); }

        /* ── Section label icon ── */
        .section-icon {
            width: 32px; height: 32px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }

        /* ── Color palette grid ── */
        .color-swatch {
            width: 40px; height: 40px;
            border-radius: 10px;
            border: 2.5px solid transparent;
            cursor: pointer;
            position: relative;
            transition: transform 0.18s cubic-bezier(.34,1.56,.64,1), box-shadow 0.18s ease, border-color 0.15s ease;
            flex-shrink: 0;
        }
        .color-swatch:hover {
            transform: scale(1.18) translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.18);
            z-index: 2;
        }
        .color-swatch.selected {
            border-color: #f472b6;
            box-shadow: 0 0 0 3px rgba(244,114,182,0.35), 0 4px 14px rgba(0,0,0,0.15);
            transform: scale(1.15);
        }

        /* ── Tooltip ── */
        .swatch-wrap {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .swatch-wrap .tip {
            position: absolute;
            bottom: calc(100% + 6px);
            left: 50%; transform: translateX(-50%);
            background: #1f2937;
            color: white;
            font-size: 10px; font-weight: 700;
            padding: 3px 7px; border-radius: 6px;
            white-space: nowrap; pointer-events: none;
            opacity: 0; transition: opacity 0.15s ease;
        }
        .swatch-wrap:hover .tip { opacity: 1; }

        /* ── Selected color preview ── */
        .selected-preview {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 16px; border-radius: 14px;
            border: 1.5px solid #f9a8d4;
            background: linear-gradient(135deg, #fdf9ff, #eff6ff);
            transition: all 0.25s ease;
        }
        .selected-preview .swatch-lg {
            width: 40px; height: 40px; border-radius: 10px;
            border: 2px solid rgba(0,0,0,0.08);
            box-shadow: 0 2px 10px rgba(0,0,0,0.12);
            flex-shrink: 0;
        }

        /* ── Add button ── */
        .btn-add {
            padding: 11px 26px;
            background: linear-gradient(135deg, #ec4899, #3b82f6);
            color: white; font-family: 'DM Sans', sans-serif;
            font-weight: 700; font-size: 13.5px;
            border: none; border-radius: 12px; cursor: pointer;
            white-space: nowrap; display: inline-flex; align-items: center; gap: 7px;
            box-shadow: 0 4px 16px rgba(236,72,153,0.28);
            transition: all 0.2s cubic-bezier(.34,1.56,.64,1);
        }
        .btn-add:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(236,72,153,0.36); }
        .btn-add:disabled { opacity: 0.4; cursor: not-allowed; }

        /* ── Table ── */
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: linear-gradient(135deg, #fdf2f8, #eff6ff); }
        th {
            padding: 13px 20px; font-size: 10.5px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.1em; color: #9ca3af;
            text-align: left;
        }
        th:last-child { text-align: right; padding-right: 24px; }

        tbody tr { border-top: 1px solid #f3e8ff; transition: background 0.15s ease; }
        tbody tr:hover { background: linear-gradient(135deg, #fdf9ff, #f0f9ff); }
        td { padding: 13px 20px; font-size: 13.5px; color: #374151; vertical-align: middle; }
        td:last-child { text-align: right; padding-right: 24px; }

        /* ── Color row badge ── */
        .color-row-badge {
            display: inline-flex; align-items: center; gap: 10px;
        }
        .color-dot {
            width: 28px; height: 28px; border-radius: 8px;
            border: 2px solid rgba(0,0,0,0.08);
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
            flex-shrink: 0;
            transition: box-shadow 0.2s ease;
        }
        tbody tr:hover .color-dot { box-shadow: 0 3px 12px rgba(244,114,182,0.25); }
        .color-name-text { font-weight: 600; color: #be185d; }
        .hex-tag {
            font-size: 10.5px; font-weight: 700; color: #9ca3af;
            background: #f3f4f6; border-radius: 6px; padding: 2px 6px;
            font-family: 'Courier New', monospace; letter-spacing: 0.05em;
        }

        /* ── Edit input ── */
        .edit-input {
            padding: 7px 12px; border-radius: 10px;
            border: 1.5px solid #f9a8d4; font-size: 13px;
            font-family: 'DM Sans', sans-serif; color: #1f2937;
            background: #fdf9ff; outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            width: 160px;
        }
        .edit-input:focus { border-color: #f472b6; box-shadow: 0 0 0 3px rgba(244,114,182,0.10); }

        /* ── Action buttons ── */
        .btn-edit {
            padding: 6px 13px; font-size: 12px; font-weight: 700;
            border-radius: 8px; border: 1.5px solid #fde68a;
            background: #fffbeb; color: #92400e; cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: all 0.18s ease;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-edit:hover { background: #fef3c7; border-color: #f59e0b; transform: translateY(-1px); box-shadow: 0 3px 10px rgba(245,158,11,0.2); }

        .btn-delete {
            padding: 6px 13px; font-size: 12px; font-weight: 700;
            border-radius: 8px; border: 1.5px solid #fecdd3;
            background: #fff1f2; color: #9f1239; cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: all 0.18s ease;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-delete:hover { background: #ffe4e6; border-color: #fb7185; transform: translateY(-1px); box-shadow: 0 3px 10px rgba(251,113,133,0.2); }

        .btn-save {
            padding: 6px 13px; font-size: 12px; font-weight: 700;
            border-radius: 8px; border: none;
            background: linear-gradient(135deg, #ec4899, #3b82f6);
            color: white; cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: all 0.18s ease; display: inline-flex; align-items: center; gap: 5px;
            box-shadow: 0 2px 10px rgba(236,72,153,0.25);
        }
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 16px rgba(236,72,153,0.35); }

        .btn-cancel-sm {
            padding: 6px 13px; font-size: 12px; font-weight: 700;
            border-radius: 8px; border: 1.5px solid #e5e7eb;
            background: white; color: #6b7280; cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: all 0.18s ease;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-cancel-sm:hover { background: #f9fafb; border-color: #9ca3af; }

        /* ── Count badge ── */
        .count-badge {
            display: inline-flex; align-items: center; gap: 4px;
            background: linear-gradient(135deg, #fdf2f8, #eff6ff);
            border: 1px solid #e8d5f0; border-radius: 99px;
            padding: 3px 10px; font-size: 11px; font-weight: 700; color: #be185d;
        }

        /* ── Pagination ── */
        .page-btn {
            padding: 7px 13px; font-size: 12.5px; font-weight: 600;
            border-radius: 10px; border: 1.5px solid #e8d5f0;
            background: white; color: #6b7280; text-decoration: none;
            transition: all 0.15s ease; display: inline-flex; align-items: center;
        }
        .page-btn:hover { border-color: #f9a8d4; background: #fdf9ff; color: #be185d; }
        .page-btn.active {
            background: linear-gradient(135deg, #ec4899, #3b82f6);
            border-color: transparent; color: white;
            box-shadow: 0 3px 12px rgba(236,72,153,0.3);
        }
        .page-btn.disabled { opacity: 0.35; cursor: not-allowed; pointer-events: none; }

        /* ── Color groups ── */
        .color-group-label {
            font-size: 9px; font-weight: 800; text-transform: uppercase;
            letter-spacing: 0.15em; color: #c4b5d4;
            padding: 8px 0 4px; display: block;
        }
    </style>

    <div class="root" style="background: linear-gradient(135deg,#fdf2f8 0%,#f0f9ff 55%,#fdf4ff 100%); min-height: calc(100vh - 64px); padding: 28px 16px 60px;">
        <div style="max-width: 940px; margin: 0 auto;">

            {{-- ── Dark Hero Bar ── --}}
            <div class="fade-up d1" style="margin-bottom:24px;position:relative;border-radius:24px;overflow:hidden;padding:26px 32px;background:linear-gradient(135deg,#130826,#1e0d4a,#0a1628);box-shadow:0 20px 60px rgba(13,5,32,0.3);">
                <div style="position:absolute;top:-40px;right:-30px;width:200px;height:200px;background:radial-gradient(circle,rgba(244,114,182,0.18) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-20px;left:35%;width:160px;height:160px;background:radial-gradient(circle,rgba(96,165,250,0.12) 0%,transparent 70%);pointer-events:none;"></div>

                {{-- Mini color strip ── decorative --}}
                <div style="position:absolute;top:0;right:0;bottom:0;width:6px;background:linear-gradient(180deg,#f472b6,#a78bfa,#60a5fa,#34d399,#fbbf24,#f87171);opacity:0.7;"></div>

                <div style="position:relative;z-index:1;display:flex;align-items:center;gap:18px;flex-wrap:wrap;">
                    <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(244,114,182,0.22),rgba(167,139,250,0.18));border:1px solid rgba(244,114,182,0.3);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-5 h-5" style="color:#f9a8d4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <p style="color:rgba(249,168,212,0.6);font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.3em;margin:0 0 3px;font-family:'DM Sans',sans-serif;">✦ Inventory · Configuration</p>
                        <h1 style="color:white;font-size:20px;font-weight:700;margin:0;font-family:'Playfair Display',serif;">Colors Management</h1>
                        <p style="color:rgba(255,255,255,0.32);font-size:12px;margin:3px 0 0;font-family:'DM Sans',sans-serif;">Pick and manage the colour palette for your products</p>
                    </div>
                    <div style="flex-shrink:0;">
                        <span class="count-badge">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                            </svg>
                            {{ $colors->total() }} {{ Str::plural('color', $colors->total()) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- ── Flash / Errors ── --}}
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

            {{-- ── Add New Color ── --}}
            <div class="panel panel-pink fade-up d2" style="margin-bottom:18px;">
                <div style="display:flex;align-items:center;gap:10px;padding:20px 24px 16px;">
                    <div class="section-icon" style="background:linear-gradient(135deg,#fce7f3,#dbeafe);">
                        <svg class="w-4 h-4" style="color:#f472b6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <h3 style="font-family:'Playfair Display',serif;font-size:15px;font-weight:600;color:#1f2937;margin:0;">Add New Color</h3>
                    <span style="margin-left:auto;font-size:11px;color:#c4b5d4;font-weight:600;">Click a swatch to select</span>
                </div>

                <form method="POST" action="{{ route('colors.store') }}" id="colorForm" style="padding:0 24px 22px;">
                    @csrf
                    <input type="hidden" name="name" id="selectedColorName" value="{{ old('name') }}">
                    <input type="hidden" name="hex_code" id="selectedColorHex" value="{{ old('hex_code') }}">

                    @php
                    $colorGroups = [
                        'Reds & Pinks' => [
                            ['name'=>'Red','hex'=>'#FF0000'],['name'=>'Pink','hex'=>'#FFC0CB'],
                            ['name'=>'Rose','hex'=>'#FF007F'],['name'=>'Magenta','hex'=>'#FF00FF'],
                            ['name'=>'Coral','hex'=>'#FF7F50'],['name'=>'Salmon','hex'=>'#FA8072'],
                            ['name'=>'Peach','hex'=>'#FFDAB9'],['name'=>'Burgundy','hex'=>'#900020'],
                            ['name'=>'Maroon','hex'=>'#800000'],
                        ],
                        'Purples & Blues' => [
                            ['name'=>'Purple','hex'=>'#800080'],['name'=>'Violet','hex'=>'#8B00FF'],
                            ['name'=>'Indigo','hex'=>'#4B0082'],['name'=>'Blue','hex'=>'#0000FF'],
                            ['name'=>'Navy','hex'=>'#000080'],['name'=>'Royal Blue','hex'=>'#4169E1'],
                            ['name'=>'Cobalt','hex'=>'#0047AB'],['name'=>'Sky Blue','hex'=>'#87CEEB'],
                            ['name'=>'Lavender','hex'=>'#E6E6FA'],['name'=>'Lilac','hex'=>'#C8A2C8'],
                            ['name'=>'Mauve','hex'=>'#E0B0FF'],['name'=>'Plum','hex'=>'#DDA0DD'],
                        ],
                        'Greens & Teals' => [
                            ['name'=>'Green','hex'=>'#008000'],['name'=>'Lime','hex'=>'#00FF00'],
                            ['name'=>'Olive','hex'=>'#808000'],['name'=>'Teal','hex'=>'#008080'],
                            ['name'=>'Cyan','hex'=>'#00FFFF'],['name'=>'Aqua','hex'=>'#00CED1'],
                            ['name'=>'Turquoise','hex'=>'#40E0D0'],['name'=>'Mint','hex'=>'#98FF98'],
                            ['name'=>'Emerald','hex'=>'#50C878'],['name'=>'Forest Green','hex'=>'#228B22'],
                            ['name'=>'Sea Green','hex'=>'#2E8B57'],
                        ],
                        'Yellows, Oranges & Browns' => [
                            ['name'=>'Yellow','hex'=>'#FFFF00'],['name'=>'Gold','hex'=>'#FFD700'],
                            ['name'=>'Amber','hex'=>'#FFBF00'],['name'=>'Orange','hex'=>'#FFA500'],
                            ['name'=>'Brown','hex'=>'#8B4513'],['name'=>'Rust','hex'=>'#B7410E'],
                            ['name'=>'Beige','hex'=>'#F5F5DC'],['name'=>'Tan','hex'=>'#D2B48C'],
                            ['name'=>'Khaki','hex'=>'#C3B091'],
                        ],
                        'Neutrals' => [
                            ['name'=>'Cream','hex'=>'#FFFDD0'],['name'=>'Ivory','hex'=>'#FFFFF0'],
                            ['name'=>'White','hex'=>'#FFFFFF'],['name'=>'Silver','hex'=>'#C0C0C0'],
                            ['name'=>'Gray','hex'=>'#808080'],['name'=>'Charcoal','hex'=>'#36454F'],
                            ['name'=>'Black','hex'=>'#000000'],
                        ],
                    ];
                    @endphp

                    {{-- Color groups --}}
                    @foreach($colorGroups as $groupName => $swatches)
                    <div style="margin-bottom:14px;">
                        <span class="color-group-label">{{ $groupName }}</span>
                        <div style="display:flex;flex-wrap:wrap;gap:7px;">
                            @foreach($swatches as $c)
                            <div class="swatch-wrap">
                                <div class="color-option color-swatch"
                                     style="background-color:{{ $c['hex'] }};"
                                     data-color-name="{{ $c['name'] }}"
                                     data-color-hex="{{ $c['hex'] }}"
                                     onclick="selectColor('{{ $c['name'] }}','{{ $c['hex'] }}',this)"
                                     title="{{ $c['name'] }}">
                                </div>
                                <span class="tip">{{ $c['name'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    {{-- Bottom bar: preview + submit --}}
                    <div style="display:flex;align-items:center;gap:12px;margin-top:18px;flex-wrap:wrap;">
                        <div id="selectedColorDisplay" style="display:none;flex:1;min-width:200px;">
                            <div class="selected-preview">
                                <div id="selectedColorSwatch" class="swatch-lg"></div>
                                <div>
                                    <p style="font-weight:700;font-size:14px;color:#1f2937;margin:0;" id="selectedColorDisplayName"></p>
                                    <p style="font-size:11.5px;color:#9ca3af;margin:2px 0 0;font-family:'Courier New',monospace;" id="selectedColorDisplayHex"></p>
                                </div>
                                <button type="button" onclick="clearSelection()"
                                        style="margin-left:auto;padding:4px;border:none;background:none;color:#d1d5db;cursor:pointer;border-radius:6px;transition:color 0.15s;"
                                        onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#d1d5db'">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div id="no-selection-hint" style="flex:1;min-width:200px;padding:11px 16px;border-radius:14px;border:1.5px dashed #e8d5f0;background:linear-gradient(135deg,#fdf9ff,#f0f9ff);display:flex;align-items:center;gap:8px;">
                            <svg class="w-4 h-4" style="color:#c4b5d4;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"/>
                            </svg>
                            <span style="font-size:12.5px;color:#c4b5d4;font-weight:500;">Select a color swatch above</span>
                        </div>

                        <button type="submit" id="submitBtn" disabled class="btn-add">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Color
                        </button>
                    </div>
                </form>
            </div>

            {{-- ── Colors Table ── --}}
            <div class="panel panel-blue fade-up d3">
                <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 24px 14px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="section-icon" style="background:linear-gradient(135deg,#dbeafe,#ede9fe);">
                            <svg class="w-4 h-4" style="color:#60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:15px;font-weight:600;color:#1f2937;margin:0;">All Colors</h3>
                    </div>
                    <span style="font-size:11px;color:#9ca3af;background:#f3f4f6;padding:3px 10px;border-radius:99px;font-weight:600;">
                        Page {{ $colors->currentPage() }} of {{ $colors->lastPage() }}
                    </span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th style="padding-left:24px;">Color</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($colors as $color)
                        @php $editError = session('edit_error_id') == $color->id; @endphp
                        <tr>
                            {{-- Color display --}}
                            <td style="padding-left:24px;">
                                <div id="name-display-{{ $color->id }}" @if($editError) style="display:none;" @endif>
                                    <div class="color-row-badge">
                                        <div class="color-dot" style="background-color:{{ $color->hex_code ?? '#ccc' }};"></div>
                                        <span class="color-name-text">{{ $color->name }}</span>
                                        <span class="hex-tag">{{ $color->hex_code ?? '' }}</span>
                                    </div>
                                </div>

                                <form id="edit-form-{{ $color->id }}"
                                      method="POST" action="{{ route('colors.update', $color->id) }}"
                                      @if(!$editError) style="display:none;" @endif>
                                    @csrf @method('PUT')
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <div class="color-dot" style="background-color:{{ $color->hex_code ?? '#ccc' }};"></div>
                                        <input id="name-input-{{ $color->id }}" type="text" name="name"
                                               value="{{ old('name', $color->name) }}"
                                               class="edit-input">
                                    </div>
                                </form>
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div id="action-buttons-{{ $color->id }}"
                                     @if($editError) style="display:none;" @else style="display:flex;justify-content:flex-end;gap:8px;" @endif>
                                    <button type="button" onclick="enableEdit({{ $color->id }})" class="btn-edit">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('colors.destroy', $color->id) }}"
                                          onsubmit="return confirm('Delete this color?')" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>

                                <div id="edit-buttons-{{ $color->id }}"
                                     @if($editError) style="display:flex;justify-content:flex-end;gap:8px;" @else style="display:none;" @endif>
                                    <button type="button"
                                            onclick="document.getElementById('edit-form-{{ $color->id }}').submit()"
                                            class="btn-save">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Save
                                    </button>
                                    <button type="button" onclick="cancelEdit({{ $color->id }})" class="btn-cancel-sm">
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
                                <div style="padding:60px 20px;text-align:center;">
                                    <div style="width:56px;height:56px;border-radius:18px;background:linear-gradient(135deg,#fce7f3,#eff6ff);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                                        <svg class="w-6 h-6" style="color:#c4b5d4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                        </svg>
                                    </div>
                                    <p style="font-family:'Playfair Display',serif;font-size:16px;font-weight:600;color:#374151;margin-bottom:5px;">No colors yet</p>
                                    <p style="font-size:12.5px;color:#9ca3af;">Pick a swatch above to add your first color</p>
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
                        <span style="font-weight:700;color:#be185d;">{{ $colors->firstItem() ?? 0 }}</span>–<span style="font-weight:700;color:#be185d;">{{ $colors->lastItem() ?? 0 }}</span>
                        of <span style="font-weight:700;color:#3b82f6;">{{ $colors->total() }}</span> colors
                    </p>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                        @if($colors->onFirstPage())
                            <span class="page-btn disabled">← Prev</span>
                        @else
                            <a href="{{ $colors->previousPageUrl() }}" class="page-btn">← Prev</a>
                        @endif

                        @foreach($colors->getUrlRange(1, $colors->lastPage()) as $page => $url)
                            @if($page == $colors->currentPage())
                                <span class="page-btn active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($colors->hasMorePages())
                            <a href="{{ $colors->nextPageUrl() }}" class="page-btn">Next →</a>
                        @else
                            <span class="page-btn disabled">Next →</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        /* ── Swatch selection ── */
        function selectColor(name, hex, el) {
            document.querySelectorAll('.color-option').forEach(e => e.classList.remove('selected'));
            el.classList.add('selected');

            document.getElementById('selectedColorName').value = name;
            document.getElementById('selectedColorHex').value  = hex;

            // Show preview, hide hint
            document.getElementById('selectedColorDisplay').style.display  = '';
            document.getElementById('no-selection-hint').style.display     = 'none';

            document.getElementById('selectedColorSwatch').style.backgroundColor  = hex;
            document.getElementById('selectedColorDisplayName').textContent        = name;
            document.getElementById('selectedColorDisplayHex').textContent         = hex;

            document.getElementById('submitBtn').disabled = false;
        }

        function clearSelection() {
            document.querySelectorAll('.color-option').forEach(e => e.classList.remove('selected'));
            document.getElementById('selectedColorName').value = '';
            document.getElementById('selectedColorHex').value  = '';
            document.getElementById('selectedColorDisplay').style.display  = 'none';
            document.getElementById('no-selection-hint').style.display     = '';
            document.getElementById('submitBtn').disabled = true;
        }

        /* ── Inline edit ── */
        function enableEdit(id) {
            document.getElementById('name-display-' + id).style.display   = 'none';
            document.getElementById('edit-form-' + id).style.display      = 'block';
            document.getElementById('action-buttons-' + id).style.display = 'none';
            const eb = document.getElementById('edit-buttons-' + id);
            eb.style.display = 'flex'; eb.style.justifyContent = 'flex-end'; eb.style.gap = '8px';
            document.getElementById('name-input-' + id).focus();
        }

        function cancelEdit(id) {
            document.getElementById('name-display-' + id).style.display   = 'flex';
            document.getElementById('edit-form-' + id).style.display      = 'none';
            document.getElementById('action-buttons-' + id).style.display = 'flex';
            document.getElementById('edit-buttons-' + id).style.display   = 'none';
        }

        /* ── Keyboard shortcuts ── */
        document.querySelectorAll('.edit-input').forEach(input => {
            input.addEventListener('keydown', e => {
                const id = input.id.replace('name-input-', '');
                if (e.key === 'Enter')  { e.preventDefault(); document.getElementById('edit-form-' + id).submit(); }
                if (e.key === 'Escape') { cancelEdit(id); }
            });
        });
    </script>
</x-app-layout>