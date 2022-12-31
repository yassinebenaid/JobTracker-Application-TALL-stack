<div x-data="dropdown">

    <div x-data="popup" x-on:click="load($wire,toggle())" class="flex gap-3 my-6 transition-all ">


        <div class="w-20 h-20 overflow-hidden rounded-md cursor-pointer">
            @if ($company->photo)
                <img class="w-full h-full" src="{{ asset('storage/' . $company->photo) }}" alt="">
            @else
                <div class='grid w-full h-full bg-slate-100 place-content-center'>
                    <i class="text-5xl bi bi-building text-slate-400"></i>
                </div>
            @endif
        </div>


        <div class="grid cursor-pointer">

            <div class="text-semibold">
                {{ $company->name }}
            </div>

            <div>
                <x-stars :stars="$company->reviews_avg_rate" />
            </div>


            <div class="flex gap-3">
                <div x-on:click="$dispatch('about')" class="text-sm hover:underline text-slate-500">
                    about
                </div>
                <div x-on:click="$dispatch('review')" class="text-sm hover:underline text-slate-500">
                    reviews
                </div>

                @emploee
                    <div x-on:click="$dispatch('report')" class="text-sm hover:underline text-slate-500">
                        report
                    </div>
                @endemploee

            </div>
        </div>
    </div>


    {{-- model --}}

    @include('companies.partials.model')

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data('popup', () => ({
                loaded: false,
                load(wire, toggle) {
                    if (!this.loaded) wire.load()
                    this.loaded = true
                }
            }))
        })
    </script>
</div>
