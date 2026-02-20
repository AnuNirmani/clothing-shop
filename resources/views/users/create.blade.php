<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-pink-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800">
                <span class="bg-gradient-to-r from-pink-400 via-blue-400 to-pink-500 bg-clip-text text-transparent">Create New User</span>
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
        .field-input:focus {
            border-color: #f472b6;
            box-shadow: 0 0 0 3px rgba(244,114,182,0.12);
        }
        .field-input::placeholder { color: #c4b5d4; }

        /* Blue-tinted inputs for password card */
        .field-input-blue:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96,165,250,0.12);
        }

        /* ── Password wrapper (with toggle) ── */
        .pw-wrap { position: relative; }
        .pw-wrap .field-input { padding-right: 44px; }
        .pw-toggle {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: #c4b5d4;
            transition: color 0.15s ease; padding: 4px; border-radius: 6px;
        }
        .pw-toggle:hover { color: #60a5fa; }

        /* ── Password strength bar ── */
        .strength-bar {
            height: 3px; border-radius: 99px;
            background: #f3f4f6; margin-top: 8px; overflow: hidden;
        }
        .strength-fill {
            height: 100%; border-radius: 99px;
            transition: width 0.3s ease, background 0.3s ease;
            width: 0%;
        }
        .strength-label { font-size: 11px; font-weight: 600; margin-top: 4px; }

        /* ── Match indicator ── */
        .match-indicator {
            display: flex; align-items: center; gap: 5px;
            font-size: 11.5px; font-weight: 600; margin-top: 6px;
            transition: color 0.2s ease;
        }

        /* ── Buttons ── */
        .btn-submit {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #ec4899, #3b82f6);
            color: white; font-family: 'DM Sans', sans-serif;
            font-weight: 700; font-size: 14px;
            border: none; border-radius: 14px; cursor: pointer;
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

        /* ── Error alert ── */
        .error-alert {
            background: #fff1f2; border: 1.5px solid #fecdd3;
            border-radius: 16px; padding: 16px 20px;
            display: flex; gap: 12px; align-items: flex-start;
        }

        /* ── Avatar preview ── */
        .avatar-preview {
            width: 56px; height: 56px; border-radius: 16px;
            background: linear-gradient(135deg, #f9a8d4, #93c5fd);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 800; color: white;
            box-shadow: 0 4px 16px rgba(244,114,182,0.3);
            transition: all 0.25s ease;
            flex-shrink: 0;
        }

        /* ── Info note ── */
        .info-note {
            display: flex; align-items: flex-start; gap: 8px;
            background: linear-gradient(135deg, #eff6ff, #f5f3ff);
            border: 1.5px solid #bfdbfe; border-radius: 12px;
            padding: 10px 14px; font-size: 12px; color: #1e40af; font-weight: 500;
            margin-top: 16px;
        }
    </style>

    <div class="root" style="background: linear-gradient(135deg,#fdf2f8 0%,#f0f9ff 55%,#fdf4ff 100%); min-height: calc(100vh - 64px); padding: 28px 16px 60px;">
        <div style="max-width: 600px; margin: 0 auto;">

            {{-- ── Dark Hero Bar ── --}}
            <div class="fade-up d1" style="margin-bottom:24px;position:relative;border-radius:24px;overflow:hidden;padding:26px 32px;background:linear-gradient(135deg,#130826,#1e0d4a,#0a1628);box-shadow:0 20px 60px rgba(13,5,32,0.3);">
                <div style="position:absolute;top:-40px;right:-30px;width:180px;height:180px;background:radial-gradient(circle,rgba(96,165,250,0.18) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:absolute;bottom:-20px;left:40%;width:140px;height:140px;background:radial-gradient(circle,rgba(244,114,182,0.12) 0%,transparent 70%);pointer-events:none;"></div>
                <div style="position:relative;z-index:1;display:flex;align-items:center;gap:18px;">
                    {{-- Live avatar preview --}}
                    <div class="avatar-preview" id="heroAvatar">?</div>
                    <div>
                        <p style="color:rgba(147,197,253,0.6);font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:0.3em;margin:0 0 3px;font-family:'DM Sans',sans-serif;">✦ System · Administration</p>
                        <h1 style="color:white;font-size:20px;font-weight:700;margin:0;font-family:'Playfair Display',serif;">Create New User</h1>
                        <p style="color:rgba(255,255,255,0.32);font-size:12px;margin:3px 0 0;font-family:'DM Sans',sans-serif;" id="heroSubtitle">Fill in the details below to add a team member</p>
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

            <form method="POST" action="{{ route('users.store') }}">
                @csrf
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
                                   value="{{ old('name') }}"
                                   placeholder="Full name…"
                                   class="field-input"
                                   autofocus autocomplete="name"
                                   oninput="updateHeroPreview()">
                            @error('name')
                            <p style="font-size:12px;color:#ef4444;margin-top:5px;display:flex;align-items:center;gap:4px;">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="field-label" for="email">Email <span class="req">*</span></label>
                            <input id="email" type="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="email@example.com"
                                   class="field-input"
                                   autocomplete="username"
                                   oninput="updateHeroPreview()">
                            @error('email')
                            <p style="font-size:12px;color:#ef4444;margin-top:5px;display:flex;align-items:center;gap:4px;">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    {{-- ── 2. Set Password ── --}}
                    <div class="form-card card-blue fade-up d3">
                        <div class="section-label">
                            <div class="section-label-icon" style="background:linear-gradient(135deg,#dbeafe,#ede9fe);">
                                <svg class="w-4 h-4" style="color:#60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <h3>Set Password</h3>
                        </div>

                        {{-- Password --}}
                        <div style="margin-bottom:16px;">
                            <label class="field-label" for="password">Password <span class="req">*</span></label>
                            <div class="pw-wrap">
                                <input id="password" type="password" name="password"
                                       placeholder="Min. 8 characters…"
                                       class="field-input field-input-blue"
                                       autocomplete="new-password"
                                       oninput="checkStrength(); checkMatch();">
                                <button type="button" class="pw-toggle" onclick="togglePw('password', this)" tabindex="-1">
                                    <svg class="w-4 h-4 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            {{-- Strength bar --}}
                            <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                            <p class="strength-label" id="strengthLabel" style="color:#9ca3af;"></p>
                            @error('password')
                            <p style="font-size:12px;color:#ef4444;margin-top:5px;display:flex;align-items:center;gap:4px;">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label class="field-label" for="password_confirmation">Confirm Password <span class="req">*</span></label>
                            <div class="pw-wrap">
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                       placeholder="Repeat password…"
                                       class="field-input field-input-blue"
                                       autocomplete="new-password"
                                       oninput="checkMatch()">
                                <button type="button" class="pw-toggle" onclick="togglePw('password_confirmation', this)" tabindex="-1">
                                    <svg class="w-4 h-4 eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="match-indicator" id="matchIndicator" style="display:none;"></p>
                            @error('password_confirmation')
                            <p style="font-size:12px;color:#ef4444;margin-top:5px;display:flex;align-items:center;gap:4px;">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="info-note">
                            <svg class="w-4 h-4" style="flex-shrink:0;margin-top:1px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Use at least 8 characters with a mix of letters, numbers, and symbols for a strong password.
                        </div>
                    </div>

                    {{-- ── Actions ── --}}
                    <div class="form-card fade-up d4" style="background:linear-gradient(135deg,#fdf2f8,#eff6ff);border-color:rgba(244,114,182,0.15);">
                        <div style="display:flex;flex-direction:column;gap:10px;">
                            <button type="submit" class="btn-submit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                Create User
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
            const avatar  = document.getElementById('heroAvatar');
            const subtitle = document.getElementById('heroSubtitle');
            avatar.textContent = name ? name.charAt(0).toUpperCase() : '?';
            subtitle.textContent = name ? name + (email ? ' · ' + email : '') : 'Fill in the details below to add a team member';
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
            if (val.length >= 8)  score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const map = [
                { w: '0%',   bg: 'transparent', text: '',           color: '#9ca3af' },
                { w: '25%',  bg: '#f87171',      text: 'Weak',       color: '#ef4444' },
                { w: '50%',  bg: '#fbbf24',      text: 'Fair',       color: '#d97706' },
                { w: '75%',  bg: '#34d399',      text: 'Good',       color: '#059669' },
                { w: '100%', bg: '#10b981',      text: 'Strong 🎉',  color: '#047857' },
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
    </script>
</x-app-layout>