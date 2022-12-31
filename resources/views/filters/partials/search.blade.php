<div class="relative">
    <input type="search" wire:model.defer="filters.keywords" wire:keyup.enter='filter'
        x-on:keyup.window="($event.key === '/' || $event.key === ':') ? $el.focus() : ''"
        class="w-full pl-20 border-gray-100 rounded-lg focus:shadow focus:ring-0 focus:border-sky-300 placeholder:text-slate-400"
        placeholder="press / to search ...">
    <i class="absolute text-xl text-gray-400 -translate-y-1/2 bi bi-search top-1/2 left-5"></i>
</div>
