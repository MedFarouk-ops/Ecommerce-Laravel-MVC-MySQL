<section class="glass-card p-4 p-md-5 shadow-hover mt-4">
    <header class="mb-4">
        <h2 class="card-title text-gradient mb-2">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-muted">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Trigger Delete Modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        <i class="bi bi-trash3-fill me-2"></i> {{ __('Delete Account') }}
    </button>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ __('Confirm Account Deletion') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-body">
                        <p class="mb-3">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you want to permanently delete your account.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="{{ __('Enter your password') }}"
                                required
                            >
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-danger small" />
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
