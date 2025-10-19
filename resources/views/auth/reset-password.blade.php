<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card border-1 rounded-4 p-5"
             style="max-width: 450px; background-color: var(--white); border-color: var(--border-color);">

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label" style="color: var(--text-primary);">
                        {{ __('Email') }}
                    </label>
                    <input id="email" type="email" name="email" required autofocus autocomplete="username"
                           class="form-control border"
                           value="{{ old('email', $request->email) }}"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('email')" class="form-text text-danger mt-1" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label" style="color: var(--text-primary);">
                        {{ __('Password') }}
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="form-control border"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('password')" class="form-text text-danger mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label" style="color: var(--text-primary);">
                        {{ __('Confirm Password') }}
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="form-control border"
                           style="border-color: var(--border-color);">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="form-text text-danger mt-1" />
                </div>

                <!-- Submit Button -->
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary text-white fw-bold"
                            style="background-color: var(--primary-color); border-color: var(--primary-color);">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
