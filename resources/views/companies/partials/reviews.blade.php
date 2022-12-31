<div x-cloak x-show="reviews" class="col-span-5 grid grid-rows-6 h-[40rem]">

    @forelse ($company->reviews ?? [] as $review)
        <div class="flex flex-col row-span-5 gap-4 p-5 overflow-scroll">
            @foreach (range(1, 7) as $comment)
                <div class="flex items-start justify-start gap-2">
                    <div>
                        <div class='grid text-lg rounded-full bg-slate-100 w-14 place-content-center'>
                            <i class="bi bi-person text-[2em] text-slate-400"></i>
                        </div>
                    </div>

                    <div class="border bg-stone-100 rounded-r-xl rounded-bl-xl">

                        <div class="flex justify-between gap-5 px-3 py-2">
                            <div class="font-semibold">
                                Yasine benaid
                            </div>
                            <div>
                                @foreach (range(1, 5) as $item)
                                    <i class="bi bi-star{{ $loop->iteration <= 3 ? '-fill' : '' }} text-sky-600  "></i>
                                @endforeach
                            </div>
                        </div>

                        <p class="px-4">Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Itaque
                            vel
                            deleniti qui ullam delectus exercitationem consectetur laborum corrupti, enim
                            autem
                            quos
                            assumenda voluptatum laudantium, pariatur, ipsum illum beatae odit ab!
                        </p>

                        <div class="px-5 py-1 text-xs text-slate-500 text-end">1 hour ago</div>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="grid row-span-5 text-center place-content-center">
            <x-sorry size="3" />
            No Reviews Yet
        </div>
    @endforelse



    <form x-data="{
        rate: $wire.entangle('rate').defer,
        feedback: $wire.entangle('feedback').defer,
        get fb() {
            return this.feedback || ''
        },
        set fb(v) {
            (this.feedback.length < 300) ?
            this.feedback = v: null
        }
    }" x-on:submit.prevent="$wire.save()"
        class="relative flex items-center justify-between gap-5 p-5 border-t">

        <div x-data="dropdown">
            <i x-on:click="toggle"
                class="px-4 py-3 text-xl transition-all rounded-lg cursor-pointer bi bi-star hover:bg-slate-200"></i>

            <div x-show="open" x-on:click.outside="hide" x-collapse.duration.100ms x-cloak
                class="absolute left-0 flex justify-center w-full gap-5 p-5 text-2xl bg-white border-t text-sky-500 bottom-full">

                @foreach (range(1, 5) as $star)
                    <i x-on:click="rate={{ $loop->iteration }}"
                        :class="{
                            'bi-star-fill': rate >= {{ $loop->iteration }},
                            'bi-star': rate <
                                {{ $loop->iteration }}
                        }"
                        class="cursor-pointer bi "></i>
                @endforeach

            </div>
        </div>

        <textarea x-model="fb"
            class="w-full px-5 transition-all rounded-lg resize-none h-11 focus:h-full border-slate-400 focus:ring-0 focus:border-sky-500"></textarea>


        <button
            class='items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition-all rounded-md bg-sky-600 hover:bg-sky-500 focus:outline-none'>
            <i class="px-5 text-lg bi bi-send"></i>
        </button>

    </form>


</div>
