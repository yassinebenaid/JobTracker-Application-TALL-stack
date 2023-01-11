<div x-cloak x-show="open" x-on:status:success.window="hide"
    class="fixed top-0 left-0 z-50 grid w-screen h-screen bg-slate-500/30 place-content-center">
    {{ $slot }}
</div>
