<div class="absolute top-0 left-0 grid w-full h-full grid-cols-2 gap-4 scale-x-105 bg-stone-50">
    <div class="flex flex-col gap-3">
        @foreach ([1, 1, 1, 1] as $job)
            <div class="p-5 bg-white border rounded-lg ">
                <div class="flex flex-col gap-2 animate-pulse">
                    <div class="w-3/4 px-4 py-3 bg-slate-100 rounded-xl"></div>
                    <div class="w-2/4 px-4 py-2 bg-slate-100 rounded-xl"></div>

                    <div class="flex justify-between w-2/4 gap-5 py-3">
                        <div class="flex-1 px-4 py-2 bg-slate-100 rounded-xl"></div>
                        <div class="flex-1 px-4 py-2 bg-slate-100 rounded-xl"></div>
                    </div>

                    <div class="flex flex-col w-3/4 gap-5 py-3">
                        <div class="flex-1 px-4 py-1 bg-slate-100 rounded-xl"></div>
                        <div class="flex-1 px-4 py-1 bg-slate-100 rounded-xl"></div>
                        <div class="flex-1 px-4 py-1 bg-slate-100 rounded-xl"></div>
                        <div class="flex-1 px-4 py-1 bg-slate-100 rounded-xl"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="relative">
        <x-loading.loading-job-details />
    </div>
</div>
