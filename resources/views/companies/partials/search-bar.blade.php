<div class="grid  grid-cols-6 py-10 gap-5">

    <div class="col-start-2 col-end-6 flex flex-col gap-5">
        <div class="text-3xl font-semibold text-center">
            Looking for a company
            <div class="text-sm"> search by name or work specification .</div>
        </div>
        <form x-on:submit.prevent="$wire.$set('search',search)" x-data="{ search: '' }" class="flex gap-3">
            <x-primary-button class="px-14 ">
                <i class="bi bi-search text-lg"></i>
            </x-primary-button>

            <x-text-input x-model='search' class="border-slate-300 w-full px-5" />
        </form>
    </div>
</div>
