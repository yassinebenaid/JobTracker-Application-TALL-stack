<div x-data="dropdown" x-on:keyup.enter.window="hide" x-on:click.outside="hide"
    :class="{ 'border-b rounded-b-lg': !open }"
    class="container relative grid grid-cols-3 px-5 py-3 m-auto my-10 bg-white border-t rounded-t-lg border-x">


    <div class="relative">
        <input type="search" wire:model.defer="filters.keywords" wire:keyup.enter='filter'
            x-on:keyup.window="($event.key === '/' || $event.key === ':') ? $el.focus() : ''"
            class="w-full pl-20 border-gray-100 rounded-lg focus:shadow focus:ring-0 focus:border-sky-300 placeholder:text-slate-400"
            placeholder="press / to search ...">
        <i class="absolute text-xl text-gray-400 -translate-y-1/2 bi bi-search top-1/2 left-5"></i>
    </div>

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
            <div x-data="dropdown" class="px-4 justify-self-end">
                <i x-on:click="toggle"
                    class="text-4xl transition-all cursor-pointer hover:opacity-60 bi bi-plus-circle text-sky-500"></i>

                <livewire:home.create-job-form />

            </div>
        @endentrepreneur
    </div>

    <div x-show="open" x-cloak x-collapse
        class="absolute left-0 z-50 w-full p-5 bg-white border-b rounded-b-lg shadow-lg border-x top-full">

        <div class="flex justify-between ">

            <div>
                <div class="text-sm font-semibold">Date</div>
                <div class="flex flex-col gap-4 p-4 ">
                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
                        <label class="col-span-4 cursor-pointer" for="anytime"> Any time</label>
                        <input wire:model.defer='filters.date' value="anytime" id="anytime"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio"
                            name="date">
                    </div>
                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
                        <label class="col-span-4 cursor-pointer" for="today"> Today</label>
                        <input wire:model.defer='filters.date' value="today" id="today"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio"
                            name="date">
                    </div>
                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
                        <label class="col-span-4 cursor-pointer" for="week"> Current week</label>
                        <input wire:model.defer='filters.date' value="week" id="week"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio"
                            name="date">
                    </div>
                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
                        <label class="col-span-4 cursor-pointer" for="month"> This month</label>
                        <input wire:model.defer='filters.date' value="month" id="month"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio"
                            name="date">
                    </div>
                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
                        <label class="col-span-4 cursor-pointer" for="year"> This Year</label>
                        <input wire:model.defer='filters.date' value="year" id="year"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio"
                            name="date">
                    </div>
                </div>
            </div>

            <div>
                <div class="pl-3 text-sm font-semibold">Skills</div>
                <div
                    class="p-4  px-8 border-l flex flex-wrap w-80 gap-2 items-start justify-start max-h-[30rem] overflow-scroll">

                    @foreach ($this->skills as $skill)
                        <div
                            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">

                            <label class="col-span-4 cursor-pointer"
                                for="skill_{{ $skill->id }}">{{ $skill->name }}</label>

                            <input wire:model.defer='filters.skills' value="{{ $skill->id }}"
                                id="skill_{{ $skill->id }}"
                                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox"
                                name="date">
                        </div>
                    @endforeach

                </div>


            </div>


            <div>
                <div class="pl-3 text-sm font-semibold">Salary</div>
                <div class="p-4 border-l">
                    <div class="flex flex-col p-2">
                        <label>min</label>
                        <input wire:model.defer='filters.salary.min' class="border-gray-200 rounded-md" type="number">
                    </div>
                    <div class="flex flex-col p-2">
                        <label>max</label>
                        <input wire:model.defer='filters.salary.max' class="border-gray-200 rounded-md"
                            type="number">
                    </div>
                </div>
            </div>


            <div>
                <div class="pl-3 text-sm font-semibold">Job type</div>
                <div class="flex flex-col gap-2 p-4 px-8 border-l">
                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
                        <label class="col-span-4 cursor-pointer" for="remotly"> Remotly</label>
                        <input wire:model.defer='filters.types' value="remotly" id="remotly"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox">
                    </div>

                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
                        <label class="col-span-4 cursor-pointer" for="permanently">Permanently</label>
                        <input wire:model.defer='filters.types' value="permanently" id="permanently"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox">
                    </div>

                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
                        <label class="col-span-4 cursor-pointer" for="fulltime"> Full time</label>
                        <input wire:model.defer='filters.types' value="fulltime" id="fulltime"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox">
                    </div>

                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
                        <label class="col-span-4 cursor-pointer" for="hybrid"> Hybrid</label>
                        <input wire:model.defer='filters.types' value="hybrid" id="hybrid"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox">
                    </div>
                </div>
            </div>

            <div>
                <div class="pl-3 text-sm font-semibold">Location</div>
                <div class="p-4 border-l">
                    <div class="flex flex-col p-2">
                        <label>country</label>
                        <input wire:model.defer='filters.location.country' class="border-gray-200 rounded-md"
                            type="text">
                    </div>
                    <div class="flex flex-col p-2">
                        <label>city</label>
                        <input wire:model.defer='filters.location.city' class="border-gray-200 rounded-md"
                            type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <button wire:click="filter" x-on:click="hide"
                class="px-8 py-1 font-semibold transition-all border-2 rounded-lg border-sky-500 text-sky-500 hover:bg-sky-500 hover:text-white">Filter</button>
        </div>
    </div>
</div>
