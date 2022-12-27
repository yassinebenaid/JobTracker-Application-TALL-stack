<div class="container grid grid-cols-3 gap-5 p-5 m-auto">

    @if ($this->applications->isNotEmpty())


        <div x-data class="flex flex-col max-h-[90vh] gap-2  overflow-scroll no-scroll">

            @foreach ($this->applications as $application)
                <div wire:click="select(@js($application->id))" :class="{ 'border-sky-700': @js($application->id === $selected->id) }"
                    class="p-4 transition-all bg-white border rounded-lg cursor-pointer hover:shadow b order-sky-700">
                    <div class="text-lg font-semibold">
                        {{ $application->emploee->name }}
                    </div>
                    <div>
                        {{ $application->emploee->profile->job }}
                    </div>
                    <div class="text-sm text-end text-slate-500">
                        {{ $application->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach

        </div>

        <div class="relative flex flex-col col-span-2 gap-5  pb-20 overflow-scroll no-scroll max-h-[90vh]">

            <div class="flex flex-col p-5 bg-white border rounded-xl">

                @if ($selected->emploee->photo)
                    <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                        <div>photo</div>
                        <div>
                            <img class="w-32 h-32 rounded-full" src="{{ asset('storage/' . $selected->emploee->photo) }}"
                                alt="">
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>Name</div>
                    <div>
                        {{ $selected->emploee->name }}
                    </div>
                </div>
                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>Email</div>
                    <div>
                        {{ $selected->emploee->email }}
                    </div>
                </div>
                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>Address</div>
                    <div>
                        {{ $selected->emploee->profile->country }}
                    </div>
                </div>

                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>Job title</div>
                    <div>
                        {{ $selected->emploee->profile->job }}
                    </div>
                </div>



                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>experience</div>
                    <div>
                        {{ $years = $selected->emploee->profile->experience_years }} @choice('year|years', $years)
                    </div>
                </div>

                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>Skills</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($selected->emploee->skills as $skill)
                            <div class="px-3 py-1 rounded-lg bg-slate-100 text-slate-500 ">
                                {{ $skill->name }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>Degree</div>
                    <div>
                        {{ $selected->emploee->profile->degree }},
                        <span class="text-sm">{{ $selected->emploee->profile->degree_year->format('Y') }}</span>,
                        <span class="text-sm">{{ $selected->emploee->profile->school }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>expected salary</div>
                    <div>
                        {{ $selected->expected_salary }}$
                    </div>
                </div>

                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>Bio</div>
                    <div>
                        {{ $selected->emploee->profile->bio }}.
                    </div>
                </div>

                <div class="grid grid-cols-2 px-5 py-3 transition-all border-b border-slate-100 ">
                    <div>cover</div>
                    <div>
                        {{ $selected->cover_letter }}
                    </div>
                </div>
            </div>

            <div class="flex justify-center px-5 py-3 bg-white border rounded-xl">
                <div class="flex gap-10 p-5">
                    <button wire:click='deny'
                        class="px-20 py-3 text-red-500 transition-all border-2 border-red-500 rounded-lg hover:text-white hover:bg-red-500">Remove</button>
                    <button wire:click='accept'
                        class="px-20 py-3 transition-all border-2 rounded-lg border-sky-500 hover:text-white text-sky-500 hover:bg-sky-500">Accept</button>
                </div>
            </div>

            <x-loading.loading-application-details />
        </div>
    @else
        <div class="flex justify-center col-span-3">
            <x-sorry size=6>
                No Applications yet
            </x-sorry>
        </div>
    @endif
</div>
