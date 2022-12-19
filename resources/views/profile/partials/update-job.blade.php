<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Job Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your job information .') }}
        </p>
    </header>


    <form method="post" action="{{ route('profile.job.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="job" :value="__('Job Title')" />
            <x-text-input id="job" name="job" type="text" class="block w-full mt-1" :value="old('job', $user->profile->job)" required
                autocomplete="job" />
            <x-input-error class="mt-2" :messages="$errors->get('job')" />
        </div>

        <div>
            <x-input-label for="experience_years" :value="__('Experience Years')" />
            <x-text-input id="experience_years" name="experience_years" type="text" class="block w-full mt-1"
                :value="old('experience_years', $user->profile->experience_years)" required autocomplete="experience_years" />
            <x-input-error class="mt-2" :messages="$errors->get('experience_years')" />
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
