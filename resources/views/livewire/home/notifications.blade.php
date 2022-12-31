<li x-data="dropdown" class="relative">
    <div wire:click="refresh" x-on:click="toggle" class="relative">
        <i class="transition-all cursor-pointer bi bi-bell hover:text-sky-500"></i>

        @if ($unreadNotifications)
            <x-new />
        @endif
    </div>

    <div x-cloak x-show="open" x-transition x-on:click.outside="hide"
        class="absolute z-40 p-2 text-base bg-white border rounded-lg shadow w-96 top-full -right-1/2">
        <header class="px-3 text-lg font-semibold">Notifications</header>

        <div class="flex flex-col p-3 overflow-scroll min-h-[20rem] max-h-[50rem]">
            @forelse ($notifications as $not)
                <div
                    class="px-2 py-2 transition-all border-b cursor-pointer hover:bg-slate-100 {{ !$not->read_at ? 'font-bold' : '' }}">
                    <div>{{ $not->data['title'] }}</span> </div>
                    <div class="truncate text-slate-400">{{ $not->data['description'] }}</div>
                    <div class="text-xs text-slate-400">{{ $not->created_at->diffForHumans() }}</div>
                </div>
            @empty
                <div class="py-5 text-sm text-center text-slate-400">No notifications yet</div>
            @endforelse
        </div>

        <x-loading.loading-notifications />
    </div>
</li>
