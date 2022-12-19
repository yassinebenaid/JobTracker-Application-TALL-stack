<div class="grid justify-center w-screen h-screen p-20 bg-white">

    <div class="absolute text-4xl font-bold top-5 left-5 text-primary">
        Job Traker
    </div>

    <div class="w-[50rem]">

        <div class="m-5 text-4xl 0 w-[50rem]">
            Image:
            <p class="text-sm">add an image to your profile to make it look serious</p>
        </div>

        <div x-data>
            <div class="flex flex-col items-center gap-2 m-20">

                @if ($image)
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-[20rem] h-[20rem] overflow-hidden rounded-[50%] ">
                            <img class="w-full h-full" src="{{ $image->temporaryUrl() }}" alt="">
                        </div>
                        <div class="text-3xl">
                            {{ $username }}
                        </div>
                    </div>
                @else
                    <div x-on:click="$refs.input.click()"
                        class="w-full px-20 py-12 text-xl text-center text-blue-500 transition-all border border-blue-500 border-dashed cursor-pointer hover:bg-sky-200 bg-blue-50 ">
                        <i class="text-4xl bi bi-file-plus"></i>
                        Drag And Drop your image
                    </div>
                @endif


                @error('image')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror

                <div x-data="{ open: 0, progress: 0 }" x-show="open" x-on:livewire-upload-start.window="open=1"
                    x-on:livewire-upload-finish.window="open=0" class="px-3 py-5 rounded-lg shadow w-96"
                    x-on:livewire-upload-progress.window="progress = $event.detail.progress ">

                    <div class="w-full h-3 mt-5 rounded-lg bg-sky-100">

                        <div :style="{ 'width': progress + '%' }" class="w-0 h-full bg-blue-700 rounded-lg ">
                        </div>
                    </div>
                </div>


                <input wire:model='image' x-ref="input" type="file" class="hidden">

                <div class="flex flex-col pt-20 ">
                    <button wire:click='save'
                        class="bg-sky-500 w-[25rem] text-white py-2 px-10 rounded-lg shadow shadow-sky-500  ">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
