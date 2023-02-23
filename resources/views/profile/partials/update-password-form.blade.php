<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-control w-full">
            <label class="label" for="current_password">
                <span class="label-text">{{ __('Current Password') }}</span>
            </label>
            <input type="current_password" name="current_password" id="current_password" placeholder="{{ __('Current Password') }}"
                required class="input input-bordered w-full" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div class="form-control w-full mt-2">
            <label class="label" for="password">
                <span class="label-text">{{ __('New Password') }}</span>
            </label>
            <input type="password" name="password" id="password" placeholder="{{ __('New Password') }}"
                required class="input input-bordered w-full" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="form-control w-full mt-2">
            <label class="label" for="password_confirmation">
                <span class="label-text">{{ __('Confirm Password') }}</span>
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                placeholder="{{ __('Confirm Password') }}" required class="input input-bordered w-full" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
