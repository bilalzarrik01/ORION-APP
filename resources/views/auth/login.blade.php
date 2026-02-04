<x-guest-layout>
    <div class="auth-shell">
        <section class="auth-hero">
            <div class="auth-hero-content">
                <div class="flex items-center gap-3">
                    <img class="brand-logo" src="{{ asset('images/logo.png') }}" alt="Odin logo">
                    <span class="brand text-sm">Orion</span>
                </div>

                <h1 class="auth-title">
                    Vision Vault - Atlas Edition
                </h1>
                <p class="text-muted">
                    Curate, protect, and retrieve your most valuable links in a single cinematic workspace.
                </p>
            </div>

            <div class="auth-hero-content">
                <div class="meta-row"><span>Links Stored</span><strong>1,248</strong></div>
                <div class="meta-row"><span>Tags Linked</span><strong>356</strong></div>
                <div class="meta-row"><span>Protected</span><strong>Active</strong></div>
            </div>
        </section>

        <section class="auth-card">
            <div class="auth-tabs">
                <a class="auth-tab active" href="{{ route('login') }}">Sign in</a>
                <a class="auth-tab" href="{{ route('register') }}">Sign up</a>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label class="text-muted" for="email" :value="__('Email address')" />
                    <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label class="text-muted" for="password" :value="__('Password')" />
                    <x-text-input id="password" class="auth-input"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex flex-wrap items-center justify-between gap-4 text-sm">
                    <label for="remember_me" class="inline-flex items-center text-muted">
                        <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-neutral-700 bg-neutral-900 text-white focus:ring-neutral-500" name="remember">
                        <span class="ms-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="font-semibold text-white underline decoration-white/40 decoration-2 underline-offset-4 transition hover:text-muted" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <x-primary-button class="auth-submit">
                    {{ __('Log in') }}
                </x-primary-button>
            </form>
        </section>
    </div>
</x-guest-layout>
