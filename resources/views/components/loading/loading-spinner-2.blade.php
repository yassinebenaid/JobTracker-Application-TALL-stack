@props(['target' => false])
<div wire:loading {{ !$target ?: "wire:target=$target" }}>

    <div class="absolute top-0 left-0 grid w-full h-full bg-white place-content-center">
        <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33"
                r="30"></circle>
        </svg>
    </div>

</div>
