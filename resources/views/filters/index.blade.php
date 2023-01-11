<div x-data="dropdown" x-on:keyup.enter.window="hide" x-on:click.outside="hide"
    :class="{ 'border-b rounded-b-lg': !open }"
    class="container relative grid grid-cols-3 px-5 py-3 m-auto my-10 bg-white border-t rounded-t-lg border-x">


    @include('filters.partials.search')


    <div class="grid grid-cols-10 col-span-2">
        <div class="flex items-center justify-between col-span-9 px-10">
            <div x-on:click="toggle" class="cursor-pointer">
                date
                <i :class="{ 'bi-chevron-down': open, 'bi-chevron-up': !open }"
                    class="text-sm transition-all bi bi-chevron-up"></i>

            </div>
            <div x-on:click="toggle" class="cursor-pointer">
                skills
                <i :class="{ 'bi-chevron-down': open, 'bi-chevron-up': !open }" class="text-sm transition-all bi"></i>
            </div>

            <div x-on:click="toggle" class="cursor-pointer">
                salary
                <i :class="{ 'bi-chevron-down': open, 'bi-chevron-up': !open }" class="text-sm transition-all bi"></i>
            </div>
            <div x-on:click="toggle" class="cursor-pointer">
                type
                <i :class="{ 'bi-chevron-down': open, 'bi-chevron-up': !open }" class="text-sm transition-all bi"></i>
            </div>
            <div x-on:click="toggle" class="cursor-pointer">
                location
                <i :class="{ 'bi-chevron-down': open, 'bi-chevron-up': !open }" class="text-sm transition-all bi"></i>
            </div>
        </div>

        @entrepreneur
            <livewire:job.create />
        @endentrepreneur
    </div>

    <div x-show="open" x-cloak x-collapse
        class="absolute left-0 z-50 w-full p-5 bg-white border-b rounded-b-lg shadow-lg border-x top-full">

        <div class="flex justify-between ">

            @include('filters.partials.date')

            @include('filters.partials.skills')

            @include('filters.partials.salary')

            @include('filters.partials.type')

            @include('filters.partials.location')
        </div>


        <div class="flex justify-end">
            <button wire:click="filter" x-on:click="hide"
                class="px-8 py-1 font-semibold transition-all border-2 rounded-lg border-sky-500 text-sky-500 hover:bg-sky-500 hover:text-white">Filter</button>
        </div>
    </div>
</div>
