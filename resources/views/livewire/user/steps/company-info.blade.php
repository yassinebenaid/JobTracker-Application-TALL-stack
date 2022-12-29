<div class="grid justify-center w-screen h-screen p-20 bg-white">

    <div class="absolute text-4xl font-bold top-5 left-5 text-primary">
        Job Traker
    </div>

    <div class="w-[70rem] relative">

        <div class="m-5 text-4xl 0 w-[50rem]">
            Company Info:
            <p class="text-sm">who is the company, what it does, and whare it lives, all of that is important is
                buiseness world</p>
        </div>

        <div>
            <form wire:submit.prevent='save' class="grid grid-cols-2 gap-4 py-10">

                <div class="grid items-start">

                    <div class="flex flex-col p-1 ">
                        {{--  <x-input-label>Company name</label> --}}
                        <x-input-label>Company name</x-input-label>
                        <input wire:model.defer='name' type="text"
                            class="border-gray-200 rounded-lg w-3/4 focus:ring-0 focus:border-blue-200 duration-300 outline-0 " />

                        @error('name')
                            <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col p-1 ">
                        <x-input-label>Country</x-input-label>
                        <input wire:model.defer='country' type="text"
                            class="border-gray-200 rounded-lg w-3/4 focus:ring-0 focus:border-blue-200 duration-300 outline-0 " />

                        @error('country')
                            <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col p-1 ">
                        <x-input-label>Work specification</x-input-label>
                        <input wire:model.defer='specification' type="text"
                            class="border-gray-200 rounded-lg w-3/4 focus:ring-0 focus:border-blue-200 duration-300 outline-0 " />

                        @error('specification')
                            <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div x-data="{ about: '' }" class=" flex flex-col p-1 ">

                    <x-input-label>About the company (<span
                            :class="{ 'text-red-500': about.length < 255, 'text-green-500': about.length >= 255 }"
                            x-text="about.length +'/255+'"></span>)
                    </x-input-label>

                    <textarea wire:model.defer='about' x-model="about"
                        class="border-gray-200 rounded-lg w-[25rem] h-96 focus:ring-0  focus:border-blue-200 duration-300 outline-0 "></textarea>

                    @error('about')
                        <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-span-2 pt-20  flex justify-center">
                    <x-primary-button class="flex justify-center w-96">Next</x-primar-button>
                </div>
            </form>
        </div>

        <x-loading.loading-spinner-2 />

    </div>
</div>
