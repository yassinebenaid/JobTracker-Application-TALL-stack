<div x-show="open" x-cloak x-data="details"
    class="fixed top-0 left-0 z-50 grid w-full h-full bg-slate-500/30 place-content-center">


    <div x-show="open" x-cloak x-transition x-on:click.outside="hide"
        class="relative grid grid-cols-6  bg-white rounded-lg w-[70rem] h-[40rem] overflow-hidden">

        <x-loading.loading-spinner-2 target=load />


        @if ($opened)
            <div class="flex flex-col overflow-hidden text-center border-r rounded-l-lg bg-slate-50">
                <div x-on:click="cabout" :class="{ 'border-l-sky-600 text-sky-600 border-l-8': about }"
                    class="py-4 text-sm font-semibold transition-all cursor-pointer border-y hover:bg-slate-100">
                    About
                </div>

                <div x-on:click="creviews" :class="{ 'border-l-sky-600 text-sky-600 border-l-8': reviews }"
                    class="py-4 text-sm font-semibold transition-all cursor-pointer hover:bg-slate-100">Reviews</div>

                <div x-on:click="creport" :class="{ 'border-l-sky-600 text-sky-600 border-l-8': report }"
                    class="py-4 text-sm font-semibold transition-all cursor-pointer border-y hover:bg-slate-100">Report
                </div>
            </div>


            @include('companies.partials.about')


            @include('companies.partials.reviews')


            @include('companies.partials.report')

            {{-- --}}
        @endif


    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data("details", () => ({
                about: true,
                reviews: false,
                report: false,

                cabout() {
                    this.about = true
                    this.reviews = false
                    this.report = false
                },
                creviews() {
                    this.about = false
                    this.reviews = true
                    this.report = false
                },
                creport() {
                    this.about = false
                    this.reviews = false
                    this.report = true
                }
            }))
        })
    </script>
</div>
