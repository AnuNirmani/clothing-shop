<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('items.index') }}" class="text-gray-400 hover:text-pink-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800">
                    <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Item Details</span>
                </h2>
            </div>
            <a href="{{ route('items.edit', $item->id) }}"
               style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:linear-gradient(135deg,#ec4899,#3b82f6);color:white;font-weight:700;font-size:13.5px;border-radius:14px;text-decoration:none;box-shadow:0 6px 20px rgba(236,72,153,0.3);transition:all 0.2s ease;font-family:'DM Sans',sans-serif;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 10px 28px rgba(236,72,153,0.4)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 6px 20px rgba(236,72,153,0.3)'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Item
            </a>
        </div>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        .show-root { font-family: 'DM Sans', sans-serif; }
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

        /* ── Show cards ── */
        .show-card {
            background: white;
            border-radius: 24px;
            border: 1px solid rgba(244,114,182,0.10);
            box-shadow: 0 2px 24px rgba(244,114,182,0.06), 0 1px 4px rgba(0,0,0,0.04);
            padding: 28px;
            position: relative;
            overflow: hidden;
        }
        .show-card::before {
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
        .card-indigo::before { background: linear-gradient(90deg, #a5b4fc, #c4b5fd); }

        /* ── Section label ── */
        .section-label { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .section-label-icon {
            width: 34px; height: 34px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .section-label h3 {
            font-family: 'Playfair Display', serif;
            font-size: 16px; font-weight: 600; color: #1f2937; margin: 0;
        }

        /* ── Field rows ── */
        .field-label {
            font-size: 10.5px; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: #9ca3af; margin-bottom: 6px;
            display: block;
        }
        .field-value {
            background: linear-gradient(135deg, #f9fafb, #f3f4f6);
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 13.5px;
            color: #1f2937;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            min-height: 42px;
            display: flex;
            align-items: center;
        }
        .field-value.multiline {
            align-items: flex-start;
            min-height: 72px;
            white-space: pre-wrap;
            line-height: 1.6;
        }
        .field-value.mono { font-family: 'Courier New', monospace; font-size: 12.5px; }

        /* ── Pill badges ── */
        .pill-blue {
            display: inline-flex; align-items: center; gap: 5px;
            background: #eff6ff; border: 1px solid #bfdbfe;
            color: #1e40af; font-size: 11.5px; font-weight: 700;
            padding: 4px 10px; border-radius: 99px;
        }
        .pill-pink {
            display: inline-flex; align-items: center;
            background: linear-gradient(135deg,#fdf2f8,#eff6ff);
            border: 1.5px solid #f9a8d4; color: #be185d;
            font-size: 12px; font-weight: 800;
            padding: 6px 16px; border-radius: 10px;
            letter-spacing: 0.05em;
        }

        /* ── Stat cards in pricing ── */
        .stat-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 14px; border-radius: 14px;
            border: 1.5px solid #e5e7eb;
            background: white;
            transition: border-color 0.2s ease;
        }
        .stat-row:hover { border-color: #e8d5f0; }

        /* ── Image gallery ── */
        .thumb-btn {
            border-radius: 12px; overflow: hidden;
            border: 2px solid #e8d5f0; cursor: pointer;
            aspect-ratio: 1/1; transition: all 0.2s ease;
        }
        .thumb-btn:hover { border-color: #f472b6; box-shadow: 0 4px 16px rgba(244,114,182,0.2); transform: translateY(-2px); }
        .thumb-btn.active { border-color: #f472b6; box-shadow: 0 4px 16px rgba(244,114,182,0.25); }
        .thumb-btn img { width: 100%; height: 100%; object-fit: cover; display: block; }

        /* ── Status badge ── */
        .status-in  { background:rgba(16,185,129,0.08);border:1.5px solid rgba(16,185,129,0.25);color:#059669; }
        .status-out { background:rgba(239,68,68,0.08);border:1.5px solid rgba(239,68,68,0.25);color:#dc2626; }
        .status-badge {
            width:100%;padding:10px 16px;border-radius:14px;
            font-size:13.5px;font-weight:700;text-align:center;
            display:flex;align-items:center;justify-content:center;gap:8px;
        }

        /* ── Offer / gift card info box ── */
        .info-box {
            border-radius: 14px; padding: 14px 16px;
            display: flex; flex-direction: column; gap: 5px;
        }
        .info-box-title {
            font-size: 10px; font-weight: 800; letter-spacing: 0.12em;
            text-transform: uppercase; margin-bottom: 3px;
        }
        .info-box-row { font-size: 12.5px; color: #374151; }
        .info-box-row span { font-weight: 700; }

        /* ── Big stat (inventory value) ── */
        .big-stat {
            background: linear-gradient(135deg, #fdf2f8, #eff6ff);
            border: 1.5px solid #e8d5f0; border-radius: 16px; padding: 18px;
        }

        /* ── Sticky sidebar ── */
        @media (min-width: 1024px) { .sticky-sidebar { position: sticky; top: 24px; } }

        /* ── No image placeholder ── */
        .no-image {
            width: 100%; border-radius: 20px; padding: 60px 20px;
            background: linear-gradient(135deg, #f5f3ff, #eef2ff);
            border: 2px dashed #c4b5fd;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 10px; color: #7c3aed; font-weight: 600; font-size: 13.5px;
        }

        /* ── Installment display ── */
        .installment-box {
            background: white; border-radius: 14px; border: 1.5px solid;
            padding: 12px 14px; position: relative; overflow: hidden;
        }
        .installment-box::after {
            content: ''; position: absolute; bottom: 0; right: 0;
            width: 50px; height: 50px; border-radius: 50%; opacity: 0.05;
        }
        .inst-pink { border-color: #fce7f3; }
        .inst-pink::after { background: #f472b6; }
        .inst-blue { border-color: #dbeafe; }
        .inst-blue::after { background: #60a5fa; }

        /* lg grid */
        .lg-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
        @media(min-width:1024px){ .lg-grid { grid-template-columns: 1fr 340px; } }
    </style>

    <div class="show-root" style="background: linear-gradient(135deg,#fdf2f8 0%,#f0f9ff 55%,#fdf4ff 100%); min-height: calc(100vh - 64px); padding: 28px 16px 60px;">
        <div style="max-width: 1200px; margin: 0 auto;">

            {{-- ── Dark Hero Bar ── --}}
            <div class="fade-up d1" style="margin-bottom:24px;position:relative;border-radius:24px;overflow:hidden;padding:28px 32px;background:linear-gradient(135deg,#130826,#1e0d4a,#0a1628);box-shadow:0 20px 60px rgba(13,5,32,0.3);">
                <div style="position:absolute;top:-40px;right:-40px;width:220px;height:220px;background:radial-gradient(circle,rgba(96,165,250,0.15) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-30px;left:35%;width:180px;height:180px;background:radial-gradient(circle,rgba(167,139,250,0.12) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:relative;z-index:1;display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
                    <div style="width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,rgba(96,165,250,0.25),rgba(167,139,250,0.2));border:1px solid rgba(96,165,250,0.35);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-6 h-6" style="color:#93c5fd;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <p style="color:rgba(147,197,253,0.6);font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.3em;margin:0 0 4px;font-family:'DM Sans',sans-serif;">✦ Inventory · View Product</p>
                        <h1 class="font-display" style="color:white;font-size:22px;font-weight:700;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->name }}</h1>
                        <div style="display:flex;align-items:center;gap:16px;margin-top:5px;flex-wrap:wrap;">
                            <p style="color:rgba(255,255,255,0.35);font-size:12px;margin:0;font-family:'DM Sans',sans-serif;">SKU: <span style="color:rgba(255,255,255,0.6);font-weight:600;">{{ $item->SKU }}</span></p>
                            <p style="color:rgba(255,255,255,0.35);font-size:12px;margin:0;font-family:'DM Sans',sans-serif;">Stock: <span style="color:rgba(255,255,255,0.6);font-weight:600;">{{ $item->stock_items }} units</span></p>
                            @if($item->is_gift_card)
                            <span style="background:rgba(249,168,212,0.15);border:1px solid rgba(249,168,212,0.3);color:#f9a8d4;font-size:10px;font-weight:700;padding:3px 10px;border-radius:99px;letter-spacing:0.06em;font-family:'DM Sans',sans-serif;">🎁 Gift Card</span>
                            @endif
                            @if($item->is_on_offer)
                            <span style="background:rgba(110,231,183,0.15);border:1px solid rgba(110,231,183,0.3);color:#6ee7b7;font-size:10px;font-weight:700;padding:3px 10px;border-radius:99px;letter-spacing:0.06em;font-family:'DM Sans',sans-serif;">🏷️ On Offer</span>
                            @endif
                        </div>
                    </div>
                    <div style="flex-shrink:0;">
                        @if($item->availability)
                        <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(16,185,129,0.15);border:1px solid rgba(16,185,129,0.3);color:#6ee7b7;font-size:11px;font-weight:700;padding:6px 14px;border-radius:99px;letter-spacing:0.06em;font-family:'DM Sans',sans-serif;">
                            <span style="width:6px;height:6px;border-radius:50%;background:#10b981;display:inline-block;"></span> In Stock
                        </span>
                        @else
                        <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);color:#fca5a5;font-size:11px;font-weight:700;padding:6px 14px;border-radius:99px;letter-spacing:0.06em;font-family:'DM Sans',sans-serif;">
                            <span style="width:6px;height:6px;border-radius:50%;background:#ef4444;animation:pulse 1.5s infinite;display:inline-block;"></span> Out of Stock
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg-grid">

                {{-- ══════════ LEFT COLUMN ══════════ --}}
                <div style="display:flex;flex-direction:column;gap:20px;">

                    {{-- ── 1. Basic Information ── --}}
                    <div class="show-card card-pink fade-up d2">
                        <div class="section-label">
                            <div class="section-label-icon" style="background:linear-gradient(135deg,#fce7f3,#dbeafe);">
                                <svg class="w-4 h-4" style="color:#f472b6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3>Basic Information</h3>
                        </div>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                            <div>
                                <span class="field-label">Item Name</span>
                                <div class="field-value">{{ $item->name }}</div>
                            </div>
                            <div>
                                <span class="field-label">Co. Name</span>
                                <div class="field-value">{{ $item->co_name ?? '—' }}</div>
                            </div>
                            <div>
                                <span class="field-label">SKU</span>
                                <div class="field-value mono">{{ $item->SKU }}</div>
                            </div>
                            <div>
                                <span class="field-label">Stock Quantity</span>
                                <div class="field-value" style="{{ $item->stock_items > 0 ? 'color:#059669;' : 'color:#dc2626;' }}">
                                    {{ $item->stock_items }} units
                                </div>
                            </div>
                        </div>

                        @if($item->description)
                        <div style="margin-top:16px;">
                            <span class="field-label">Description</span>
                            <div class="field-value multiline">{{ $item->description }}</div>
                        </div>
                        @endif

                        @if($item->note)
                        <div style="margin-top:14px;">
                            <span class="field-label">Internal Note</span>
                            <div class="field-value multiline" style="background:linear-gradient(135deg,#fffbeb,#fef9ec);border-color:#fde68a;color:#92400e;">{{ $item->note }}</div>
                        </div>
                        @endif
                    </div>

                    {{-- ── 2. Selections & Attributes ── --}}
                    <div class="show-card card-blue fade-up d3">
                        <div class="section-label">
                            <div class="section-label-icon" style="background:linear-gradient(135deg,#dbeafe,#ede9fe);">
                                <svg class="w-4 h-4" style="color:#60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                </svg>
                            </div>
                            <h3>Selections & Attributes</h3>
                        </div>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                            <div>
                                <span class="field-label">Category</span>
                                <div class="field-value">{{ $item->category?->name ?? '—' }}</div>
                            </div>
                            <div>
                                <span class="field-label">Type</span>
                                <div class="field-value">{{ $item->type?->name ?? '—' }}</div>
                            </div>
                            <div>
                                <span class="field-label">Material</span>
                                <div class="field-value">{{ $item->material?->name ?? '—' }}</div>
                            </div>
                            <div>
                                <span class="field-label">Size</span>
                                <div class="field-value" style="gap:8px;flex-wrap:wrap;">
                                    @if(!empty($item->size_label))
                                        <span class="pill-pink">{{ strtoupper($item->size_label) }}</span>
                                    @endif
                                    @if($item->size)
                                        <span class="pill-blue">{{ $item->size->name }}</span>
                                    @endif
                                    @if(empty($item->size_label) && !$item->size)
                                        <span style="color:#9ca3af;">—</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Colors --}}
                            <div style="grid-column:1/-1;">
                                <span class="field-label">Colors</span>
                                <div class="field-value" style="flex-wrap:wrap;gap:8px;min-height:52px;">
                                    @php $colorList = $item->colors ?? collect(); @endphp
                                    @if($colorList->count() > 0)
                                        @foreach($colorList as $color)
                                        <span style="display:inline-flex;align-items:center;gap:7px;background:white;border:1.5px solid #e5e7eb;border-radius:99px;padding:5px 12px 5px 6px;">
                                            <span style="width:18px;height:18px;border-radius:50%;background:{{ $color->hex_code ?? '#ccc' }};border:2px solid rgba(0,0,0,0.1);box-shadow:0 1px 4px rgba(0,0,0,0.12);flex-shrink:0;display:inline-block;"></span>
                                            <span style="font-size:12.5px;font-weight:600;color:#374151;">{{ $color->name }}</span>
                                        </span>
                                        @endforeach
                                    @else
                                        <span style="color:#9ca3af;">—</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Classifications --}}
                            <div style="grid-column:1/-1;">
                                <span class="field-label">Classifications</span>
                                <div class="field-value" style="flex-wrap:wrap;gap:6px;min-height:48px;">
                                    @php $clsList = $item->classifications ?? collect(); @endphp
                                    @if($clsList->count() > 0)
                                        @foreach($clsList as $cls)
                                        <span class="pill-blue">{{ $cls->name }}</span>
                                        @endforeach
                                    @else
                                        <span style="color:#9ca3af;">—</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── 3. Product Images ── --}}
                    <div class="show-card card-purple fade-up d4">
                        <div class="section-label">
                            <div class="section-label-icon" style="background:linear-gradient(135deg,#ede9fe,#fce7f3);">
                                <svg class="w-4 h-4" style="color:#a78bfa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3>Product Images</h3>
                        </div>

                        {{-- Main image display --}}
                        <div style="margin-bottom:20px;">
                            @if($item->image)
                                <div style="position:relative;border-radius:20px;overflow:hidden;border:2px solid #e8d5f0;box-shadow:0 8px 32px rgba(167,139,250,0.15);">
                                    <img id="main-image"
                                         src="{{ Storage::url($item->image) }}?v={{ $item->updated_at?->timestamp ?? time() }}"
                                         alt="{{ $item->name }}"
                                         style="width:100%;height:360px;object-fit:cover;display:block;transition:opacity 0.3s ease;">
                                    {{-- Main badge --}}
                                    <div style="position:absolute;top:14px;left:14px;background:rgba(17,24,39,0.55);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,0.15);border-radius:8px;padding:4px 10px;display:flex;align-items:center;gap:5px;">
                                        <span style="width:6px;height:6px;border-radius:50%;background:#a78bfa;display:inline-block;"></span>
                                        <span style="font-size:10px;font-weight:700;color:white;letter-spacing:0.1em;text-transform:uppercase;">Main Image</span>
                                    </div>
                                    @if($item->photos && $item->photos->count() > 0)
                                    {{-- Photo count badge --}}
                                    <div style="position:absolute;top:14px;right:14px;background:rgba(17,24,39,0.55);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,0.15);border-radius:8px;padding:4px 10px;">
                                        <span style="font-size:10px;font-weight:700;color:white;letter-spacing:0.08em;">+{{ $item->photos->count() }} photos</span>
                                    </div>
                                    @endif
                                </div>
                            @else
                                <div class="no-image">
                                    <svg class="w-12 h-12" style="opacity:0.4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    No main image available
                                </div>
                            @endif
                        </div>

                        {{-- Additional thumbnails --}}
                        @if($item->photos && $item->photos->count() > 0)
                        <div>
                            <span class="field-label" style="margin-bottom:10px;">Additional Photos</span>
                            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(80px,1fr));gap:10px;">
                                {{-- Main image thumbnail --}}
                                @if($item->image)
                                <button type="button" class="thumb-btn active" id="thumb-main"
                                        onclick="changeMainImage('{{ Storage::url($item->image) }}?v={{ $item->updated_at?->timestamp ?? time() }}', this)">
                                    <img src="{{ Storage::url($item->image) }}?v={{ $item->updated_at?->timestamp ?? time() }}" alt="Main">
                                </button>
                                @endif
                                @foreach($item->photos as $photo)
                                <button type="button" class="thumb-btn"
                                        onclick="changeMainImage('{{ Storage::url($photo->photo_path) }}?v={{ $item->updated_at?->timestamp ?? time() }}', this)">
                                    <img src="{{ Storage::url($photo->photo_path) }}?v={{ $item->updated_at?->timestamp ?? time() }}" alt="Photo">
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                </div>

                {{-- ══════════ RIGHT SIDEBAR ══════════ --}}
                <div class="sticky-sidebar" style="display:flex;flex-direction:column;gap:20px;align-self:start;">

                    {{-- ── Pricing ── --}}
                    <div class="show-card card-green fade-up d2">
                        <div class="section-label">
                            <div class="section-label-icon" style="background:linear-gradient(135deg,#d1fae5,#dbeafe);">
                                <svg class="w-4 h-4" style="color:#059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3>Pricing</h3>
                        </div>

                        {{-- Price display --}}
                        <div style="background:linear-gradient(135deg,#f0fdf4,#eff6ff);border:1.5px solid #bbf7d0;border-radius:16px;padding:16px 18px;margin-bottom:16px;">
                            <span class="field-label" style="color:#059669;margin-bottom:4px;">Selling Price</span>
                            <div style="display:flex;align-items:baseline;gap:6px;">
                                <span style="font-size:12px;font-weight:700;color:#6b7280;">Rs</span>
                                <span style="font-size:32px;font-weight:800;color:#059669;font-family:'DM Sans',sans-serif;line-height:1;">{{ number_format($item->prize, 2) }}</span>
                            </div>
                            @if($item->is_on_offer && $item->offer_percentage)
                            <div style="display:flex;align-items:center;gap:8px;margin-top:8px;">
                                <span style="font-size:12px;color:#9ca3af;text-decoration:line-through;">Rs {{ number_format($item->prize, 2) }}</span>
                                <span style="background:#dcfce7;color:#166534;font-size:11px;font-weight:700;padding:2px 8px;border-radius:99px;">{{ number_format($item->offer_percentage) }}% OFF</span>
                            </div>
                            @endif
                        </div>

                        {{-- Installments --}}
                        <p style="font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:#9ca3af;margin-bottom:10px;">Installment Plans</p>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                            <div class="installment-box inst-pink">
                                <p style="font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#f9a8d4;margin-bottom:5px;">3 Months</p>
                                <div style="display:flex;align-items:baseline;gap:3px;">
                                    <span style="font-size:10px;color:#9ca3af;font-weight:600;">Rs</span>
                                    <span style="font-size:19px;font-weight:800;color:#ec4899;font-family:'DM Sans',sans-serif;">{{ number_format(($item->discounted_price ?? $item->prize) / 3, 2) }}</span>
                                </div>
                                <p style="font-size:10px;color:#9ca3af;margin-top:2px;">per month</p>
                            </div>
                            <div class="installment-box inst-blue">
                                <p style="font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#93c5fd;margin-bottom:5px;">4 Months</p>
                                <div style="display:flex;align-items:baseline;gap:3px;">
                                    <span style="font-size:10px;color:#9ca3af;font-weight:600;">Rs</span>
                                    <span style="font-size:19px;font-weight:800;color:#3b82f6;font-family:'DM Sans',sans-serif;">{{ number_format(($item->discounted_price ?? $item->prize) / 4, 2) }}</span>
                                </div>
                                <p style="font-size:10px;color:#9ca3af;margin-top:2px;">per month</p>
                            </div>
                        </div>
                    </div>

                    {{-- ── Availability & Offers ── --}}
                    <div class="show-card card-amber fade-up d3">
                        <div class="section-label">
                            <div class="section-label-icon" style="background:linear-gradient(135deg,#fef3c7,#fce7f3);">
                                <svg class="w-4 h-4" style="color:#f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3>Status & Options</h3>
                        </div>

                        {{-- Availability --}}
                        <div class="status-badge {{ $item->availability ? 'status-in' : 'status-out' }}" style="margin-bottom:16px;">
                            @if($item->availability)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                In Stock
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Out of Stock
                            @endif
                        </div>

                        {{-- Gift Card --}}
                        @if($item->is_gift_card)
                        <div class="info-box" style="background:linear-gradient(135deg,#fdf2f8,#fff7ed);border:1.5px solid #fce7f3;margin-bottom:12px;">
                            <p class="info-box-title" style="color:#be185d;">🎁 Gift Card</p>
                            <p class="info-box-row">Validity: <span>{{ $item->gift_card_validity_months }} {{ $item->gift_card_validity_months == 1 ? 'Month' : 'Months' }}</span></p>
                        </div>
                        @endif

                        {{-- Offer --}}
                        @if($item->is_on_offer)
                        <div class="info-box" style="background:linear-gradient(135deg,#f0fdf4,#eff6ff);border:1.5px solid #bbf7d0;">
                            <p class="info-box-title" style="color:#059669;">🏷️ Active Offer</p>
                            <p class="info-box-row">Discount: <span>{{ number_format($item->offer_percentage, 2) }}%</span></p>
                            <p class="info-box-row" style="font-size:12px;color:#6b7280;margin-top:2px;">
                                {{ \Carbon\Carbon::parse($item->offer_start_date)->format('M d, Y') }}
                                &nbsp;→&nbsp;
                                {{ \Carbon\Carbon::parse($item->offer_end_date)->format('M d, Y') }}
                            </p>
                        </div>
                        @endif

                        @if(!$item->is_gift_card && !$item->is_on_offer)
                        <p style="font-size:12.5px;color:#d1d5db;text-align:center;padding:8px 0;">No special options active</p>
                        @endif
                    </div>

                    {{-- ── Inventory Value ── --}}
                    <div class="show-card card-indigo fade-up d4">
                        <div class="section-label">
                            <div class="section-label-icon" style="background:linear-gradient(135deg,#e0e7ff,#ede9fe);">
                                <svg class="w-4 h-4" style="color:#6366f1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3>Inventory Value</h3>
                        </div>

                        <div class="big-stat">
                            <span class="field-label" style="color:#6366f1;margin-bottom:6px;">Total Stock Value</span>
                            <div style="display:flex;align-items:baseline;gap:6px;margin-bottom:4px;">
                                <span style="font-size:12px;font-weight:700;color:#9ca3af;">Rs</span>
                                <span style="font-size:30px;font-weight:800;color:#4f46e5;font-family:'DM Sans',sans-serif;line-height:1;">{{ number_format($item->prize * $item->stock_items, 2) }}</span>
                            </div>
                            <p style="font-size:11.5px;color:#9ca3af;margin:0;">{{ $item->stock_items }} units × Rs {{ number_format($item->prize, 2) }}</p>
                        </div>

                        {{-- Quick stats --}}
                        <div style="display:flex;flex-direction:column;gap:8px;margin-top:14px;">
                            <div class="stat-row">
                                <span style="font-size:12px;color:#6b7280;">Created</span>
                                <span style="font-size:12.5px;font-weight:700;color:#374151;">{{ $item->created_at?->format('M d, Y') ?? '—' }}</span>
                            </div>
                            <div class="stat-row">
                                <span style="font-size:12px;color:#6b7280;">Last Updated</span>
                                <span style="font-size:12.5px;font-weight:700;color:#374151;">{{ $item->updated_at?->format('M d, Y') ?? '—' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- ── Action Buttons ── --}}
                    <div class="show-card fade-up d5" style="background:linear-gradient(135deg,#fdf2f8,#eff6ff);border-color:rgba(244,114,182,0.15);">
                        <div style="display:flex;flex-direction:column;gap:10px;">
                            <a href="{{ route('items.edit', $item->id) }}"
                               style="width:100%;padding:14px;background:linear-gradient(135deg,#ec4899,#3b82f6);color:white;font-family:'DM Sans',sans-serif;font-weight:700;font-size:14px;border:none;border-radius:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 6px 24px rgba(236,72,153,0.3);transition:all 0.25s cubic-bezier(.34,1.56,.64,1);text-decoration:none;"
                               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 10px 32px rgba(236,72,153,0.4)'"
                               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 6px 24px rgba(236,72,153,0.3)'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Item
                            </a>
                            <a href="{{ route('items.index') }}"
                               style="width:100%;padding:13px;background:white;color:#6b7280;font-family:'DM Sans',sans-serif;font-weight:600;font-size:14px;border:1.5px solid #e5e7eb;border-radius:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;text-decoration:none;transition:all 0.2s ease;"
                               onmouseover="this.style.borderColor='#9ca3af';this.style.background='#f9fafb'"
                               onmouseout="this.style.borderColor='#e5e7eb';this.style.background='white'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                                Back to Inventory
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        function changeMainImage(url, thumbEl) {
            const main = document.getElementById('main-image');
            if (!main) return;
            main.style.opacity = '0.6';
            setTimeout(() => {
                main.src = url;
                main.style.opacity = '1';
            }, 180);
            // Update active thumb
            document.querySelectorAll('.thumb-btn').forEach(b => b.classList.remove('active'));
            if (thumbEl) thumbEl.classList.add('active');
        }
    </script>
</x-app-layout>