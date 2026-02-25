<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-pink-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Edit User</span>
            </h2>
        </div>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        .root { font-family: 'DM Sans', sans-serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.5s ease forwards; }
        .d1 { animation-delay: 0.05s; }
        .d2 { animation-delay: 0.12s; }
        .d3 { animation-delay: 0.19s; }
        .d4 { animation-delay: 0.26s; }

        /* ── Cards ── */
        .form-card {
            background: white; border-radius: 24px;
            border: 1px solid rgba(244,114,182,0.12);
            box-shadow: 0 2px 24px rgba(244,114,182,0.06), 0 1px 4px rgba(0,0,0,0.04);
            padding: 28px; position: relative; overflow: hidden;
        }
        .form-card::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 3px;
            border-radius: 24px 24px 0 0;
        }
        .card-pink::before  { background: linear-gradient(90deg, #f9a8d4, #93c5fd); }
        .card-blue::before  { background: linear-gradient(90deg, #93c5fd, #c4b5fd); }
        .card-amber::before { background: linear-gradient(90deg, #fcd34d, #f9a8d4); }

        /* ── Section labels ── */
        .section-label { display: flex; align-items: center; gap: 10px; margin-bottom: 22px; }
        .section-label-icon {
            width: 34px; height: 34px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .section-label h3 {
            font-family: 'Playfair Display', serif;
            font-size: 16px; font-weight: 600; color: #1f2937; margin: 0;
        }

        /* ── Field labels ── */
        .field-label {
            display: block; font-size: 11.5px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: #515151; margin-bottom: 7px;
        }
        .field-label .req { color: #f472b6; margin-left: 2px; }

        /* ── Inputs ── */
        .field-input {
            width: 100%; padding: 10px 14px;
            border-radius: 12px; border: 1.5px solid #e8d5f0;
            font-size: 13.5px; font-family: 'DM Sans', sans-serif;
            color: #1f2937; background: white; outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            box-sizing: border-box;
        }
        .field-input:focus { border-color: #f472b6; box-shadow: 0 0 0 3px rgba(244,114,182,0.12); }
        .field-input::placeholder { color: #c4b5d4; }
        .field-input-blue:focus { border-color: #60a5fa !important; box-shadow: 0 0 0 3px rgba(96,165,250,0.12) !important; }

        /* ── Password wrapper ── */
        .pw-wrap { position: relative; }
        .pw-wrap .field-input { padding-right: 44px; }
        .pw-toggle {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: #c4b5d4;
            transition: color 0.15s ease; padding: 4px; border-radius: 6px;
        }
        .pw-toggle:hover { color: #60a5fa; }

        /* ── Strength bar ── */
        .strength-bar { height: 3px; border-radius: 99px; background: #f3f4f6; margin-top: 8px; overflow: hidden; }
        .strength-fill { height: 100%; border-radius: 99px; transition: width 0.3s ease, background 0.3s ease; width: 0%; }
        .strength-label { font-size: 11px; font-weight: 600; margin-top: 4px; }

        /* ── Match indicator ── */
        .match-indicator {
            display: flex; align-items: center; gap: 5px;
            font-size: 11.5px; font-weight: 600; margin-top: 6px;
        }

        /* ── Password section toggle ── */
        .pw-section-toggle {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px; border-radius: 14px;
            border: 1.5px solid #e8d5f0; cursor: pointer;
            transition: all 0.2s ease; margin-bottom: 16px;
        }
        .pw-section-toggle:hover { border-color: #93c5fd; background: #f0f9ff; }
        .pw-section-toggle input[type="checkbox"] { accent-color: #60a5fa; width: 16px; height: 16px; cursor: pointer; }

        /* ── Buttons ── */
        .btn-submit {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #ec4899, #3b82f6);
            color: white; font-family: 'DM Sans', sans-serif;
            font-weight: 700; font-size: 14px; border: none; border-radius: 14px;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
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

        /* ── Error alert ── */
        .error-alert {
            background: #fff1f2; border: 1.5px solid #fecdd3;
            border-radius: 16px; padding: 16px 20px;
            display: flex; gap: 12px; align-items: flex-start;
        }

        /* ── Avatar ── */
        .user-avatar {
            width: 56px; height: 56px; border-radius: 16px;
            background: linear-gradient(135deg, #f9a8d4, #93c5fd);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 800; color: white;
            box-shadow: 0 4px 16px rgba(244,114,182,0.3);
            flex-shrink: 0; transition: all 0.25s ease;
        }

        /* ── Info note ── */
        .info-note {
            display: flex; align-items: flex-start; gap: 8px;
            background: linear-gradient(135deg, #fffbeb, #fdf9ff);
            border: 1.5px solid #fde68a; border-radius: 12px;
            padding: 10px 14px; font-size: 12px; color: #92400e; font-weight: 500;
            margin-bottom: 18px;
        }

        /* ── Member since badge ── */
        .member-badge {
            display: inline-flex; align-items: center; gap: 5px;
            background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);
            border-radius: 99px; padding: 4px 10px;
            font-size: 11px; font-weight: 600; color: rgba(255,255,255,0.55);
        }

        /* ── Inline error ── */
        .field-error { font-size:12px; color:#ef4444; margin-top:5px; display:flex; align-items:center; gap:4px; }
    </style>

    <div class="root" style="background: linear-gradient(135deg,#fdf2f8 0%,#f0f9ff 55%,#fdf4ff 100%); min-height: calc(100vh - 64px); padding: 28px 16px 60px;">
        <div style="max-width: 600px; margin: 0 auto;">

            {{-- ── Dark Hero Bar ── --}}
            <div class="fade-up d1" style="margin-bottom:24px;position:relative;border-radius:24px;overflow:hidden;padding:26px 32px;background:linear-gradient(135deg,#130826,#1e0d4a,#0a1628);box-shadow:0 20px 60px rgba(13,5,32,0.3);">
                <div style="position:absolute;top:-40px;right:-30px;width:180px;height:180px;background:radial-gradient(circle,rgba(251,191,36,0.15) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-20px;left:40%;width:140px;height:140px;background:radial-gradient(circle,rgba(96,165,250,0.12) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:relative;z-index:1;display:flex;align-items:center;gap:18px;flex-wrap:wrap;">
                    <div class="user-avatar" id="heroAvatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    <div style="flex:1;min-width:0;">
                        <p style="color:rgba(251,191,36,0.6);font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.3em;margin:0 0 3px;font-family:'DM Sans',sans-serif;">✦ System · Administration · Edit</p>
                        <h1 style="color:white;font-size:20px;font-weight:700;margin:0;font-family:'Playfair Display',serif;" id="heroName">{{ $user->name }}</h1>
                        <p style="color:rgba(255,255,255,0.32);font-size:12px;margin:3px 0 0;font-family:'DM Sans',sans-serif;" id="heroEmail">{{ $user->email }}</p>
                    </div>
                    <div style="flex-shrink:0;">
                        <span class="member-badge">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Joined {{ $user->created_at->format('M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- ── Error Alert ── --}}
            @if($errors->any())
            <div class="error-alert fade-up d1" style="margin-bottom:20px;">
                <div style="width:36px;height:36px;border-radius:10px;background:#fee2e2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg class="w-4 h-4" style="color:#ef4444;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p style="font-weight:700;font-size:13.5px;color:#dc2626;margin-bottom:6px;">Please fix these errors:</p>
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

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf @method('PUT')
                <div style="display:flex;flex-direction:column;gap:18px;">

                    {{-- ── 1. User Information ── --}}
                    <div class="form-card card-pink fade-up d2">
                        <div class="section-label">
                            <div class="section-label-icon" style="background:linear-gradient(135deg,#fce7f3,#dbeafe);">
                                <svg class="w-4 h-4" style="color:#f472b6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3>User Information</h3>
                        </div>

                        {{-- Name --}}
                        <div style="margin-bottom:16px;">
                            <label class="field-label" for="name">Name <span class="req">*</span></label>
                            <input id="name" type="text" name="name"
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="Full name…"
                                   class="field-input"
                                   autofocus autocomplete="name"
                                   oninput="updateHeroPreview()">
                            @error('name')
                            <p class="field-error">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="field-label" for="email">Email <span class="req">*</span></label>
                            <input id="email" type="email" name="email"
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="email@example.com"
                                   class="field-input"
                                   autocomplete="username"
                                   oninput="updateHeroPreview()">
                            @error('email')
                            <p class="field-error">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    {{-- ── 2. Change Password ── --}}
                    <div class="form-card card-blue fade-up d3">
                        <div class="section-label" style="margin-bottom:14px;">
                            <div class="section-label-icon" style="background:linear-gradient(135deg,#dbeafe,#ede9fe);">
                                <svg class="w-4 h-4" style="color:#60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <h3>Change Password</h3>
                        </div>

                        {{-- Toggle to expand password fields --}}
                        <label class="pw-section-toggle" for="enablePwChange">
                            <input type="checkbox" id="enablePwChange" onchange="togglePasswordFields()">
                            <div>
                                <p style="font-size:13.5px;font-weight:600;color:#374151;margin:0;">Update Password</p>
                                <p style="font-size:11px;color:#9ca3af;margin:2px 0 0;">Tick to change the current password</p>
                            </div>
                        </label>

                        <div id="passwordFields" style="display:none;">
                            <div class="info-note">
                                <svg class="w-4 h-4" style="flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Leave password fields blank to keep the existing password unchanged.
                            </div>

                            {{-- Current Password --}}
                            <div style="margin-bottom:16px;">
                                <label class="field-label" for="current_password">Current Password</label>
                                <div class="pw-wrap">
                                    <input id="current_password" type="password" name="current_password"
                                           placeholder="Enter current password…"
                                           class="field-input field-input-blue"
                                           autocomplete="current-password">
                                    <button type="button" class="pw-toggle" onclick="togglePw('current_password', this)" tabindex="-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('current_password')
                                <p class="field-error">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- New Password --}}
                            <div style="margin-bottom:16px;">
                                <label class="field-label" for="password">New Password</label>
                                <div class="pw-wrap">
                                    <input id="password" type="password" name="password"
                                           placeholder="Min. 8 characters…"
                                           class="field-input field-input-blue"
                                           autocomplete="new-password"
                                           oninput="checkStrength(); checkMatch();">
                                    <button type="button" class="pw-toggle" onclick="togglePw('password', this)" tabindex="-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                                <p class="strength-label" id="strengthLabel" style="color:#9ca3af;"></p>
                                @error('password')
                                <p class="field-error">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div>
                                <label class="field-label" for="password_confirmation">Confirm New Password</label>
                                <div class="pw-wrap">
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                           placeholder="Repeat new password…"
                                           class="field-input field-input-blue"
                                           autocomplete="new-password"
                                           oninput="checkMatch()">
                                    <button type="button" class="pw-toggle" onclick="togglePw('password_confirmation', this)" tabindex="-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                                <p class="match-indicator" id="matchIndicator" style="display:none;"></p>
                                @error('password_confirmation')
                                <p class="field-error">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- ── Actions ── --}}
                    <div class="form-card fade-up d4" style="background:linear-gradient(135deg,#fdf2f8,#eff6ff);border-color:rgba(244,114,182,0.15);">
                        <div style="display:flex;flex-direction:column;gap:10px;">
                            <button type="submit" class="btn-submit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Update User
                            </button>
                            <a href="{{ route('users.index') }}" class="btn-cancel">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel
                            </a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        /* ── Live hero preview ── */
        function updateHeroPreview() {
            const name  = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            document.getElementById('heroAvatar').textContent = name ? name.charAt(0).toUpperCase() : '?';
            document.getElementById('heroName').textContent   = name  || 'User';
            document.getElementById('heroEmail').textContent  = email || '';
        }

        /* ── Toggle password section ── */
        function togglePasswordFields() {
            const fields = document.getElementById('passwordFields');
            const show   = document.getElementById('enablePwChange').checked;
            fields.style.display = show ? 'block' : 'none';
            if (!show) {
                // clear fields when hiding
                ['current_password','password','password_confirmation'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.value = '';
                });
                document.getElementById('strengthFill').style.width = '0%';
                document.getElementById('strengthLabel').textContent = '';
                document.getElementById('matchIndicator').style.display = 'none';
            }
        }

        /* ── Toggle password visibility ── */
        function togglePw(id, btn) {
            const input = document.getElementById(id);
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            btn.style.color = isText ? '#c4b5d4' : '#60a5fa';
        }

        /* ── Password strength ── */
        function checkStrength() {
            const val  = document.getElementById('password').value;
            const fill = document.getElementById('strengthFill');
            const lbl  = document.getElementById('strengthLabel');
            let score  = 0;
            if (val.length >= 8)           score++;
            if (/[A-Z]/.test(val))         score++;
            if (/[0-9]/.test(val))         score++;
            if (/[^A-Za-z0-9]/.test(val))  score++;
            const map = [
                { w:'0%',   bg:'transparent', text:'',          color:'#9ca3af' },
                { w:'25%',  bg:'#f87171',     text:'Weak',      color:'#ef4444' },
                { w:'50%',  bg:'#fbbf24',     text:'Fair',      color:'#d97706' },
                { w:'75%',  bg:'#34d399',     text:'Good',      color:'#059669' },
                { w:'100%', bg:'#10b981',     text:'Strong 🎉', color:'#047857' },
            ];
            const s = map[Math.min(score, 4)];
            fill.style.width      = val.length ? s.w  : '0%';
            fill.style.background = s.bg;
            lbl.textContent       = val.length ? s.text : '';
            lbl.style.color       = s.color;
        }

        /* ── Password match ── */
        function checkMatch() {
            const pw  = document.getElementById('password').value;
            const cpw = document.getElementById('password_confirmation').value;
            const ind = document.getElementById('matchIndicator');
            if (!cpw) { ind.style.display = 'none'; return; }
            const match = pw === cpw;
            ind.style.display = 'flex';
            ind.style.color   = match ? '#059669' : '#ef4444';
            ind.innerHTML = match
                ? `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Passwords match`
                : `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg> Passwords don't match`;
        }

        /* ── Auto-open pw fields if validation errors exist ── */
        @if($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('enablePwChange').checked = true;
            togglePasswordFields();
        });
        @endif
    </script>
</x-app-layout>