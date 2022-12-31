<div>
    <div class="pl-3 text-sm font-semibold">Job type</div>
    <div class="flex flex-col gap-2 p-4 px-8 border-l">
        <div
            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
            <label class="col-span-4 cursor-pointer" for="remotly"> Remotly</label>
            <input wire:model.defer='filters.types' value="remotly" id="remotly"
                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox">
        </div>

        <div
            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
            <label class="col-span-4 cursor-pointer" for="permanently">Permanently</label>
            <input wire:model.defer='filters.types' value="permanently" id="permanently"
                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox">
        </div>

        <div
            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
            <label class="col-span-4 cursor-pointer" for="fulltime"> Full time</label>
            <input wire:model.defer='filters.types' value="fulltime" id="fulltime"
                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox">
        </div>

        <div
            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
            <label class="col-span-4 cursor-pointer" for="hybrid"> Hybrid</label>
            <input wire:model.defer='filters.types' value="hybrid" id="hybrid"
                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox">
        </div>
    </div>
</div>
