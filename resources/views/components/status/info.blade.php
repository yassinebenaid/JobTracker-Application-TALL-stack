@props(['size'])
<div class="flex flex-col text-center text-slate-400 ">
    <div class="text-[5rem]">
        <i class=" bi bi-info-lg"></i>
    </div>

    {{ $slot }}
</div>
