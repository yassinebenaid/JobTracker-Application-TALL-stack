@props(['jobs', 'links' => false])



<div x-data="list" x-on:should:scroll.window="scrollUp" id="list"
    class="pb-20 flex relative flex-col gap-3 overflow-scroll h-[46.5rem] p-3 no-scroll">

    @foreach ($jobs as $job)
        <livewire:job.card :job="$job" :wire:key="$job->id" />
    @endforeach


    @if ($links)
        {{ $jobs->links() }}
    @endif

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('list', () => ({
                scrollUp(e) {
                    window.list.scroll({
                        top: 0,
                        left: 0,
                        behavior: 'smooth'
                    })
                }
            }))
        })
    </script>
</div>

@if ($jobs->isNotEmpty())
    <livewire:job.details :jobId="$jobs->first()?->id" />
@endif
