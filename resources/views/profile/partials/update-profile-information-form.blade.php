<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-control w-full">
            <label class="label" for="first_name">
                <span class="label-text">{{ __('First Name') }}</span>
            </label>
            <input type="text" name="first_name" id="first_name" placeholder="{{ __('First Name') }}" required
                class="input input-bordered w-full" value="{{ old('first_name', $user->first_name) }}" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <div class="form-control w-full mt-2">
            <label class="label" for="last_name">
                <span class="label-text">{{ __('Last Name') }}</span>
            </label>
            <input type="text" name="last_name" id="last_name" placeholder="{{ __('Last Name') }}" required
                class="input input-bordered w-full" value="{{ old('last_name', $user->last_name) }}" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <div class="form-control w-full mt-2">
            <label class="label" for="username">
                <span class="label-text">{{ __('Username') }}</span>
            </label>
            <input type="text" name="username" id="username" placeholder="{{ __('Username') }}" required
                class="input input-bordered w-full input-disabled" value="{{ old('username', $user->username) }}" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="form-control w-full mt-2">
            <label class="label" for="email">
                <span class="label-text">{{ __('Email') }}</span>
            </label>
            <input type="text" name="email" id="email" placeholder="{{ __('Email') }}" required
                class="input input-bordered w-full" value="{{ old('email', $user->email) }}" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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
