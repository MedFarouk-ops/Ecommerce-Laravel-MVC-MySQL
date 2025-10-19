<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card border-1 rounded-4 p-5"
             style="max-width: 450px; background-color: var(--white); border-color: var(--border-color);">

            <p class="mb-4" style="color: var(--text-muted); font-size: 0.95rem;">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label" style="color: var(--text-primary);">
                        {{ __('Password') }}
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="form-control border"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('password')" class="form-text text-danger mt-1" />
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary text-white fw-bold"
                            style="background-color: var(--primary-color); border-color: var(--primary-color);">
                        {{ __('Confirm') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
