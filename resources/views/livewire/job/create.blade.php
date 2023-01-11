<div>
    <div x-data="dropdown" class="px-4 justify-self-end">

        <i x-on:click="toggle"
            class="text-4xl transition-all cursor-pointer hover:opacity-60 bi bi-plus-circle text-sky-500"></i>

        <div>
            @include('job.form')
        </div>

    </div>
</div>
