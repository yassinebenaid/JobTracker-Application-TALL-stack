<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Education Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your education information .') }}
        </p>
    </header>


    <form method="post" action="{{ route('profile.education.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="degree" :value="__('Degree')" />
            <x-text-input id="degree" name="degree" type="text" class="block w-full mt-1" :value="old('degree', $user->profile->degree)" required
                autocomplete="degree" />
            <x-input-error class="mt-2" :messages="$errors->get('degree')" />
        </div>

        <div>
            <x-input-label for="school" :value="__('School')" />
            <x-text-input id="school" name="school" type="text" class="block w-full mt-1" :value="old('school', $user->profile->school)"
                required autocomplete="school" />
            <x-input-error class="mt-2" :messages="$errors->get('school')" />
        </div>

        <div>
            <x-input-label for="degree_year" :value="__('Degree Year')" />
            <x-text-input id="degree_year" name="degree_year" type="date" class="block w-full mt-1" :value="old('degree_year', $user->profile->degree_year)"
                required autocomplete="degree_year" />
            <x-input-error class="mt-2" :messages="$errors->get('degree_year')" />
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
