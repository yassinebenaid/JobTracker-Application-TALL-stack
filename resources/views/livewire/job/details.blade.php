<div x-data x-init="$dispatch('job:selected', {{ $this->job->id }})"
    class="relative bg-white h-[47rem] border shadow  rounded-lg overflow-scroll pb-20 no-scroll">
    <header class="p-5 shadow-md">


        <div class="flex justify-between">
            <div class="text-4xl font-bold">{{ $this->job->title }}</div>

            @if ($withControle)
                @include('job.control', ['type' => $job->type])
            @endif

        </div>
        <div class="text-lg text-gray-500">{{ $this->job->user->name }}</div>


        <div class="flex items-center gap-4 py-4">

            @emploee
                <div x-data="dropdown">
                    <div x-on:click="toggle"
                        class="px-4 py-2 font-semibold transition-all border rounded-lg cursor-pointer hover:bg-sky-500 text-sky-500 border-sky-500 hover:text-white">
                        <i class="mx-2 bi bi-send "> </i>
                        Apply For Job

                    </div>

                    <livewire:application.form :company_id="$this->job->user->id" :job_id="$this->job->id" />

                </div>
            @endemploee
            <div wire:click="wishlist" x-on:click="$dispatch('new:wishlist')"
                class="px-5 py-[0.4rem] transition-all border rounded-lg cursor-pointer border-slate-500 hover:text-white hover:bg-slate-500">
                <i class="text-xl bg-transparent bi bi-heart{{ $inWishlist ? '-fill' : null }}"></i>
            </div>

            <div x-data="dropdown">
                <div x-on:click="toggle"
                    class="px-5 py-[0.4rem] transition-all border rounded-lg cursor-pointer border-slate-500 hover:text-white hover:bg-slate-500">
                    <i class="text-xl bg-transparent bi bi-flag"></i>

                </div>
                <livewire:job.report :job="$this->job" />
            </div>

        </div>
    </header>

    <div class="p-5 border-b">
        <div class="mb-5 text-2xl font-semibold">Job Details</div>

        <div class="py-2">
            <div class="text-sm">
                <i class="mx-2 bi bi-briefcase-fill"></i>
                <span>job type</span>
            </div>
            <div class="py-2 pl-10"><span
                    class="px-3 py-1 font-semibold rounded-lg bg-slate-200 text-slate-600">{{ $this->job->type }}</span>
            </div>
        </div>

        <div class="py-2">
            <div class="text-sm">
                <i class="mx-2 bi bi-geo-alt-fill"></i>
                <span>job Location</span>
            </div>
            <div class="py-2 pl-10"><span
                    class="px-3 py-1 text-sm font-semibold rounded-lg bg-slate-200 text-slate-600">{{ $this->job->country }},{{ $this->job->city }}</span>
            </div>
        </div>

        <div class="py-2">
            <div class="text-sm">
                <i class="mx-2 bi bi-cash-coin"></i>
                <span>job salary</span>
            </div>
            <div class="py-2 pl-10"><span
                    class="px-3 py-1 font-semibold text-green-800 bg-green-200 rounded-lg">{{ $this->job->salary }}$</span>
            </div>
        </div>

        <div class="py-2">
            <div class="text-sm">
                <i class="mx-2 bi bi-clipboard-data"></i>
                <span>Required Skills</span>
            </div>
            <div class="flex flex-wrap gap-3 py-2 pl-10">
                @foreach ($this->job->skills as $skill)
                    <span
                        class="px-3 py-1 font-semibold rounded-lg text-slate-800 bg-slate-200">{{ $skill->name }}</span>
                @endforeach
            </div>
        </div>

    </div>

    <div class="p-5">
        <div class="mb-5 text-2xl font-semibold">Job Description</div>

        @if ($this->job->conditions->isNotEmpty())

            <ul class="flex flex-col py-3 text-gray-500">
                @foreach ($this->job->conditions as $condition)
                    <li class="text-sm">• {{ $condition }} </li>
                @endforeach
            </ul>
        @endif

        <div class="px-3 pb-5 tracking-wide text-gray-500 border-b">{{ $this->job->description }}</div>
    </div>


    <div class="py-2">
        <div class="text-sm">
            <i class="mx-2 bi bi-calendar"></i>
            <span>Posted at:</span>
        </div>
        <div class="py-2 pl-10">
            <span class="px-3 py-1 font-semibold rounded-lg ">{{ $this->job->created_at->format('D Y-m-d') }}</span>
        </div>
    </div>

    <div wire:loading.remove wire:target='wishlist'>
        <div wire:loading>
            <x-loading.loading-job-details />
        </div>
    </div>
</div>
