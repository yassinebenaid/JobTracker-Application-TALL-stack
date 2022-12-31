<div x-show="open" x-cloak x-data="details"
    class="fixed top-0 left-0 z-50 grid w-full h-full bg-slate-500/30 place-content-center">


    <div x-show="open" x-cloak x-transition x-on:click.outside="hide"
        class="relative grid grid-cols-6  bg-white rounded-lg w-[70rem] h-[40rem] overflow-hidden">

        <x-loading.loading-spinner-2 target=load />


        <div class="flex flex-col overflow-hidden text-center border-r rounded-l-lg bg-slate-50">
            <div x-on:click="cabout" x-on:about.window="cabout"
                :class="{ 'border-l-sky-600 text-sky-600 border-l-8': about }"
                class="py-4 text-sm font-semibold transition-all cursor-pointer border-y hover:bg-slate-100">

                <div class="grid grid-cols-3">
                    <i class="bi bi-info-circle"></i>
                    <span> About</span>
                </div>
            </div>

            <div x-on:click="creviews" x-on:review.window="creviews"
                :class="{ 'border-l-sky-600 text-sky-600 border-l-8': reviews }"
                class="gap-3 py-4 text-sm font-semibold transition-all cursor-pointer hover:bg-slate-100">

                <div class="grid grid-cols-3">
                    <i class="bi bi-rss"></i>
                    <span>Reviews</span>
                </div>
            </div>


            @emploee
                <div x-on:click="creport" x-on:report.window="creport"
                    :class="{ 'border-l-sky-600 text-sky-600 border-l-8': report }"
                    class="gap-3 py-4 text-sm font-semibold transition-all cursor-pointer border-y hover:bg-slate-100">

                    <div class="grid grid-cols-3">
                        <i class="bi bi-flag"></i>
                        <span>Report</span>
                    </div>
                </div>
            @endemploee

        </div>

        @if ($opened)
            @include('companies.partials.about')


            @include('companies.partials.reviews')

            @emploee
                @include('companies.partials.report')
            @endemploee
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
