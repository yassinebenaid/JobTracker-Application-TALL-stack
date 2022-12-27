<div class="grid justify-center w-screen h-screen p-20 bg-white">

    <div class="absolute text-4xl font-bold top-5 left-5 text-primary">
        Job Traker
    </div>

    <div class="w-[50rem] relative">

        <div class="m-5 text-4xl 0 w-[40rem]">
            Education:
            <p class="text-sm">20% of users who specify there education get 30% more hight chance to get hired</p>
        </div>
        <form wire:submit.prevent='save'>
            <div class="flex flex-col gap-2 m-20">
                <div class="flex flex-col p-1 ">
                    <label class="pl-2 text-sm">Degree</label>
                    <input wire:model.defer='degree' type="text"
                        class="border-gray-200 rounded-lg w-[25rem] focus:ring-blue-200 focus:ring-2 focus:border-blue-200 duration-300 outline-0 " />

                    @error('degree')
                        <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col p-1 ">
                    <label class="pl-2 text-sm">School</label>
                    <input wire:model.defer='school' type="text"
                        class="border-gray-200 rounded-lg w-[25rem] focus:ring-blue-200 focus:ring-2 focus:border-blue-200 duration-300 outline-0 " />

                    @error('school')
                        <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col p-1 ">
                    <label class="pl-2 text-sm">Date</label>
                    <input wire:model.defer='date' type="date"
                        class="border-gray-200 rounded-lg w-[25rem] focus:ring-blue-200 focus:ring-2 focus:border-blue-200 duration-300 outline-0 " />

                    @error('date')
                        <span class="text-sm text-red-500 w-[26rem]">{{ $message }}</span>
                    @enderror
                </div>


                <div class="flex flex-col pt-20 ">
                    <button
                        class="bg-sky-500 w-[25rem] text-white py-2 px-10 rounded-lg shadow shadow-sky-500  ">Next</button>
                </div>
            </div>
        </form>

        <x-loading.loading-spinner-2 />

    </div>
</div>
