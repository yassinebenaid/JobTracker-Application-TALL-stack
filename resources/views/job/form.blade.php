@props(['action' => 'create', 'job' => null])


<div x-cloak x-show="open" x-on:status:success.window="(hide(),$refs.form.reset())"
    class="fixed top-0 left-0 z-50 grid w-screen h-screen bg-slate-500/30 place-content-center">

    <form wire:submit.prevent='save' x-show="open" x-transition x-ref="form"
        class="relative grid grid-cols-2 p-5 bg-white rounded-lg shadow shadow-white ">


        <div class="flex justify-between col-span-2 text-xl font-semibold">
            <span>{{ $action === 'create' ? 'New Job' : 'Edit Job' }}</span>

            <i class="font-bold bi bi-x-lg" x-on:click="(hide(),$refs.form.reset())"></i>
        </div>


        <div class="flex flex-col gap-2 p-8 w-[30rem]">

            <div>
                <x-input-label for="title" :value="__('Job Title')" />
                <input wire:model.defer="{{ !is_null($job) ? 'job.' : null }}title" id="title" type="text"
                    class='block w-full mt-1 border rounded-md shadow-sm border-slate-300 focus:border-sky-500 focus:ring-0 focus:outline-0'
                    required>

                @error(!is_null($job) ? 'job.title' : 'title')
                    <div class="mt-1 space-y-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <x-input-label for="country" :value="__('Country')" />
                <input wire:model.defer='{{ !is_null($job) ? 'job.' : null }}country' id="country" type="text"
                    class='block w-full mt-1 border rounded-md shadow-sm border-slate-300 focus:border-sky-500 focus:ring-0 focus:outline-0'
                    required autocomplete="country" />

                @error(!is_null($job) ? 'job.country' : 'country')
                    <div class="mt-1 space-y-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <x-input-label for="city" :value="__('City')" />
                <input wire:model.defer='{{ !is_null($job) ? 'job.' : null }}city' id="city" type="text"
                    class='block w-full mt-1 border rounded-md shadow-sm border-slate-300 focus:border-sky-500 focus:ring-0 focus:outline-0'
                    required autocomplete="city" />

                @error(!is_null($job) ? 'job.city' : 'city')
                    <div class="mt-1 space-y-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <x-input-label for="salary" :value="__('Salary')" />
                <input wire:model.defer='{{ !is_null($job) ? 'job.' : null }}salary' id="salary" type="number"
                    class='block w-full mt-1 border rounded-md shadow-sm border-slate-300 focus:border-sky-500 focus:ring-0 focus:outline-0'
                    required autocomplete="salary" />

                @error(!is_null($job) ? 'job.salary' : 'salary')
                    <div class="mt-1 space-y-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <x-input-label for="type" :value="__('Type')" />

                <select wire:model.defer='{{ !is_null($job) ? 'job.type' : 'type' }}' id="type"
                    class="block w-full mt-1 rounded-lg cursor-pointer border-slate-200" required>

                    <option>Select a type</option>

                    @foreach (\App\Enums\JobTypes::cases() as $case)
                        <option value="{{ $case->value }}"> {{ $case->name() }} </option>
                    @endforeach

                </select>

                @error(!is_null($job) ? 'job.type' : 'type')
                    <div class="mt-1 space-y-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <div class="text-sm font-semibold">Skills</div>

                <div
                    class="p-4  px-8 border-l flex flex-wrap w-80 gap-2 items-start justify-start max-h-[15rem] overflow-scroll">

                    @foreach ($this->skills as $skill)
                        <div
                            class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center text-slate-800">
                            <label for="{{ $action . '-skill-' . $loop->index }}"
                                class="col-span-4 cursor-pointer">{{ $skill->name }}</label>

                            <input wire:model.defer="required_skills" value="{{ $skill->id }}"
                                id="{{ $action . '-skill-' . $loop->index }}"
                                class="p-3 rounded-md cursor-pointer border-slate-300 text-sky-500 focus:ring-0 "
                                type="checkbox">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>


        <div class="w-[30rem] p-8">

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <textarea wire:model.defer='{{ !is_null($job) ? 'job.' : null }}description' id="description" name="description"
                    class="block w-full mt-1 rounded-lg focus:ring-sky-500 focus:border-sky-500 border-slate-200 h-60" required
                    autocomplete="description"></textarea>

                @error(!is_null($job) ? 'job.description' : 'description')
                    <div class="mt-1 space-y-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div x-data="criteria" class="min-h-[20rem] p-3">

                <div class="flex justify-between w-full">
                    <span class="text-sm font-semibold text-slate-800">Criteria <span
                            class="text-sm font-normal text-slate-400">(seperated by coma)</span></span>
                </div>

                <textarea wire:model.defer='{{ !is_null($job) ? 'job.' : null }}criteria' id="criteria" name="criteria"
                    class="block w-full h-20 mt-1 rounded-lg focus:ring-sky-500 focus:border-sky-500 border-slate-200"></textarea>
            </div>
        </div>

        <div class="absolute flex justify-end col-span-2 bottom-4 right-4">
            <x-primary-button wire:loading.attr='disabled' wire:loading.class='cursor-not-allowed opacity-80'>
                <x-loading.loading-spiner />
                {{ $action === 'create' ? 'Create' : 'Edit' }}
            </x-primary-button>
        </div>

    </form>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('criteria', () => ({
                criteria: ['hello world'],
                items: 1,
                increase() {
                    if (this.items < 8) this.items++
                },
            }))
        })
    </script>
</div>
