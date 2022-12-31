<div>
    <div class="pl-3 text-sm font-semibold">Skills</div>
    <div class="p-4  px-8 border-l flex flex-wrap w-80 gap-2 items-start justify-start max-h-[30rem] overflow-scroll">

        @foreach ($this->skills as $skill)
            <div
                class="grid justify-between w-full grid-cols-5 px-4 py-1 font-semibold text-center cursor-pointer text-slate-800">

                <label class="col-span-4 cursor-pointer" for="skill_{{ $skill->id }}">{{ $skill->name }}</label>

                <input wire:model.defer='filters.skills' value="{{ $skill->id }}" id="skill_{{ $skill->id }}"
                    class="p-3 rounded-md border-slate-300 text-sky-500 focus:ring-0 " type="checkbox" name="date">
            </div>
        @endforeach

    </div>
</div>
