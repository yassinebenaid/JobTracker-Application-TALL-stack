<div class="container relative grid gap-2 m-auto md:grid-cols-2 ">



    <div x-data="list" x-on:should:scroll.window="scrollUp" id="list"
        class="pb-20 flex relative flex-col gap-3 overflow-scroll h-[46.5rem] p-3 no-scroll">

        @foreach ($this->jobs as $job)
            <livewire:home.job-card :job="$job" :wire:key="$job->id" />
        @endforeach

        {{ $this->jobs->links() }}

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


    <livewire:home.job-details :jobId="$this->jobs->first()?->id" />


    <div wire:loading>
        <x-loading.loading-jobs />
    </div>
</div>
