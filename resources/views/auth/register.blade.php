<x-guest-layout>
    <div class="auth-shell">
        <section class="auth-hero">
            <div class="auth-hero-content">
                <div class="flex items-center gap-3">
                    <img class="brand-logo" src="{{ asset('images/logo.png') }}" alt="Odin logo">
                    <span class="brand text-sm">Orion</span>
                </div>

                <h1 class="auth-title">
                    Vision Vault - Nova Series
                </h1>
                <p class="text-muted">
                    Assemble your knowledge with cinematic precision and a vault built to endure.
                </p>
            </div>

            <div class="auth-hero-content">
                <div class="meta-row"><span>Collections</span><strong>86</strong></div>
                <div class="meta-row"><span>Focus Tags</span><strong>24</strong></div>
                <div class="meta-row"><span>Shield</span><strong>Enabled</strong></div>
            </div>
        </section>

        <section class="auth-card">
            <div class="auth-tabs">
                <a class="auth-tab" href="{{ route('login') }}">Sign in</a>
                <a class="auth-tab active" href="{{ route('register') }}">Sign up</a>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label class="text-muted" for="name" :value="__('Username')" />
                    <x-text-input id="name" class="auth-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label class="text-muted" for="email" :value="__('Email address')" />
                    <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label class="text-muted" for="password" :value="__('Password')" />
                    <x-text-input id="password" class="auth-input"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label class="text-muted" for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="auth-input"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <x-primary-button class="auth-submit">
                    {{ __('Register') }}
                </x-primary-button>
            </form>
        </section>
    </div>
</x-guest-layout>
