<div class="grid justify-center w-screen h-screen p-20 bg-white">

    <div class="absolute text-4xl font-bold top-5 left-5 text-primary">
        Job Traker
    </div>

    <div class="w-[50rem] relative">

        <div class="m-5 text-4xl 0 w-[50rem]">
            Personal Info:
            <p class="text-sm">tell us about your self to help us give you the right recommendation</p>
        </div>

        <div>
            <form wire:submit.prevent='save' class="flex flex-col gap-2 m-20 i">
                <div class="flex flex-col p-1 ">
                    <label class="pl-2 text-sm">Full name</label>
                    <input wire:model.defer='name' type="text"
                        class="border-gray-200 rounded-lg w-[25rem] focus:ring-blue-200 focus:ring-2 focus:border-blue-200 duration-300 outline-0 " />

                    @error('name')
                        <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col p-1 ">
                    <label class="pl-2 text-sm">Country</label>
                    <input wire:model.defer='country' type="text"
                        class="border-gray-200 rounded-lg w-[25rem] focus:ring-blue-200 focus:ring-2 focus:border-blue-200 duration-300 outline-0 " />

                    @error('country')
                        <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col p-1 ">
                    <label class="pl-2 text-sm">Birthday</label>
                    <input wire:model.defer='birthday' type="date"
                        class="border-gray-200 rounded-lg w-[25rem] focus:ring-blue-200 focus:ring-2 focus:border-blue-200 duration-300 outline-0 " />

                    @error('birthday')
                        <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                    @enderror
                </div>


                <div class="flex flex-col pt-20 ">
                    <button type="submit"
                        class="bg-sky-500 w-[25rem] text-white py-2 px-10 rounded-lg shadow shadow-sky-500  ">Next</button>
                </div>
            </form>
        </div>

        <x-loading.loading-spinner-2 />

    </div>
</div>
