<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card border-1 rounded-4 p-5"
             style="max-width: 450px; background-color: var(--white); border-color: var(--border-color);">

            <h2 class="card-title text-center fw-bold mb-4"
                style="color: var(--primary-color); font-size: 2rem;">
                {{ __('Create Your Account') }}
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label" style="color: var(--text-primary);">{{ __('Name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                           class="form-control border"
                           placeholder="Enter your full name"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('name')" class="form-text text-danger mt-1" />
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label" style="color: var(--text-primary);">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                           class="form-control border"
                           placeholder="Enter your email"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('email')" class="form-text text-danger mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label" style="color: var(--text-primary);">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="form-control border"
                           placeholder="Enter your password"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('password')" class="form-text text-danger mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label" style="color: var(--text-primary);">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="form-control border"
                           placeholder="Confirm your password"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="form-text text-danger mt-1" />
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-between align-items-center mt-4">
                    <a href="{{ route('login') }}" class="text-decoration-none"
                       style="color: var(--primary-color); font-size: 0.9rem;">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="btn btn-primary w-100 w-md-auto text-white fw-bold"
                            style="background-color: var(--primary-color); border-color: var(--primary-color);">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>
