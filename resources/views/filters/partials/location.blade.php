<div>
    <div class="pl-3 text-sm font-semibold">Location</div>
    <div class="p-4 border-l">
        <div class="flex flex-col p-2">
            <label>country</label>
            <input wire:model.defer='filters.location.country' class="border-gray-200 rounded-md" type="text">
        </div>
        <div class="flex flex-col p-2">
            <label>city</label>
            <input wire:model.defer='filters.location.city' class="border-gray-200 rounded-md" type="text">
        </div>
    </div>
</div>
