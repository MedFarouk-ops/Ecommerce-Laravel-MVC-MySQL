<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card border-1 rounded-4 p-5"
             style="max-width: 450px; background-color: var(--white); border-color: var(--border-color);">

            <h2 class="card-title text-center fw-bold mb-4"
                style="color: var(--primary-color); font-size: 2rem;">
                {{ __('Forgot Your Password?') }}
            </h2>

            <p class="mb-4" style="color: var(--text-muted); font-size: 0.95rem;">
                {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label" style="color: var(--text-primary);">
                        {{ __('Email') }}
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="form-control border"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('email')" class="form-text text-danger mt-1" />
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary text-white fw-bold"
                            style="background-color: var(--primary-color); border-color: var(--primary-color);">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>
