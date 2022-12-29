<div x-show="open" x-cloak x-collapse x-on:click.outside="hide"
    class="absolute z-40 flex flex-col p-2 bg-white border rounded-lg shadow w-96 top-full -right-1/2">
    <div class="flex items-center justify-between gap-3 p-3 border-b">
        <div class="flex gap-3">

            @if (auth()->user()->photo)
                <img class="rounded-full w-14 h-14" src="{{ asset('storage/' . auth()->user()->photo) }}">
            @else
                <x-thumpnails.user class="rounded-full w-14 h-14 " />
            @endif

            <a href="{{ route('profile.edit') }}">
                <div class="text-lg font-semibold">
                    {{ auth()->user()->name }}
                </div>
                <div class="text-sm">
                    {{ auth()->user()->email }}
                </div>
            </a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-3">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
    <div class="flex flex-col row-span-2 text-base">
        <div class="px-4 py-2 transition-all cursor-pointer hover:pl-8 hover:bg-slate-100">About us</div>
        <div class="px-4 py-2 transition-all cursor-pointer hover:pl-8 hover:bg-slate-100">Contact us</div>
        <div class="px-4 py-2 transition-all cursor-pointer hover:pl-8 hover:bg-slate-100">terms & conditions</div>
    </div>
</div>
