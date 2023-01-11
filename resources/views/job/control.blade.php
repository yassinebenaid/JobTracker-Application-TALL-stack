<div x-data="dropdown" class="relative" x-ref="controle">
    <i x-on:click="toggle" class="text-2xl cursor-pointer bi bi-three-dots-vertical"></i>

    <div x-show="open" x-on:click.outside="hide" x-cloak x-transition
        class="absolute top-0 w-40 bg-white border rounded-lg shadow right-full">


        <div x-data="dropdown" class="p-2 transition-all hover:bg-slate-100">
            <div @click="toggle" class="w-full">
                <i class="cursor-pointer bi bi-pencil-square text-sky-500"></i> Edit
            </div>

            @include('job.form', ['action' => 'edit', 'model' => 'job', 'job' => $job])
        </div>


        <div class="p-2 transition-all cursor-pointer hover:bg-slate-100"><i
                class="text-yellow-600 bi bi-door-closed"></i> Close
        </div>


        <div x-data="dropdown">
            <div @click="toggle" class="w-full p-2 transition-all cursor-pointer hover:bg-slate-100">
                <i class="text-red-500 bi bi-trash"></i> Remove
            </div>


            <x-model-wrapper>
                <div x-show="open" x-transition class="grid justify-center p-2 bg-white border rounded-lg">
                    <div class="p-2 text-2xl font-semibold text-center">Warning</div>
                    <div class="p-2 text-center">Are you sure you want to remove this job ?</div>


                    <div class="flex gap-2 p-2">
                        <button @click="hide"
                            class="w-full p-1 text-white border rounded-lg bg-slate-400">Cancel</button>
                        <button wire:click='remove' class="w-full p-1 text-white bg-red-500 border rounded-lg">
                            <x-loading.loading-spiner /> Remove
                        </button>
                    </div>

                </div>
            </x-model-wrapper>

        </div>
    </div>
</div>
