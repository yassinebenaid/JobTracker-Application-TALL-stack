<div class="grid justify-center w-screen h-screen p-20 bg-white">

    <div class="absolute text-4xl font-bold top-5 left-5 text-primary">
        Job Traker
    </div>

    <div class="w-[50rem] relative">

        <div class="m-5 text-4xl 0 w-[40rem]">
            Who are you:

        </div>

        <div class="p-20 ">
            <div wire:click='emploee'
                class="flex m-5 overflow-hidden transition-all rounded-lg shadow cursor-pointer hover:scale-105">
                <i class="px-5 py-8 text-4xl text-white bi bi-person bg-sky-500"></i>
                <div class="px-5 py-8">
                    <span class="text-2xl">Emploee/Freelancer</span>
                    <p class="text-sm">someone who is looking for a job</p>
                </div>
            </div>
            <div wire:click='entrepreneur'
                class="flex m-5 overflow-hidden transition-all rounded-lg shadow cursor-pointer hover:scale-105">
                <i class="px-5 py-8 text-4xl text-white bi bi-building bg-sky-500"></i>
                <div class="px-5 py-8">
                    <span class="text-2xl">Entrepreneur</span>
                    <p class="text-sm">someone who has a project/company</p>
                </div>
            </div>

        </div>

        <x-loading.loading-spinner-2 />

    </div>
</div>
