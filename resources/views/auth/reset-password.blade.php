<x-app-layout>

    <div class="flex flex-col sm:justify-center items-center mt-0 sm:mt-20 pt-6 sm:pt-0">

        <section class="card w-full sm:max-w-md bg-base-100 shadow-xl">

            <div class="card-body">

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="form-control w-full">
                        <label class="label" for="email">
                            <span class="label-text">{{ __('Email') }}</span>
                        </label>
                        <input type="email" name="email" id="email" placeholder="{{ __('Email') }}"
                            class="input input-bordered w-full" value="{{ old('email') }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-control w-full mt-4">
                        <label class="label" for="password">
                            <span class="label-text">{{ __('Password') }}</span>
                        </label>
                        <input type="password" name="password" id="password" placeholder="{{ __('Password') }}"
                            class="input input-bordered w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-control w-full mt-4">
                        <label class="label" for="password_confirmation">
                            <span class="label-text">{{ __('Confirm Password') }}</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="{{ __('Confirm Password') }}" required class="input input-bordered w-full" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>
