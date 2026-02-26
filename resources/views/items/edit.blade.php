<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('items.index') }}" class="text-gray-400 hover:text-pink-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Edit Item</span>
            </h2>
        </div>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        .edit-root { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.5s ease forwards; }
        .d1 { animation-delay: 0.05s; }
        .d2 { animation-delay: 0.12s; }
        .d3 { animation-delay: 0.19s; }
        .d4 { animation-delay: 0.26s; }
        .d5 { animation-delay: 0.33s; }
        .d6 { animation-delay: 0.40s; }

        /* ── Form inputs ── */
        .field-input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1.5px solid #e8d5f0;
            font-size: 13.5px;
            font-family: 'DM Sans', sans-serif;
            color: #1f2937;
            background: white;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .field-input:focus {
            border-color: #f472b6;
            box-shadow: 0 0 0 3px rgba(244,114,182,0.12);
        }
        .field-input::placeholder { color: #c4b5d4; }
        textarea.field-input { resize: vertical; min-height: 90px; }

        /* ── Select: placeholder colour matches "Select colors…" ── */
        select.field-input {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c084fc'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 36px;
            cursor: pointer;
            color: #1f2937; /* edit page selects always have a value */
            font-size: 13.5px;
            font-family: 'DM Sans', sans-serif;
        }
        select.field-input option { color: #1f2937; font-family: 'DM Sans', sans-serif; }

        input[type="number"].field-input::-webkit-outer-spin-button,
        input[type="number"].field-input::-webkit-inner-spin-button { -webkit-appearance: none; }

        /* ── Cards ── */
        .form-card {
            background: white;
            border-radius: 24px;
            border: 1px solid rgba(244,114,182,0.12);
            box-shadow: 0 2px 24px rgba(244,114,182,0.06), 0 1px 4px rgba(0,0,0,0.04);
            padding: 28px;
            position: relative;
            overflow: hidden;
        }
        .form-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 24px 24px 0 0;
        }
        .card-pink::before   { background: linear-gradient(90deg, #f9a8d4, #93c5fd); }
        .card-blue::before   { background: linear-gradient(90deg, #93c5fd, #c4b5fd); }
        .card-purple::before { background: linear-gradient(90deg, #c4b5fd, #f9a8d4); }
        .card-green::before  { background: linear-gradient(90deg, #6ee7b7, #93c5fd); }
        .card-amber::before  { background: linear-gradient(90deg, #fcd34d, #f9a8d4); }
        .card-red::before  { background: linear-gradient(90deg, #fc4d4d, #f9a8d4); }

        /* ── Section labels ── */
        .section-label { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .section-label-icon {
            width: 34px; height: 34px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .section-label h3 {
            font-family: 'Playfair Display', serif; font-size: 16px;
            font-weight: 600; color: #1f2937; margin: 0;
        }

        /* ── Field labels ── */
        .field-label {
            display: block; font-size: 11.5px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: #515151; margin-bottom: 7px;
        }
        .field-label .req { color: #f472b6; margin-left: 2px; }

        /* ── Size radio pills ── */
        .size-pill input[type="radio"] { display: none; }
        .size-pill .pill-body {
            padding: 8px 20px; border-radius: 10px; border: 1.5px solid #e5e7eb;
            font-size: 13px; font-weight: 600; color: #6b7280;
            cursor: pointer; transition: all 0.2s ease; user-select: none;
        }
        .size-pill input:checked + .pill-body {
            border-color: #f472b6;
            background: linear-gradient(135deg, #fdf2f8, #eff6ff);
            color: #be185d; box-shadow: 0 2px 10px rgba(244,114,182,0.2);
        }
        .size-pill .pill-body:hover { border-color: #f9a8d4; color: #db2777; }

        /* ── Checkbox items ── */
        .check-item {
            display: flex; align-items: center; gap: 8px;
            padding: 6px 10px; border-radius: 8px; cursor: pointer;
            transition: background 0.15s ease; font-size: 13px; color: #374151;
        }
        .check-item:hover { background: rgba(244,114,182,0.06); }
        .check-item input[type="checkbox"] {
            accent-color: #f472b6; width: 15px; height: 15px; flex-shrink: 0;
        }

        /* ── Toggle rows ── */
        .toggle-row {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 16px; border-radius: 14px;
            border: 1.5px solid #e8d5f0; cursor: pointer; transition: all 0.2s ease;
        }
        .toggle-row:hover { border-color: #f9a8d4; background: #fdf9ff; }
        .toggle-row input[type="checkbox"] { accent-color: #f472b6; width: 16px; height: 16px; cursor: pointer; }
        .toggle-row-label { font-size: 13.5px; font-weight: 600; color: #374151; }

        /* ── Upload area ── */
        .upload-area {
            border: 2px dashed #e8d5f0; border-radius: 16px; padding: 28px 20px;
            text-align: center; cursor: pointer; transition: all 0.2s ease;
            background: linear-gradient(135deg, #fdf9ff, #f0f9ff);
        }
        .upload-area:hover { border-color: #f472b6; background: linear-gradient(135deg, #fdf2f8, #eff6ff); }

        /* ── Existing photo grid ── */
        .photo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px; }
        .photo-item {
            position: relative; border-radius: 14px; overflow: hidden;
            border: 2px solid #e8d5f0; aspect-ratio: 1/1;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .photo-item:hover { border-color: #f9a8d4; box-shadow: 0 4px 16px rgba(244,114,182,0.15); }
        .photo-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .photo-delete-label {
            position: absolute; top: 6px; right: 6px;
            width: 26px; height: 26px; border-radius: 8px;
            background: rgba(255,255,255,0.92); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            transition: background 0.15s ease;
        }
        .photo-delete-label:hover { background: #fff1f2; }
        .photo-delete-label input[type="checkbox"] { display: none; }
        .photo-item.marked-delete { border-color: #fca5a5; }
        .photo-item.marked-delete img { opacity: 0.45; }
        .photo-item.marked-delete .delete-overlay {
            display: flex !important;
        }
        .delete-overlay {
            display: none;
            position: absolute; inset: 0;
            background: rgba(239,68,68,0.08);
            align-items: center; justify-content: center;
            pointer-events: none;
        }

        /* ── Color multi-select ── */
        #colorDropdown {
            border-radius: 14px; box-shadow: 0 12px 40px rgba(0,0,0,0.12);
            border: 1px solid #e8d5f0;
        }
        .color-option { border-radius: 8px; margin: 3px 6px; }
        .color-option:hover { background: #fdf2f8 !important; }

        /* ── Installment boxes ── */
        .installment-box {
            background: white; border-radius: 14px; border: 1.5px solid;
            padding: 14px; position: relative; overflow: hidden;
        }
        .installment-box::after {
            content: ''; position: absolute; bottom: 0; right: 0;
            width: 60px; height: 60px; border-radius: 50%; opacity: 0.06;
        }
        .installment-pink { border-color: #fce7f3; }
        .installment-pink::after { background: #f472b6; }
        .installment-blue { border-color: #dbeafe; }
        .installment-blue::after { background: #60a5fa; }

        /* ── Discount box ── */
        .discount-box {
            background: linear-gradient(135deg, #f0fdf4, #eff6ff);
            border: 1.5px solid #bbf7d0; border-radius: 14px; padding: 16px;
        }

        /* ── Buttons ── */
        .btn-submit {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #ec4899, #3b82f6);
            color: white; font-family: 'DM Sans', sans-serif; font-weight: 700;
            font-size: 14px; border: none; border-radius: 14px; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            box-shadow: 0 6px 24px rgba(236,72,153,0.3);
            transition: all 0.25s cubic-bezier(.34,1.56,.64,1);
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(236,72,153,0.4); }

        .btn-cancel {
            width: 100%; padding: 13px; background: white; color: #6b7280;
            font-family: 'DM Sans', sans-serif; font-weight: 600; font-size: 14px;
            border: 1.5px solid #e5e7eb; border-radius: 14px; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            text-decoration: none; transition: all 0.2s ease;
        }
        .btn-cancel:hover { border-color: #9ca3af; background: #f9fafb; }

        /* ── Photo entry (new uploads) ── */
        .photo-entry {
            background: linear-gradient(135deg, #fdf9ff, #f0f9ff);
            border: 1.5px solid #e8d5f0; border-radius: 14px;
            padding: 12px 14px; display: flex; align-items: flex-start; gap: 12px;
        }

        /* ── Error alert ── */
        .error-alert {
            background: #fff1f2; border: 1.5px solid #fecdd3;
            border-radius: 16px; padding: 16px 20px;
            display: flex; gap: 12px; align-items: flex-start;
        }

        /* ── Sticky sidebar ── */
        @media (min-width: 1024px) { .sticky-sidebar { position: sticky; top: 24px; } }

        /* ── Price prefix ── */
        .price-wrap { position: relative; }
        .price-prefix {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            font-size: 13px; font-weight: 700; color: #9ca3af; pointer-events: none;
        }
        .price-wrap .field-input { padding-left: 42px; }

        /* ── Suffix (%) ── */
        .suffix-wrap { position: relative; }
        .input-suffix {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            font-size: 12px; font-weight: 700; color: #9ca3af; pointer-events: none;
        }

        /* ── Current image pill ── */
        .current-img-wrap {
            display: inline-flex; flex-direction: column; gap: 8px;
            align-items: flex-start; margin-bottom: 16px;
        }
        .current-img-badge {
            display: inline-flex; align-items: center; gap: 5px;
            background: linear-gradient(135deg,#ede9fe,#fce7f3);
            border: 1px solid #d8b4fe; border-radius: 8px;
            padding: 3px 9px; font-size: 10.5px; font-weight: 700;
            color: #7c3aed; text-transform: uppercase; letter-spacing: 0.1em;
        }

        /* ── Warning note ── */
        .warn-note {
            display: flex; align-items: center; gap: 8px;
            background: #fffbeb; border: 1.5px solid #fde68a;
            border-radius: 10px; padding: 10px 14px;
            font-size: 12px; color: #92400e; font-weight: 500;
        }

        /* lg-hide util */
        .lg-hide { display: block; }
        @media(min-width:1024px){ .lg-hide { display: none !important; } }
    </style>

    <div class="edit-root" style="background: linear-gradient(135deg,#fdf2f8 0%,#f0f9ff 55%,#fdf4ff 100%); min-height: calc(100vh - 64px); padding: 28px 16px 60px;">
        <div style="max-width: 1200px; margin: 0 auto;">

            {{-- ── Error Alert ── --}}
            @if ($errors->any())
            <div class="error-alert fade-up d1" style="margin-bottom:20px;">
                <div style="width:36px;height:36px;border-radius:10px;background:#fee2e2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg class="w-4 h-4" style="color:#ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p style="font-weight:700;font-size:13.5px;color:#dc2626;margin-bottom:6px;">Please fix these errors to continue:</p>
                    <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:4px;">
                        @foreach($errors->all() as $error)
                        <li style="font-size:13px;color:#ef4444;display:flex;align-items:center;gap:6px;">
                            <span style="width:4px;height:4px;border-radius:50%;background:#f87171;flex-shrink:0;"></span>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- ── Dark Hero Bar ── --}}
            <div class="fade-up d1" style="margin-bottom:24px;position:relative;border-radius:24px;overflow:hidden;padding:28px 32px;background:linear-gradient(135deg,#130826,#1e0d4a,#0a1628);box-shadow:0 20px 60px rgba(13,5,32,0.3);">
                <div style="position:absolute;top:-40px;right:-40px;width:200px;height:200px;background:radial-gradient(circle,rgba(251,191,36,0.15) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-30px;left:40%;width:160px;height:160px;background:radial-gradient(circle,rgba(96,165,250,0.12) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:relative;z-index:1;display:flex;align-items:center;gap:20px;">
                    <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,rgba(251,191,36,0.2),rgba(96,165,250,0.15));border:1px solid rgba(251,191,36,0.3);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-6 h-6" style="color:#fde68a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="color:rgba(253,230,138,0.6);font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.3em;margin:0 0 4px;">✦ Inventory · Edit Product</p>
                        <h1 class="font-display" style="color:white;font-size:22px;font-weight:700;margin:0;">{{ $item->name }}</h1>
                        <p style="color:rgba(255,255,255,0.35);font-size:12.5px;margin:4px 0 0;">SKU: <span style="color:rgba(255,255,255,0.55);font-weight:600;">{{ $item->SKU }}</span></p>
                    </div>
                    {{-- Availability badge --}}
                    <div style="margin-left:auto;flex-shrink:0;">
                        @if($item->availability)
                        <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(16,185,129,0.15);border:1px solid rgba(16,185,129,0.3);color:#6ee7b7;font-size:11px;font-weight:700;padding:5px 12px;border-radius:99px;letter-spacing:0.06em;">
                            <span style="width:6px;height:6px;border-radius:50%;background:#10b981;"></span> In Stock
                        </span>
                        @else
                        <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);color:#fca5a5;font-size:11px;font-weight:700;padding:5px 12px;border-radius:99px;letter-spacing:0.06em;">
                            <span style="width:6px;height:6px;border-radius:50%;background:#ef4444;animation:pulse 1.5s infinite;"></span> Out of Stock
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="display:grid;grid-template-columns:1fr;gap:20px;" class="lg-grid">
                    <style>@media(min-width:1024px){ .lg-grid { grid-template-columns: 1fr 340px !important; } }</style>

                    {{-- ══════════ LEFT COLUMN ══════════ --}}
                    <div style="display:flex;flex-direction:column;gap:20px;">

                        {{-- ── 1. Basic Information ── --}}
                        <div class="form-card card-pink fade-up d2">
                            <div class="section-label">
                                <div class="section-label-icon" style="background:linear-gradient(135deg,#fce7f3,#dbeafe);">
                                    <svg class="w-4 h-4" style="color:#f472b6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3>Basic Information</h3>
                            </div>

                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                                <div>
                                    <label class="field-label">Item Name <span class="req">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $item->name) }}" placeholder="Item name" class="field-input">
                                </div>
                                <div>
                                    <label class="field-label">Co. Name <span class="req">*</span></label>
                                    <input type="text" name="co_name" value="{{ old('co_name', $item->co_name) }}" placeholder="Brand or company name" class="field-input">
                                </div>
                                <div>
                                    <label class="field-label">SKU <span class="req">*</span></label>
                                    <input type="text" name="SKU" value="{{ old('SKU', $item->SKU) }}" placeholder="e.g. DRS-001-BLK" class="field-input">
                                </div>
                                <div>
                                    <label class="field-label">Stock Quantity <span class="req">*</span></label>
                                    <input type="number" name="stock_items" value="{{ old('stock_items', $item->stock_items) }}" placeholder="0" min="0" class="field-input">
                                </div>
                            </div>

                            <div style="margin-top:16px;">
                                <label class="field-label">Description</label>
                                <textarea name="description" placeholder="Describe the product in detail…" class="field-input">{{ old('description', $item->description) }}</textarea>
                            </div>
                            <div style="margin-top:14px;">
                                <label class="field-label">Internal Note</label>
                                <textarea name="note" rows="2" placeholder="Any internal notes (not visible to customers)" class="field-input" style="min-height:70px;">{{ old('note', $item->note) }}</textarea>
                            </div>
                        </div>

                        {{-- ── 2. Selections & Attributes ── --}}
                        <div class="form-card card-blue fade-up d3">
                            <div class="section-label">
                                <div class="section-label-icon" style="background:linear-gradient(135deg,#dbeafe,#ede9fe);">
                                    <svg class="w-4 h-4" style="color:#60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                    </svg>
                                </div>
                                <h3>Selections & Attributes</h3>
                            </div>

                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

                                {{-- Category --}}
                                <div>
                                    <label class="field-label">Category <span class="req">*</span></label>
                                    <select name="category_id" id="category_id" class="field-input">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Type --}}
                                <div>
                                    <label class="field-label">Type <span class="req">*</span></label>
                                    <select name="type_id" id="type_id" class="field-input" required>
                                        <option value="">{{ old('category_id', $item->category_id) ? 'Select type…' : 'Select category first…' }}</option>
                                        @foreach($types as $type)
                                            <option
                                                value="{{ $type->id }}"
                                                data-category-id="{{ $type->category_id }}"
                                                {{ old('type_id', $item->type_id) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Material --}}
                                <div>
                                    <label class="field-label">Material <span class="req">*</span></label>
                                    <select name="material_id" class="field-input">
                                        @foreach($materials as $material)
                                            <option value="{{ $material->id }}" {{ old('material_id', $item->material_id) == $material->id ? 'selected' : '' }}>{{ $material->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Color Multi-Select --}}
                                <div>
                                    <label class="field-label">Colors <span class="req">*</span></label>
                                    <div style="position:relative;">
                                        <div id="selectedColorsContainer"></div>
                                        <div id="colorSelectDisplay"
                                             style="border:1.5px solid #e8d5f0;border-radius:12px;padding:10px 36px 10px 14px;cursor:pointer;background:white;min-height:42px;display:flex;align-items:center;transition:border-color 0.2s,box-shadow 0.2s;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23c084fc'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 12px center;background-size:16px;">
                                            <div id="selectedColorText" style="display:flex;flex-wrap:wrap;gap:4px;">
                                                <span style="font-size:13px;color:#c4b5d4;">Select colors…</span>
                                            </div>
                                        </div>
                                        <div id="colorDropdown" style="display:none;position:absolute;z-index:50;width:100%;margin-top:4px;background:white;overflow:hidden auto;max-height:220px;padding:6px 0;">
                                            @foreach($colors as $color)
                                            <div class="color-option"
                                                 style="padding:9px 14px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;transition:background 0.15s ease;"
                                                 data-color-id="{{ $color->id }}"
                                                 data-color-name="{{ $color->name }}"
                                                 data-color-hex="{{ $color->hex_code }}">
                                                <div style="display:flex;align-items:center;gap:10px;">
                                                    <div style="width:22px;height:22px;border-radius:50%;border:2px solid #e5e7eb;background:{{ $color->hex_code ?? '#ccc' }};box-shadow:0 1px 4px rgba(0,0,0,0.1);"></div>
                                                    <span style="font-size:13px;color:#374151;font-weight:500;">{{ $color->name }}</span>
                                                </div>
                                                <div class="check-icon" style="display:none;color:#10b981;">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Classifications --}}
                                <div style="grid-column:1/-1;">
                                    <label class="field-label">Classifications</label>
                                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:4px;max-height:160px;overflow-y:auto;border:1.5px solid #e0e7ff;border-radius:14px;padding:10px;background:linear-gradient(135deg,#f0f4ff,#fdf9ff);">
                                        @foreach($classifications as $cls)
                                        <label class="check-item">
                                            <input type="checkbox" name="classifications[]" value="{{ $cls->id }}"
                                                {{ in_array($cls->id, old('classifications', $item->classifications->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            {{ $cls->name }}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Size --}}
                                <div style="grid-column:1/-1;">
                                    <label class="field-label">Size</label>
                                    @php
                                        $fixedSizes = ['S','M','L','XL','XXL'];
                                        $selLabel = old('size_label', $item->size_label ?? '');
                                    @endphp
                                    <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:14px;">
                                        @foreach($fixedSizes as $sz)
                                        <label class="size-pill">
                                            <input type="radio" name="size_label" value="{{ $sz }}" {{ $selLabel===$sz?'checked':'' }}>
                                            <div class="pill-body">{{ $sz }}</div>
                                        </label>
                                        @endforeach
                                    </div>
                                    <label class="field-label" style="margin-bottom:6px;">Or pick from size list</label>
                                    <select name="size_id_dropdown" id="sizeDropdown" class="field-input">
                                        <option value="">Select size…</option>
                                        @foreach($sizes as $size)
                                        <option value="{{ $size->id }}" {{ old('size_id', $item->size_id)==$size->id?'selected':'' }}>{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        {{-- ── 3. Product Images ── --}}
                        <div class="form-card card-purple fade-up d4">
                            <div class="section-label">
                                <div class="section-label-icon" style="background:linear-gradient(135deg,#ede9fe,#fce7f3);">
                                    <svg class="w-4 h-4" style="color:#a78bfa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3>Product Images</h3>
                            </div>

                            {{-- Current Main Image --}}
                            @if($item->image)
                            <label class="field-label" style="margin-bottom:10px;">Current Main Image</label>
                            <div class="current-img-wrap">
                                <div style="position:relative;display:inline-block;">
                                    <img src="{{ asset('storage/'.$item->image) }}"
                                         style="width:120px;height:120px;object-fit:cover;border-radius:16px;border:2px solid #e8d5f0;box-shadow:0 4px 20px rgba(167,139,250,0.2);">
                                    <span class="current-img-badge" style="position:absolute;bottom:-10px;left:50%;transform:translateX(-50%);white-space:nowrap;">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Main
                                    </span>
                                </div>
                            </div>
                            <div style="height:8px;"></div>
                            @endif

                            {{-- Change Main Image --}}
                            <label class="field-label" style="margin-bottom:10px;">{{ $item->image ? 'Replace Main Image' : 'Main Image' }}</label>

                            <div id="main-image-preview" style="display:none;margin-bottom:14px;">
                                <div style="position:relative;display:inline-block;">
                                    <img id="main-preview-img" style="width:120px;height:120px;object-fit:cover;border-radius:16px;border:2px solid #f9a8d4;box-shadow:0 4px 16px rgba(244,114,182,0.2);">
                                    <button type="button" onclick="removeMainPreview()"
                                            style="position:absolute;top:-8px;right:-8px;width:24px;height:24px;border-radius:50%;background:#ef4444;border:2px solid white;color:white;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(239,68,68,0.4);">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                                <p style="font-size:11.5px;color:#f472b6;font-weight:600;margin-top:8px;">New image ready to upload</p>
                            </div>

                            <div id="main-image-upload" class="upload-area" onclick="document.getElementById('image').click()" style="margin-bottom:24px;">
                                <div style="width:44px;height:44px;border-radius:14px;background:linear-gradient(135deg,#ede9fe,#fce7f3);display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
                                    <svg class="w-5 h-5" style="color:#a78bfa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <p style="font-weight:600;font-size:13px;color:#7c3aed;margin-bottom:3px;">Click to upload new image</p>
                                <p style="font-size:11px;color:#9ca3af;">PNG, JPG, WEBP · max 2MB</p>
                                <input id="image" name="image" type="file" accept="image/png,image/jpeg,image/jpg,image/webp" style="display:none;" onchange="previewMainImage(event)">
                            </div>

                            {{-- Existing Additional Photos --}}
                            @if($item->photos && $item->photos->count() > 0)
                            <div style="margin-bottom:24px;">
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                                    <label class="field-label" style="margin:0;">Existing Photos</label>
                                    <span style="font-size:11px;color:#9ca3af;background:#f3f4f6;padding:3px 10px;border-radius:99px;">{{ $item->photos->count() }} / 20</span>
                                </div>
                                <div class="photo-grid" id="existingPhotoGrid">
                                    @foreach($item->photos as $photo)
                                    <div class="photo-item" id="photo-item-{{ $photo->id }}">
                                        <img src="{{ asset('storage/'.$photo->photo_path) }}" alt="Photo">
                                        <div class="delete-overlay">
                                            <svg class="w-8 h-8" style="color:#ef4444;opacity:0.7;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </div>
                                        <label class="photo-delete-label" title="Mark for deletion" onclick="togglePhotoDelete({{ $photo->id }}, this)">
                                            <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" id="del-{{ $photo->id }}">
                                            <svg class="w-3.5 h-3.5" style="color:#ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="warn-note" style="margin-top:12px;">
                                    <svg class="w-4 h-4" style="color:#f59e0b;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    Tap the 🗑 icon on any photo to mark it for deletion on save
                                </div>
                            </div>
                            @endif

                            {{-- Add More Photos --}}
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                                <label class="field-label" style="margin:0;">Add More Photos</label>
                                <span style="font-size:11px;color:#9ca3af;background:#f3f4f6;padding:3px 10px;border-radius:99px;">Max 20 total</span>
                            </div>

                            <div id="photo-container" style="display:flex;flex-direction:column;gap:10px;margin-bottom:12px;"></div>

                            <button type="button" id="add-photo-btn"
                                    style="width:100%;padding:12px;border:2px dashed #d8b4fe;border-radius:14px;background:linear-gradient(135deg,#fdf9ff,#f0f9ff);color:#7c3aed;font-family:'DM Sans',sans-serif;font-weight:600;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all 0.2s ease;"
                                    onmouseover="this.style.borderColor='#a78bfa';this.style.background='linear-gradient(135deg,#ede9fe,#eff6ff)'"
                                    onmouseout="this.style.borderColor='#d8b4fe';this.style.background='linear-gradient(135deg,#fdf9ff,#f0f9ff)'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add Another Photo
                            </button>
                        </div>

                        {{-- Mobile Submit --}}
                        <div class="form-card fade-up d6 lg-hide" style="background:linear-gradient(135deg,#fdf2f8,#eff6ff);">
                            <div style="display:flex;flex-direction:column;gap:10px;">
                                <button type="submit" class="btn-submit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Update Item
                                </button>
                                <a href="{{ route('items.index') }}" class="btn-cancel">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                        </div>

                    </div>

                    {{-- ══════════ RIGHT SIDEBAR ══════════ --}}
                    <div class="sticky-sidebar" style="display:flex;flex-direction:column;gap:20px;align-self:start;">

                        {{-- ── Pricing ── --}}
                        <div class="form-card card-green fade-up d2">
                            <div class="section-label">
                                <div class="section-label-icon" style="background:linear-gradient(135deg,#d1fae5,#dbeafe);">
                                    <svg class="w-4 h-4" style="color:#059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3>Pricing</h3>
                            </div>

                            <label class="field-label">Price (LKR) <span class="req">*</span></label>
                            <div class="price-wrap" style="margin-bottom:18px;">
                                <span class="price-prefix">Rs</span>
                                <input type="number" step="0.01" name="prize" id="prize"
                                       value="{{ old('prize', $item->prize) }}"
                                       placeholder="0.00" class="field-input"
                                       style="font-size:18px;font-weight:700;padding-left:42px;"
                                       oninput="calculateInstallments(); calculateDiscountedPrice();">
                            </div>

                            <p style="font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:#9ca3af;margin-bottom:10px;">Installment Plans</p>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                                <div class="installment-box installment-pink">
                                    <p style="font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#f9a8d4;margin-bottom:6px;">3 Months</p>
                                    <div style="display:flex;align-items:baseline;gap:4px;">
                                        <span style="font-size:10px;color:#9ca3af;font-weight:600;">Rs</span>
                                        <input type="text" id="installment_3" readonly
                                               value="{{ number_format(($item->discounted_price ?? $item->prize) / 3, 2, '.', '') }}"
                                               style="border:none;outline:none;font-size:20px;font-weight:800;color:#ec4899;background:transparent;width:100%;font-family:'DM Sans',sans-serif;">
                                    </div>
                                    <p style="font-size:10px;color:#9ca3af;margin-top:2px;">per month</p>
                                </div>
                                <div class="installment-box installment-blue">
                                    <p style="font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#93c5fd;margin-bottom:6px;">4 Months</p>
                                    <div style="display:flex;align-items:baseline;gap:4px;">
                                        <span style="font-size:10px;color:#9ca3af;font-weight:600;">Rs</span>
                                        <input type="text" id="installment_4" readonly
                                               value="{{ number_format(($item->discounted_price ?? $item->prize) / 4, 2, '.', '') }}"
                                               style="border:none;outline:none;font-size:20px;font-weight:800;color:#3b82f6;background:transparent;width:100%;font-family:'DM Sans',sans-serif;">
                                    </div>
                                    <p style="font-size:10px;color:#9ca3af;margin-top:2px;">per month</p>
                                </div>
                            </div>
                        </div>

                        {{-- ── Availability ── --}}
                            <div class="form-card card-red fade-up d3">
                                <div class="section-label">
                                    <div class="section-label-icon" style="background:linear-gradient(135deg,#fee2e2,#fce7f3);">
                                        <svg class="w-4 h-4" style="color:#ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3>Availability</h3>
                                </div>

                                <label class="field-label">Status <span class="req">*</span></label>
                                <select name="availability" class="field-input" required>
                                    <option value="in stock"      {{ old('availability', $item->availability ? 'in stock' : 'out of stock') == 'in stock'      ? 'selected' : '' }}>✓ In Stock</option>
                                    <option value="out of stock"  {{ old('availability', $item->availability ? 'in stock' : 'out of stock') == 'out of stock'  ? 'selected' : '' }}>✗ Out of Stock</option>
                                </select>

                                {{-- Live preview badge --}}
                                <div id="availabilityPreview" style="margin-top:12px;padding:10px 14px;border-radius:12px;display:flex;align-items:center;gap:8px;font-size:13px;font-weight:700;transition:all 0.25s ease;
                                    {{ $item->availability ? 'background:rgba(16,185,129,0.08);border:1.5px solid rgba(16,185,129,0.25);color:#059669;' : 'background:rgba(239,68,68,0.08);border:1.5px solid rgba(239,68,68,0.25);color:#dc2626;' }}">
                                    <span id="availDot" style="width:8px;height:8px;border-radius:50%;flex-shrink:0;background:{{ $item->availability ? '#10b981' : '#ef4444' }};"></span>
                                    <span id="availText">{{ $item->availability ? 'Item is currently In Stock' : 'Item is currently Out of Stock' }}</span>
                                </div>
                            </div>
                        {{-- ── Options (Gift Card + Offer) ── --}}
                        <div class="form-card card-amber fade-up d3">
                            <div class="section-label">
                                <div class="section-label-icon" style="background:linear-gradient(135deg,#fef3c7,#fce7f3);">
                                    <svg class="w-4 h-4" style="color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <h3>Options</h3>
                            </div>

                            {{-- Gift Card --}}
                            <label class="toggle-row" style="margin-bottom:12px;">
                                <input type="checkbox" id="is_gift_card" name="is_gift_card" value="1"
                                    {{ old('is_gift_card', $item->is_gift_card) ? 'checked' : '' }}
                                    onchange="toggleGiftCardValidity()">
                                <div>
                                    <p class="toggle-row-label">🎁 Gift Card</p>
                                    <p style="font-size:11px;color:#9ca3af;margin-top:1px;">Mark this as a gift card product</p>
                                </div>
                            </label>

                            <div id="gift_card_validity_section" style="{{ old('is_gift_card', $item->is_gift_card) ? '' : 'display:none;' }} margin-bottom:14px;padding:14px;background:#fff7ed;border-radius:12px;border:1.5px solid #fed7aa;">
                                <label class="field-label">Validity (Months) <span class="req">*</span></label>
                                <input type="number" name="gift_card_validity_months" id="gift_card_validity_months"
                                    value="{{ old('gift_card_validity_months', $item->gift_card_validity_months) }}"
                                    min="1" placeholder="e.g. 12" class="field-input">
                            </div>

                            {{-- Offer --}}
                            <label class="toggle-row" style="margin-bottom:12px;">
                                <input type="checkbox" id="is_on_offer" name="is_on_offer" value="1"
                                    {{ old('is_on_offer', $item->is_on_offer) ? 'checked' : '' }}
                                    onchange="toggleOfferFields()">
                                <div>
                                    <p class="toggle-row-label">🏷️ On Offer</p>
                                    <p style="font-size:11px;color:#9ca3af;margin-top:1px;">Apply a discount to this item</p>
                                </div>
                            </label>

                            <div id="offer_fields_section" style="{{ old('is_on_offer', $item->is_on_offer) ? '' : 'display:none;' }}">
                                <div style="padding:14px;background:#f0fdf4;border-radius:12px;border:1.5px solid #bbf7d0;margin-bottom:12px;">
                                    <label class="field-label">Discount % <span class="req">*</span></label>
                                    <div class="suffix-wrap">
                                        <input type="number" name="offer_percentage" id="offer_percentage"
                                            value="{{ old('offer_percentage', $item->offer_percentage) }}"
                                            min="0" max="100" step="0.01" placeholder="0"
                                            class="field-input" style="padding-right:36px;"
                                            oninput="calculateDiscountedPrice()">
                                        <span class="input-suffix">%</span>
                                    </div>
                                </div>

                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:12px;">
                                    <div>
                                        <label class="field-label">Start Date <span class="req">*</span></label>
                                        <input type="date" name="offer_start_date" id="offer_start_date"
                                               value="{{ old('offer_start_date', $item->offer_start_date instanceof \Carbon\Carbon ? $item->offer_start_date->format('Y-m-d') : $item->offer_start_date) }}"
                                               class="field-input">
                                    </div>
                                    <div>
                                        <label class="field-label">End Date <span class="req">*</span></label>
                                        <input type="date" name="offer_end_date" id="offer_end_date"
                                               value="{{ old('offer_end_date', $item->offer_end_date instanceof \Carbon\Carbon ? $item->offer_end_date->format('Y-m-d') : $item->offer_end_date) }}"
                                               class="field-input">
                                    </div>
                                </div>

                                <div class="discount-box">
                                    <p style="font-size:11px;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:8px;">Price After Discount</p>
                                    <div style="display:flex;align-items:baseline;gap:10px;">
                                        <span style="font-size:22px;font-weight:800;color:#059669;font-family:'DM Sans',sans-serif;" id="discounted_price">Rs 0.00</span>
                                        <span style="font-size:13px;color:#9ca3af;text-decoration:line-through;" id="original_price_display">Rs 0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Desktop Submit --}}
                        <div class="form-card fade-up d5" style="background:linear-gradient(135deg,#fdf2f8,#eff6ff);border-color:rgba(244,114,182,0.15);">
                            <div style="display:flex;flex-direction:column;gap:10px;">
                                <button type="submit" class="btn-submit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    Update Item
                                </button>
                                <a href="{{ route('items.index') }}" class="btn-cancel">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let photoCount     = 0;
        const existingPhotos = {{ $item->photos ? $item->photos->count() : 0 }};
        const maxPhotos      = 20;
        updateAddButtonState();

        /* ── Photo delete toggle ── */
        function togglePhotoDelete(photoId, labelEl) {
            const cb   = document.getElementById('del-' + photoId);
            const item = document.getElementById('photo-item-' + photoId);
            cb.checked = !cb.checked;
            item.classList.toggle('marked-delete', cb.checked);
        }

        /* ── Installments ── */
        function calculateInstallments() {
            const price    = parseFloat(document.getElementById('prize').value) || 0;
            const isOffer  = document.getElementById('is_on_offer').checked;
            const offerPct = parseFloat(document.getElementById('offer_percentage')?.value) || 0;
            let target = price;
            if (isOffer && offerPct > 0) target = price - price * offerPct / 100;
            document.getElementById('installment_3').value = (target / 3).toFixed(2);
            document.getElementById('installment_4').value = (target / 4).toFixed(2);
        }

        /* ── Main image preview ── */
        function previewMainImage(e) {
            const file = e.target.files[0]; if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById('main-preview-img').src = ev.target.result;
                document.getElementById('main-image-preview').style.display = '';
                document.getElementById('main-image-upload').style.display  = 'none';
            };
            reader.readAsDataURL(file);
        }
        function removeMainPreview() {
            document.getElementById('image').value = '';
            document.getElementById('main-image-preview').style.display = 'none';
            document.getElementById('main-image-upload').style.display  = '';
        }

        /* ── Additional photos ── */
        document.getElementById('add-photo-btn').addEventListener('click', function () {
            if (existingPhotos + photoCount >= maxPhotos) { alert('Maximum 20 photos allowed'); return; }
            const photoId = 'photo-' + Date.now();
            const wrap    = document.createElement('div');
            wrap.className = 'photo-entry';
            wrap.innerHTML = `
                <div style="flex:1;">
                    <input type="file" name="photos[]" accept="image/png,image/jpeg,image/jpg,image/webp"
                           onchange="previewAdditionalPhoto(event,'${photoId}')"
                           style="font-size:12.5px;color:#6b7280;width:100%;"
                           class="block file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-600 hover:file:bg-purple-100">
                    <div id="${photoId}" style="display:none;margin-top:8px;">
                        <img style="width:80px;height:80px;object-fit:cover;border-radius:12px;border:1.5px solid #e8d5f0;">
                    </div>
                </div>
                <button type="button" onclick="removePhoto(this)"
                        style="padding:6px;border:none;background:none;color:#f87171;cursor:pointer;border-radius:8px;transition:background 0.15s;"
                        onmouseover="this.style.background='#fff1f2'" onmouseout="this.style.background='none'">
                    <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>`;
            document.getElementById('photo-container').appendChild(wrap);
            photoCount++;
            updateAddButtonState();
        });

        function previewAdditionalPhoto(e, id) {
            const file = e.target.files[0]; if (!file) return;
            const r = new FileReader();
            r.onload = ev => {
                const c = document.getElementById(id);
                c.querySelector('img').src = ev.target.result;
                c.style.display = '';
            };
            r.readAsDataURL(file);
        }

        function removePhoto(btn) {
            btn.closest('.photo-entry').remove();
            photoCount--;
            updateAddButtonState();
        }

        function updateAddButtonState() {
            const btn   = document.getElementById('add-photo-btn');
            const total = existingPhotos + photoCount;
            btn.disabled      = total >= maxPhotos;
            btn.style.opacity = total >= maxPhotos ? '0.4' : '1';
            btn.style.cursor  = total >= maxPhotos ? 'not-allowed' : 'pointer';
        }

        /* ── Color multi-select ── */
        const colorDisplay   = document.getElementById('colorSelectDisplay');
        const colorDropdown  = document.getElementById('colorDropdown');
        const colorContainer = document.getElementById('selectedColorsContainer');
        const colorText      = document.getElementById('selectedColorText');
        let selectedColors   = [];

        // Pre-fill existing item colors (or old() on validation fail)
        const oldColors = @json(old('colors', $item->colors->pluck('id')->toArray()));
        if (oldColors.length) {
            document.addEventListener('DOMContentLoaded', () => {
                oldColors.forEach(id => {
                    const opt = document.querySelector(`.color-option[data-color-id="${id}"]`);
                    if (opt) {
                        selectedColors.push({ id: String(id), name: opt.dataset.colorName, hex: opt.dataset.colorHex });
                        opt.querySelector('.check-icon').style.display = '';
                        opt.style.background = '#fdf2f8';
                    }
                });
                updateColorsUI();
            });
        }

        colorDisplay.addEventListener('click', e => {
            e.stopPropagation();
            const isOpen = colorDropdown.style.display !== 'none';
            colorDropdown.style.display    = isOpen ? 'none' : 'block';
            colorDisplay.style.borderColor = isOpen ? '#e8d5f0' : '#f472b6';
            colorDisplay.style.boxShadow   = isOpen ? 'none' : '0 0 0 3px rgba(244,114,182,0.12)';
        });
        document.addEventListener('click', () => {
            colorDropdown.style.display    = 'none';
            colorDisplay.style.borderColor = '#e8d5f0';
            colorDisplay.style.boxShadow   = 'none';
        });
        colorDropdown.addEventListener('click', e => e.stopPropagation());

        document.querySelectorAll('.color-option').forEach(opt => {
            opt.addEventListener('click', function () {
                const id   = this.dataset.colorId;
                const name = this.dataset.colorName;
                const hex  = this.dataset.colorHex;
                const idx  = selectedColors.findIndex(c => c.id === id);
                const icon = this.querySelector('.check-icon');
                if (idx === -1) {
                    selectedColors.push({ id, name, hex });
                    icon.style.display = ''; this.style.background = '#fdf2f8';
                } else {
                    selectedColors.splice(idx, 1);
                    icon.style.display = 'none'; this.style.background = '';
                }
                updateColorsUI();
            });
        });

        function updateColorsUI() {
            colorContainer.innerHTML = '';
            selectedColors.forEach(c => {
                const inp = document.createElement('input');
                inp.type = 'hidden'; inp.name = 'colors[]'; inp.value = c.id;
                colorContainer.appendChild(inp);
            });
            if (!selectedColors.length) {
                colorText.innerHTML = '<span style="font-size:13px;color:#c4b5d4;">Select colors…</span>';
            } else {
                colorText.innerHTML = '';
                selectedColors.forEach(c => {
                    const badge = document.createElement('div');
                    badge.style.cssText = 'display:flex;align-items:center;gap:5px;background:#f3f4f6;border-radius:99px;padding:3px 8px 3px 4px;border:1px solid #e5e7eb;';
                    badge.innerHTML = `<div style="width:16px;height:16px;border-radius:50%;background:${c.hex};border:1.5px solid #e5e7eb;"></div><span style="font-size:12px;font-weight:600;color:#374151;">${c.name}</span>`;
                    colorText.appendChild(badge);
                });
            }
        }

        /* ── Gift card toggle ── */
        function toggleGiftCardValidity() {
            const sec  = document.getElementById('gift_card_validity_section');
            const inp  = document.getElementById('gift_card_validity_months');
            const show = document.getElementById('is_gift_card').checked;
            sec.style.display = show ? '' : 'none';
            inp.required = show;
            if (!show) inp.value = '';
        }

        /* ── Offer toggle ── */
        function toggleOfferFields() {
            const sec  = document.getElementById('offer_fields_section');
            const show = document.getElementById('is_on_offer').checked;
            sec.style.display = show ? '' : 'none';
            const pct = document.getElementById('offer_percentage');
            const sd  = document.getElementById('offer_start_date');
            const ed  = document.getElementById('offer_end_date');
            pct.required = sd.required = ed.required = show;
            if (!show) { pct.value = ''; sd.value = ''; ed.value = ''; }
            calculateDiscountedPrice();
        }

        /* ── Discounted price ── */
        function calculateDiscountedPrice() {
            const price = parseFloat(document.getElementById('prize').value) || 0;
            const pct   = parseFloat(document.getElementById('offer_percentage')?.value) || 0;
            const disc  = price - price * pct / 100;
            document.getElementById('discounted_price').textContent       = 'Rs ' + disc.toFixed(2);
            document.getElementById('original_price_display').textContent = 'Rs ' + price.toFixed(2);
            calculateInstallments();
        }

        /* ── Category -> Type dependency ── */
        function syncTypeByCategory() {
            const categorySelect = document.getElementById('category_id');
            const typeSelect = document.getElementById('type_id');
            if (!categorySelect || !typeSelect) return;

            const categoryId = categorySelect.value;
            const placeholder = typeSelect.options[0];
            const currentType = typeSelect.value;

            let hasMatch = false;
            Array.from(typeSelect.options).forEach((opt, i) => {
                if (i === 0) return; // keep placeholder
                const match = categoryId && String(opt.dataset.categoryId) === String(categoryId);
                opt.hidden = !match;
                opt.disabled = !match;
                if (match) hasMatch = true;
            });

            if (!categoryId) {
                typeSelect.disabled = true;
                typeSelect.value = '';
                placeholder.text = 'Select category first…';
            } else {
                typeSelect.disabled = false;
                placeholder.text = hasMatch ? 'Select type…' : 'No types for selected category';

                const selectedOption = typeSelect.querySelector(`option[value="${currentType}"]`);
                if (!selectedOption || selectedOption.hidden || selectedOption.disabled) {
                    typeSelect.value = '';
                }
            }

            typeSelect.dispatchEvent(new Event('change'));
        }

        /* ── Init on load ── */
        document.addEventListener('DOMContentLoaded', () => {
            if (document.getElementById('is_on_offer').checked) calculateDiscountedPrice();
            calculateInstallments();
            const categorySelect = document.getElementById('category_id');
            if (categorySelect) {
                categorySelect.addEventListener('change', syncTypeByCategory);
                syncTypeByCategory();
            }
        });
    </script>
</x-app-layout>
