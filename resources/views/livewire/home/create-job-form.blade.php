<div x-cloak x-show="open" x-on:status:success="hide"
    class="fixed top-0 left-0 z-50 grid w-screen h-screen bg-slate-500/30 place-content-center">

    <div x-show="open" x-transition x-on:click.outside="hide"
        class="relative grid grid-cols-2 p-5 bg-white rounded-lg shadow shadow-white ">
        <div class="col-span-2 text-xl font-semibold ">
            New Job
        </div>
        <div class="flex flex-col gap-2 p-8 w-[30rem]">
            <div>
                <x-input-label for="job" :value="__('Job Title')" />
                <x-text-input wire:model.defer='title' id="job" type="text" class="block w-full mt-1" required
                    autocomplete="job" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div>
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input wire:model.defer='country' id="country" type="text" class="block w-full mt-1"
                    required autocomplete="country" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>
            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input wire:model.defer='city' id="city" type="text" class="block w-full mt-1" required
                    autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div>
                <x-input-label for="salary" :value="__('Salary')" />
                <x-text-input wire:model.defer='salary' id="salary" type="number" class="block w-full mt-1" required
                    autocomplete="salary" />
                <x-input-error class="mt-2" :messages="$errors->get('salary')" />
            </div>

            <div>
                <x-input-label for="type" :value="__('Type')" />
                <select wire:model.defer='type' id="type"
                    class="block w-full mt-1 rounded-lg cursor-pointer border-slate-200" required>
                    <option></option>

                    @foreach (\App\Enums\JobTypes::cases() as $type)
                        <option value="{{ $type->value }}">{{ $type->name }}</option>
                    @endforeach

                </select>
                <x-input-error class="mt-2" :messages="$errors->get('type')" />
            </div>



            <div
                class="p-4  px-8 border-l flex flex-wrap w-80 gap-2 items-start justify-start max-h-[15rem] overflow-scroll">

                @foreach ($this->skills as $skill)
                    <div
                        class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">

                        <label class="col-span-4 cursor-pointer"
                            for="skill_{{ $skill->id }}">{{ $skill->name }}</label>

                        <input wire:model.defer='required_skills' value="{{ $skill->id }}"
                            id="skill_{{ $skill->id }}"
                            class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox"
                            name="date">
                    </div>
                @endforeach

            </div>
        </div>


        <div class="w-[30rem] p-8">
            <div>
                <x-input-label for="description" :value="__('Description')" />

                <textarea wire:model.defer='description' id="description" name="description" type="number"
                    class="block w-full mt-1 rounded-lg focus:ring-sky-500 focus:border-sky-500 border-slate-200 h-60" required
                    autocomplete="description"></textarea>

                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div x-data="criteria" class="min-h-[20rem] p-3">

                <div class="flex justify-between w-full">
                    <span class="text-sm font-semibold text-slate-800">Criteria</span>

                    <i x-on:click="increase"
                        class="p-2 text-2xl transition-all rounded-md cursor-pointer hover:bg-slate-100 bi bi-plus-lg"></i>
                </div>


                <div x-data="{ criteria: @entangle('criteria').defer }" class="flex flex-col gap-3 overflow-scroll h-[18rem]">

                    <template x-for="(item,index) in items" :key="index">
                        <div class="relative">
                            <x-input-label for="#1" x-text="'#'+item" />
                            <x-text-input x-model='criteria[index]' x-init="criteria[index] = ''" id="#1"
                                type="text"
                                class="block w-full mt-1 transition-all border-0 border-b-2 rounded-none focus:ring-0 focus:border-0 focus:border-b-2" />
                        </div>
                    </template>

                </div>

            </div>
        </div>

        <div class="absolute flex justify-end col-span-2 bottom-4 right-4">
            <x-primary-button wire:click='save' wire:loading.attr='disabled'
                wire:loading.class='cursor-not-allowed opacity-80'>
                <x-loading.loading-spiner />
                Create Job
            </x-primary-button>
        </div>

    </div>

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
