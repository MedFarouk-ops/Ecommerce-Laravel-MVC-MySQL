<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card border-1 rounded-4 p-4 p-md-5"
             style="max-width: 420px; background-color: var(--white); border-color: var(--border-color);">

            <h2 class="card-title text-center fw-bold mb-4"
                style="color: var(--primary-color); font-size: 2rem;">
                {{ __('Login to Your Account') }}
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label" style="color: var(--text-primary);">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="form-control border"
                           placeholder="Enter your email"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('email')" class="form-text text-danger mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label" style="color: var(--text-primary);">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="form-control border"
                           placeholder="Enter your password"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('password')" class="form-text text-danger mt-1" />
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me" style="color: var(--text-primary);">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-between align-items-center mb-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none"
                           style="color: var(--primary-color);">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit"
                            class="btn btn-primary w-100 w-md-auto text-white fw-bold"
                            style="background-color: var(--primary-color); border-color: var(--primary-color);">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            <p class="text-center mt-3" style="color: var(--text-muted);">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="fw-semibold text-decoration-none"
                   style="color: var(--primary-color);">
                    {{ __('Register here') }}
                </a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>
