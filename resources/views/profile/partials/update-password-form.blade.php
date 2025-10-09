<section class="glass-card p-4 p-md-5 shadow-hover mt-4">
    <header class="mb-4">
        <h2 class="card-title text-gradient mb-2">
            {{ __('Update Password') }}
        </h2>

        <p class="text-muted">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="mb-4">
            <label for="update_password_current_password" class="form-label fw-semibold">
                {{ __('Current Password') }}
            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="form-control"
                autocomplete="current-password"
                required
            >
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger small" />
        </div>

        <!-- New Password -->
        <div class="mb-4">
            <label for="update_password_password" class="form-label fw-semibold">
                {{ __('New Password') }}
            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                class="form-control"
                autocomplete="new-password"
                required
            >
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger small" />
        </div>

        <!-- Confirm New Password -->
        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-semibold">
                {{ __('Confirm New Password') }}
            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control"
                autocomplete="new-password"
                required
            >
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger small" />
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary add-to-cart-btn">
                <i class="bi bi-key-fill me-2"></i> {{ __('Save Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small fw-semibold mb-0"
                >
                    {{ __('Saved!') }}
                </p>
            @endif
        </div>
    </form>
</section>
