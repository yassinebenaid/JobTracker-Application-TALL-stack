<div x-data='{cover:$wire.entangle("cover").defer,expected_salary:$wire.entangle("expected_salary")}' x-cloak
    x-show="open" x-on:status:success.window="hide"
    class="fixed top-0 left-0 grid w-screen h-screen bg-slate-500/30 place-content-center">

    <form x-on:submit.prevent='$wire.save()' x-on:click.outside="hide" x-cloak x-show="open" x-transition
        class="bg-white  p-5 rounded-lg w-[40rem] flex flex-col gap-4 ">
        <div class="text-lg font-semibold">
            Apply for job
        </div>
        <div class="flex flex-col gap-5 p-5">

            <div>
                <x-input-label for="salary" :value="__('Expected Salary')" />
                <x-text-input x-model='expected_salary' id="salary" type="number" class="block w-full mt-1" />
                <x-input-error class="mt-2" :messages="$errors->get('expected_salary')" />
            </div>

            <div>
                <div class="flex justify-between">
                    <x-input-label for="cover" :value="__('Cover letter')" />
                    <div class="text-xs "
                        :class="{ 'text-green-500': cover.length > 99, 'text-red-400': cover.length < 99 }"
                        x-text="cover.length  + ' / 100+'"></div>
                </div>

                <textarea x-model='cover' id="cover"
                    class="block w-full mt-1 rounded-lg resize-none focus:ring-sky-500 focus:border-sky-500 border-slate-200 h-60"></textarea>

                <x-input-error class="mt-2" :messages="$errors->get('cover')" />
            </div>
        </div>

        <div class="flex justify-end">
            <x-primary-button x-bind:disabled="cover.length < 100"
                x-bind:title="cover.length < 100 ? 'cover letter should be at least 10 digits' : ''">

                <x-loading.loading-spiner />
                apply

            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('application', () => ({
                cover: '',
            }))
        })
    </script>
</div>
