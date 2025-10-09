<section class="glass-card p-4 p-md-5 shadow-hover mt-4">
    <header class="mb-4">
        <h2 class="card-title text-gradient mb-2">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Email Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
            <input 
                id="name"
                name="name"
                type="text"
                class="form-control"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            >
            <x-input-error class="mt-2 text-danger small" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
            <input 
                id="email"
                name="email"
                type="email"
                class="form-control"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            >
            <x-input-error class="mt-2 text-danger small" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-3 p-3 rounded-3" role="alert">
                    <p class="mb-2">
                        {{ __('Your email address is unverified.') }}
                        <button 
                            form="send-verification"
                            class="btn btn-outline-primary btn-sm ms-2"
                        >
                            {{ __('Re-send verification email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small fw-semibold mb-0">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary add-to-cart-btn">
                <i class="bi bi-save me-2"></i> {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
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
