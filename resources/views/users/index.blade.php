<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">User Management</span>
            </h2>
            <a href="{{ route('users.create') }}"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-blue-500 hover:from-pink-600 hover:to-blue-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-pink-200/50 hover:shadow-pink-300/60 hover:scale-105 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add New User
            </a>
        </div>
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

        /* ── Panel ── */
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
            background: linear-gradient(90deg, #f9a8d4, #93c5fd, #c4b5fd);
        }

        /* ── Table ── */
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: linear-gradient(135deg, #fdf2f8, #eff6ff); }
        th {
            padding: 13px 20px;
            font-size: 10.5px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.1em;
            color: #9ca3af; text-align: left;
        }
        th:last-child { text-align: right; padding-right: 24px; }

        tbody tr { border-top: 1px solid #f3e8ff; transition: background 0.15s ease; }
        tbody tr:hover { background: linear-gradient(135deg, #fdf9ff, #f0f9ff); }
        td { padding: 15px 20px; font-size: 13.5px; color: #374151; vertical-align: middle; }
        td:last-child { text-align: right; padding-right: 24px; }

        /* ── Avatar ── */
        .user-avatar {
            width: 36px; height: 36px; border-radius: 12px;
            background: linear-gradient(135deg, #f9a8d4, #93c5fd);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 800; color: white;
            flex-shrink: 0;
            box-shadow: 0 2px 10px rgba(244,114,182,0.25);
        }

        /* ── Badges ── */
        .user-name { font-weight: 700; color: #1f2937; }
        .user-email {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 12.5px; color: #6b7280;
        }
        .date-badge {
            display: inline-flex; align-items: center; gap: 5px;
            background: #f3f4f6; border-radius: 8px;
            padding: 4px 10px; font-size: 12px; font-weight: 600; color: #6b7280;
        }

        /* ── Action buttons ── */
        .btn-edit {
            padding: 6px 13px; font-size: 12px; font-weight: 700;
            border-radius: 8px; border: 1.5px solid #fde68a;
            background: #fffbeb; color: #92400e; cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: all 0.18s ease;
            display: inline-flex; align-items: center; gap: 5px; text-decoration: none;
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

        /* ── Count badge ── */
        .count-badge {
            display: inline-flex; align-items: center; gap: 4px;
            background: linear-gradient(135deg, #fdf2f8, #eff6ff);
            border: 1px solid #e8d5f0; border-radius: 99px;
            padding: 3px 10px; font-size: 11px; font-weight: 700; color: #be185d;
        }

        /* ── Section icon ── */
        .section-icon {
            width: 32px; height: 32px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
    </style>

    <div class="root" style="background: linear-gradient(135deg,#fdf2f8 0%,#f0f9ff 55%,#fdf4ff 100%); min-height: calc(100vh - 64px); padding: 28px 16px 60px;">
        <div style="max-width: 1000px; margin: 0 auto;">

            {{-- ── Dark Hero Bar ── --}}
            <div class="fade-up d1" style="margin-bottom:24px;position:relative;border-radius:24px;overflow:hidden;padding:26px 32px;background:linear-gradient(135deg,#130826,#1e0d4a,#0a1628);box-shadow:0 20px 60px rgba(13,5,32,0.3);">
                <div style="position:absolute;top:-40px;right:-30px;width:180px;height:180px;background:radial-gradient(circle,rgba(96,165,250,0.18) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-20px;left:40%;width:140px;height:140px;background:radial-gradient(circle,rgba(244,114,182,0.12) 0%,transparent 70%);pointer-events:none;"></div>

                <div style="position:relative;z-index:1;display:flex;align-items:center;gap:18px;flex-wrap:wrap;">
                    <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(96,165,250,0.25),rgba(167,139,250,0.18));border:1px solid rgba(96,165,250,0.3);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg class="w-5 h-5" style="color:#93c5fd;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <p style="color:rgba(147,197,253,0.6);font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.3em;margin:0 0 3px;font-family:'DM Sans',sans-serif;">✦ System · Administration</p>
                        <h1 style="color:white;font-size:20px;font-weight:700;margin:0;font-family:'Playfair Display',serif;">User Management</h1>
                        <p style="color:rgba(255,255,255,0.32);font-size:12px;margin:3px 0 0;font-family:'DM Sans',sans-serif;">Manage access and accounts for your team</p>
                    </div>
                    <div style="flex-shrink:0;display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                        <span class="count-badge">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $users->count() }} {{ Str::plural('user', $users->count()) }}
                        </span>
                        <!-- <a href="{{ route('users.create') }}"
                           style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);color:white;font-family:'DM Sans',sans-serif;font-weight:700;font-size:12px;border-radius:10px;text-decoration:none;transition:all 0.2s ease;backdrop-filter:blur(4px);"
                           onmouseover="this.style.background='rgba(255,255,255,0.18)';this.style.borderColor='rgba(255,255,255,0.3)'"
                           onmouseout="this.style.background='rgba(255,255,255,0.1)';this.style.borderColor='rgba(255,255,255,0.15)'">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add User
                        </a> -->
                    </div>
                </div>
            </div>

            {{-- ── Flash message ── --}}
            @if(session('success'))
            <div class="fade-up d1" style="margin-bottom:16px;background:#f0fdf4;border:1.5px solid #bbf7d0;border-radius:14px;padding:12px 18px;display:flex;align-items:center;gap:10px;">
                <svg class="w-4 h-4" style="color:#059669;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                <span style="font-size:13.5px;font-weight:600;color:#065f46;">{{ session('success') }}</span>
            </div>
            @endif

            {{-- ── Users Table ── --}}
            <div class="panel fade-up d2">
                <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 24px 14px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="section-icon" style="background:linear-gradient(135deg,#dbeafe,#ede9fe);">
                            <svg class="w-4 h-4" style="color:#60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </div>
                        <h3 style="font-family:'Playfair Display',serif;font-size:15px;font-weight:600;color:#1f2937;margin:0;">All Users</h3>
                    </div>
                    <span style="font-size:11px;color:#9ca3af;background:#f3f4f6;padding:3px 10px;border-radius:99px;font-weight:600;">
                        {{ $users->count() }} total
                    </span>
                </div>

                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                            <tr>
                                <th style="padding-left:24px;">User</th>
                                <th>Email</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                {{-- User --}}
                                <td style="padding-left:24px;">
                                    <div style="display:flex;align-items:center;gap:12px;">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="user-name" style="margin:0;font-size:13.5px;">{{ $user->name }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Email --}}
                                <td>
                                    <span class="user-email">
                                        <svg class="w-3.5 h-3.5" style="color:#c4b5d4;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $user->email }}
                                    </span>
                                </td>

                                {{-- Joined --}}
                                <td>
                                    <span class="date-badge">
                                        <svg class="w-3 h-3" style="color:#c4b5d4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $user->created_at->format('M d, Y') }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td>
                                    <div style="display:flex;justify-content:flex-end;gap:8px;">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                              onsubmit="return confirm('Delete {{ $user->name }}? This cannot be undone.')"
                                              style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div style="padding:60px 20px;text-align:center;">
                                        <div style="width:56px;height:56px;border-radius:18px;background:linear-gradient(135deg,#dbeafe,#ede9fe);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                                            <svg class="w-6 h-6" style="color:#c4b5d4;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <p style="font-family:'Playfair Display',serif;font-size:16px;font-weight:600;color:#374151;margin-bottom:5px;">No users yet</p>
                                        <p style="font-size:12.5px;color:#9ca3af;margin-bottom:16px;">Add the first user to get started</p>
                                        <a href="{{ route('users.create') }}"
                                           style="display:inline-flex;align-items:center;gap:7px;padding:10px 22px;background:linear-gradient(135deg,#ec4899,#3b82f6);color:white;font-family:'DM Sans',sans-serif;font-weight:700;font-size:13px;border-radius:12px;text-decoration:none;box-shadow:0 4px 16px rgba(236,72,153,0.28);">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Add First User
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer row --}}
                @if($users->count() > 0)
                <div style="padding:14px 24px;background:linear-gradient(135deg,#fdf9ff,#f0f9ff);border-top:1px solid #f3e8ff;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                    <p style="font-size:12.5px;color:#9ca3af;margin:0;display:flex;align-items:center;gap:6px;">
                        <svg class="w-3.5 h-3.5" style="color:#d8b4fe;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Showing all <span style="font-weight:700;color:#be185d;margin:0 3px;">{{ $users->count() }}</span> registered {{ Str::plural('user', $users->count()) }}
                    </p>
                    <span style="font-size:11px;color:#c4b5d4;font-weight:600;letter-spacing:0.05em;">✦ User Management</span>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>