<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="btn btn-error text-error-content" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</button>


    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="form-control w-full mt-2">
                <label class="label" for="password">
                    <span class="label-text">{{ __('Password') }}</span>
                </label>
                <input type="password" name="password" id="password" placeholder="{{ __('Password') }}"
                    required class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <button class="btn btn-secondary text-secondary-content" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>

                <button class="ml-3 btn btn-error text-error-content">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
