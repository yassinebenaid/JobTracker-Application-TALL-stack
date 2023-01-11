<div>
    @include('includes.header')

    <div class="container relative grid gap-2 m-auto md:grid-cols-2 ">

        <div class="flex justify-between col-span-2 py-6 m-4 border-b">
            <div class="text-3xl font-semibold text-sky-600"> My Jobs ({{ $jobs->count() }})</div>
            <div>
                <livewire:job.create />
            </div>
        </div>

        @if ($jobs->isNotEmpty())
            @include('job.list', ['jobs' => $jobs ?? collect(), 'controle' => true])
        @else
            <div class="w-full col-span-2 text-ce">
                <x-status.info size="6">
                    You didn't post any jobs yet
                </x-status.info>
            </div>
        @endif
    </div>
</div>
