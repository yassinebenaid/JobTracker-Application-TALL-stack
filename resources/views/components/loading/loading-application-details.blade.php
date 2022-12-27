<div wire:loading class="absolute top-0 left-0 w-full h-screen overflow-hidden bg-white border rounded-lg">
    <div class="flex flex-col gap-2 overflow-hidden animate-pulse">
        <div class="grid items-center grid-cols-2 p-5 ">
            <div>
                <div class="w-1/2 px-5 py-2 rounded-lg bg-slate-100"></div>
            </div>
            <div>
                <div class="w-32 h-32 px-5 py-2 rounded-full bg-slate-100"></div>
            </div>
        </div>

        @foreach ([1, 1, 11, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1] as $item)
            @if ($loop->odd)
                <div class="grid items-center grid-cols-2 p-5">
                    <div>
                        <div class="w-1/2 px-5 py-2 rounded-lg bg-slate-100"></div>
                    </div>
                    <div>
                        <div class="w-1/2 px-5 py-2 rounded-lg bg-slate-100"></div>
                    </div>
                </div>
            @else
                <div class="grid items-center grid-cols-2 p-5">
                    <div class="col-span-2 ">
                        <div class="w-3/4 px-5 py-2 rounded-lg bg-slate-100"></div>
                    </div>

                </div>
            @endif
        @endforeach
    </div>
</div>
