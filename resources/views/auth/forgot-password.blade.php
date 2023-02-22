<x-app-layout>

    <div class="flex flex-col sm:justify-center items-center mt-0 sm:mt-20 pt-6 sm:pt-0">

        <section class="card w-full sm:max-w-md bg-base-100 shadow-xl">

            <div class="card-body">
                <div class="mb-4 prose-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label" for="email">
                            <span class="label-text">{{ __('Email') }}</span>
                        </label>
                        <input type="email" name="email" id="email" placeholder="{{ __('Email') }}"
                            class="input input-bordered w-full" value="{{ old('email') }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>
