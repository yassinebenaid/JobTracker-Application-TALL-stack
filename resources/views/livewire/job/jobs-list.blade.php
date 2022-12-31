<div>
    <div class="col-span-2">
        @include('filters.index')
    </div>

    <div id="jobs-list" class="container relative grid gap-2 m-auto md:grid-cols-2 ">

        @include('job.list', ['jobs' => $this->jobs, 'links' => true])

        <div wire:loading>
            <x-loading.loading-jobs />
        </div>
    </div>
</div>
