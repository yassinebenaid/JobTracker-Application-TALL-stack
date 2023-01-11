<div x-data="card" wire:click='$emit("job:changed",{{ $job->id }})'
    x-on:job:selected.window="select($event.detail,{{ $job->id }})"
    :class="{ 'border-sky-800 hover:border-sky-800': selected }",
    class="p-5 transition-all bg-white border rounded-lg cursor-pointer select-none hover:shadow-xl ">

    <div class="flex justify-between mb-4 ">
        <div x-on:click="selected=true" class="flex-1 mr-5">
            <div class="text-2xl font-semibold">{{ $job->title }}</div>
            <div class="tracking-wider text-gray-500">{{ $job->company?->name }}</div>
            <div class="text-sm">{{ $job->country }}, {{ $job->city }} </div>
        </div>
    </div>


    {{-- body --}}
    <div>

        <div class="flex gap-3 px-2 ">
            <div class="px-2 py-1 font-bold text-green-700 bg-green-100 rounded-lg w-max"><i
                    class="mx-2 bi bi-cash-coin"></i> {{ $job->salary }}$</div>
            <div class="px-2 py-1 font-bold rounded-lg bg-slate-100 text-slate-700 w-max"><i
                    class="mx-2 bi bi-briefcase-fill"></i> {{ $job->type }}</div>
        </div>

        @if ($job->conditions->isNotEmpty())

            <ul class="flex flex-col py-3 text-gray-400">
                @foreach ($job->conditions as $condition)
                    <li class="text-sm">• {{ $condition }} </li>
                @endforeach
            </ul>
        @endif

        @if ($job->skills->isNotEmpty())
            <div class="flex flex-wrap gap-1">
                @foreach ($job->skills as $skill)
                    <div class="px-2 text-sm rounded-md bg-slate-200">{{ $skill->name }}</div>
                @endforeach
            </div>
        @endif

        <div class="text-sm text-slate-400 text-end">{{ $job->created_at->format('Y M d ') }}</div>

    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('card', () => ({
                selected: 0,
                job_id: '{{ $job->title }}',

                select(id, job_id) {

                    if (id === job_id) this.selected = 1
                    else this.selected = 0
                },

            }))
        })
    </script>
</div>
