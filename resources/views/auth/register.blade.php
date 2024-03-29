<x-app-layout>

    <div class="flex flex-col sm:justify-center items-center mt-0 sm:mt-20 pt-6 sm:pt-0">

        <section class="card w-full sm:max-w-md bg-base-100 shadow-xl">

            <div class="card-body">

                <h2 class="text-3xl mb-4 text-center">Register</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label" for="first_name">
                            <span class="label-text">{{ __('First Name') }}</span>
                        </label>
                        <input type="text" name="first_name" id="first_name" placeholder="{{ __('First Name') }}" required
                            class="input input-bordered w-full" value="{{ old('first_name') }}" />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label" for="last_name">
                            <span class="label-text">{{ __('Last Name') }}</span>
                        </label>
                        <input type="text" name="last_name" id="last_name" placeholder="{{ __('Last Name') }}" required
                            class="input input-bordered w-full" value="{{ old('last_name') }}" />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label" for="username">
                            <span class="label-text">{{ __('Username') }}</span>
                        </label>
                        <input type="text" name="username" id="username" placeholder="{{ __('Username') }}" required
                            class="input input-bordered w-full" value="{{ old('username') }}" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label" for="email">
                            <span class="label-text">{{ __('Email') }}</span>
                        </label>
                        <input type="email" name="email" id="email" placeholder="{{ __('Email') }}" required
                            class="input input-bordered w-full" value="{{ old('email') }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label" for="password">
                            <span class="label-text">{{ __('Password') }}</span>
                        </label>
                        <input type="password" name="password" id="password" placeholder="{{ __('Password') }}"
                            required class="input input-bordered w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label" for="password_confirmation">
                            <span class="label-text">{{ __('Confirm Password') }}</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="{{ __('Confirm Password') }}" required class="input input-bordered w-full" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-2">
                        <a class="link" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button type="submit" class="btn btn-primary ml-4">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

            </div>

        </section>
    </div>
</x-app-layout>
