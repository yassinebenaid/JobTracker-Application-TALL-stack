<div x-cloak x-show="report" class="grid h-[40rem] grid-rows-6  col-span-5">
    <div class="grid grid-cols-2 row-span-5 p-5">
        <div class="grid items-start grid-cols-2">
            @foreach (range(1, 7) as $rule)
                <div class="p-3">
                    <label for="{{ $loop->index }}" class="cursor-pointer">Contain nudes</label>
                    <input class="p-3 rounded-md cursor-pointer focus:ring-0 focus:outline-0 text-sky-500" type="checkbox"
                        id="{{ $loop->index }}">
                </div>
            @endforeach
        </div>

        <div>
            <label class='block text-sm font-medium text-gray-700'>somthing else </label>
            <input type="text"
                class='w-full border rounded-md shadow-sm border-slate-400 focus:border-sky-500 focus:ring-0 focus:outline-0' />
        </div>
    </div>

    <div class="flex items-center justify-end p-10">

        <button
            class='items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition-all rounded-md bg-sky-600 hover:bg-sky-500 focus:outline-none'>
            Report
        </button>
    </div>
</div>
