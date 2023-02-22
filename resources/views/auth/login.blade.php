<x-app-layout>

    <div class="flex flex-col sm:justify-center items-center mt-0 sm:mt-20 pt-6 sm:pt-0">

        <section class="card w-full sm:max-w-md bg-base-100 shadow-xl">

            <div class="card-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <h2 class="text-3xl mb-4 text-center">Login</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label" for="email">
                            <span class="label-text">{{ __('Email') }}</span>
                        </label>
                        <input type="email" name="email" id="email" placeholder="{{ __('Email') }}"
                            class="input input-bordered w-full" value="{{ old('email') }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label" for="password">
                            <span class="label-text">{{ __('Password') }}</span>
                        </label>
                        <input type="password" name="password" id="password" placeholder="{{ __('Password') }}"
                            class="input input-bordered w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="form-control inline-flex mt-4">
                        <label class="label cursor-pointer">
                            <span class="label-text mr-2">{{ __('Remember me') }}</span>
                            <input type="checkbox" checked="checked" class="checkbox" name="remember" />
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="link mr-2 text-sm" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button class="btn btn-primary" type="submit">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div>
        </section>

    </div>
</x-app-layout>
