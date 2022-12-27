@props(['size'])
<div class="flex flex-col text-center text-slate-400 ">
    <div class="text-[{{ $size ?? 2 }}rem]">
        <i class=" bi bi-emoji-frown"></i>
    </div>
    {{-- @switch($size)
        @case(1)
            <div class="text-[3rem]">
                <i class=" bi bi-emoji-frown"></i>
            </div>
        @break

        @case(2)
            <div class="text-[6rem]">
                <i class=" bi bi-emoji-frown"></i>
            </div>
        @break

        @case(3)
            <div class="text-[9rem]">
                <i class=" bi bi-emoji-frown"></i>
            </div>
        @break

        @case(4)
            <div class="text-[12rem]">
                <i class=" bi bi-emoji-frown"></i>
            </div>
        @break

        @default
            <div class="text-[2rem]">
                <i class=" bi bi-emoji-frown"></i>
            </div>
    @endswitch --}}


    {{ $slot }}
</div>
