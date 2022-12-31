<div>
    <div class="text-sm font-semibold">Date</div>
    <div class="flex flex-col gap-4 p-4 ">
        <div
            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
            <label class="col-span-4 cursor-pointer" for="anytime"> Any time</label>
            <input wire:model.defer='filters.date' value="anytime" id="anytime"
                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio" name="date">
        </div>
        <div
            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
            <label class="col-span-4 cursor-pointer" for="today"> Today</label>
            <input wire:model.defer='filters.date' value="today" id="today"
                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio" name="date">
        </div>
        <div
            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
            <label class="col-span-4 cursor-pointer" for="week"> Current week</label>
            <input wire:model.defer='filters.date' value="week" id="week"
                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio" name="date">
        </div>
        <div
            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
            <label class="col-span-4 cursor-pointer" for="month"> This month</label>
            <input wire:model.defer='filters.date' value="month" id="month"
                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio" name="date">
        </div>
        <div
            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">
            <label class="col-span-4 cursor-pointer" for="year"> This Year</label>
            <input wire:model.defer='filters.date' value="year" id="year"
                class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="radio" name="date">
        </div>
    </div>
</div>
