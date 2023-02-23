<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your profile image.") }}
        </p>
    </header>

    <form method="post" enctype="multipart/form-data" action="{{ route('profile.updateImage') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- <div class="form-group row">
            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile Image</label>
            <div class="col-md-6">
                <input id="profile_image" type="file" class="form-control" name="profile_image">
                @if (auth()->user()->image)
                    <code>{{ auth()->user()->image }}</code>
                @endif
            </div>
        </div> --}}

        <div class="form-control w-full">
            <label class="label" for="profile_image">
                <span class="label-text">{{ __('Profile Image') }}</span>
            </label>
            <input type="file" name="profile_image" id="profile_image" placeholder="{{ __('Profile Image') }}" required
                class="input file-input file-input-bordered w-full" accept="image/jpg,image/png,image/jpeg" value="{{ old('profile_image', $user->profile_image) }}" />
            <x-input-error :messages="$errors->get('profile_image')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Upload') }}
            </button>

            @if (session('status') === 'profile-image-updated')
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
