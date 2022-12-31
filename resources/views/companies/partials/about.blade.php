<div x-cloak x-show="about" class="col-span-5 overflow-scroll">
    <div class="flex justify-start h-40 gap-5 p-5 ralative">

        <div class='grid w-32 h-32 rounded-lg bg-slate-100 place-content-center'>
            <i class="text-5xl bi bi-building text-slate-400"></i>
        </div>

        <div class="grid">
            <div class="text-xl font-semibold">
                {{ $company->name }}
            </div>
            <div>
                {{ $company->profile->country }}
            </div>
            <div>
                {{ $company->profile->job }}
            </div>
            <div>
                <i class="bi bi-star-fill text-sky-600"></i>
                {{ number_format($company->rate ?? 0, 1) }}
            </div>
        </div>
    </div>

    <div class="p-5">
        <div class="font-semibold">Brief</div>

        <p class="p-5 tracking-wide">{{ $company->profile->bio }} </p>
    </div>


</div>
