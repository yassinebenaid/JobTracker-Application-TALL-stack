<section>

    @emploee
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Bio') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Update your biography .') }}
            </p>
        </header>
    @endemploee

    @entrepreneur
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('About') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Update your company description .') }}
            </p>
        </header>
    @endentrepreneur

    <form method="post" action="{{ route('profile.bio.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <textarea id="bio" name="bio" type="text"
                class="block w-full mt-1 rounded-lg border-slate-200 h-80 focus:ring-sky-500 focus:border-sky-500"
                autocomplete="bio">{{ old('bio', $user->profile->bio) }}</textarea>

            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>



        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
