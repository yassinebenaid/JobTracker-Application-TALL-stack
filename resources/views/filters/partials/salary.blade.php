<div>
    <div class="pl-3 text-sm font-semibold">Salary</div>
    <div class="p-4 border-l">
        <div class="flex flex-col p-2">
            <label>min</label>
            <input wire:model.defer='filters.salary.min' class="border-gray-200 rounded-md" type="number">
        </div>
        <div class="flex flex-col p-2">
            <label>max</label>
            <input wire:model.defer='filters.salary.max' class="border-gray-200 rounded-md" type="number">
        </div>
    </div>
</div>
