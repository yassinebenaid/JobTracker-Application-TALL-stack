<x-app-layout>
    @include('includes.header')

    <div class="container relative grid gap-2 m-auto md:grid-cols-2 ">

        <div class="col-span-2 py-6 m-4 text-3xl font-semibold border-b text-sky-600">
            Wishlist ({{ $jobs->count() }})
        </div>

        @if ($jobs->isNotEmpty())
            @include('job.list', ['jobs' => $jobs ?? collect()])
        @else
            <div class="w-full col-span-2 text-ce">
                <x-status.info size="6">
                    Add Jobs to your wishlist to be appeared here
                </x-status.info>
            </div>
        @endif
    </div>

</x-app-layout>
