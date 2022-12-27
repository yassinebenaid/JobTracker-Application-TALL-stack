<div x-data="dropAndDrag" class="grid justify-center w-screen h-screen p-20 bg-white select-none">

    <div class="absolute text-4xl font-bold top-5 left-5 text-primary">
        Job Traker
    </div>

    <div class="w-[50rem]">

        <div class="m-5  0 w-[40rem] ">
            <div class="text-4xl"> Skills:</div>
            <p class="text-sm">what are exactly your ablilities</p>
        </div>

        <div class="relative">
            <div class="flex flex-col items-center gap-2 m-20">

                <div class="flex flex-wrap w-full gap-2 p-5 text-sm text-gray-300 border rounded-lg select-none">
                    <p x-show="!hasSkills">choose your skills from the above list</p>

                    <template x-for="item in skills" :key="index">
                        <div x-on:click="removeSkill(item.id)"
                            class="flex items-center px-5 text-white border-2 cursor-pointer rounded-2xl bg-amber-700 border-amber-700">
                            <span x-text="item.name"></span>
                            <i class="-my-1 text-2xl bi bi-dash"></i>
                        </div>
                    </template>
                </div>

                <div class="flex flex-wrap gap-4 p-10 overflow-y-scroll h-96 ">

                    @foreach ($skills as $skill)
                        <div x-on:click="addSkill('{{ $skill->name }}','{{ $skill->id }}')"
                            class="flex items-center px-5 border-2 cursor-pointer rounded-2xl text-amber-700 border-amber-700">
                            {{ $skill->name }}
                            <i class="-my-1 text-2xl bi bi-plus"></i>
                        </div>
                    @endforeach
                </div>

                <div class="flex flex-col pt-20 ">
                    <button x-on:click="$wire.save(skills)"
                        class="bg-sky-500 w-[25rem] text-white py-2 px-10 rounded-lg shadow shadow-sky-500  ">Next</button>
                </div>
            </div>

            <x-loading.loading-spinner-2 />

        </div>
    </div>


</div>
