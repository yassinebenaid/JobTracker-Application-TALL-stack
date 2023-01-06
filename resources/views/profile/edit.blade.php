<x-app-layout>

    <div class="sticky top-0">
        @include('includes.header')
    </div>

    <div class="py-12 ">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="w-full max-w-xl ">
                    @include('profile.partials.update-photo')
                </div>
            </div>
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            @emploee
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-job')
                    </div>
                </div>
            @endemploee

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-bio')
                </div>
            </div>

            @emploee
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-education')
                    </div>
                </div>
            @endemploee

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
