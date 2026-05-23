<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Update Profile Photos') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Upload a custom profile photo and background photo for your account.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.photos.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="profile_photo" :value="__('Profile Photo')" class="text-gray-300" />
            <input id="profile_photo" name="profile_photo" type="file" class="mt-1 block w-full text-sm text-gray-400
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-emerald-500/10 file:text-emerald-400
                hover:file:bg-emerald-500/20" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-input-label for="background_photo" :value="__('Background Photo')" class="text-gray-300" />
            <input id="background_photo" name="background_photo" type="file" class="mt-1 block w-full text-sm text-gray-400
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-emerald-500/10 file:text-emerald-400
                hover:file:bg-emerald-500/20" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('background_photo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-emerald-600 hover:bg-emerald-500">{{ __('Save Photos') }}</x-primary-button>

            @if (session('status') === 'photos-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
