<form wire:submit.prevent='report' x-on:status:success.window="$el.reset()" x-cloak x-show="report"
    class="grid h-[40rem] p-6 col-span-5">

    <div>
        <div class="text-lg font-semibold">
            laravel developer needed.
        </div>
        <div>
            Company
        </div>
    </div>

    <div class="grid gap-4 p-5 pl-20">

        @foreach (\App\Enums\ReportReasons::cases() as $reason)
            <div>
                <input wire:model.defer='report.reason' class="cursor-pointer" name="report_choice" type="radio"
                    id="{{ $reason->value }}" value="{{ $reason->value }}">
                <label class="cursor-pointer" for="{{ $reason->value }}">{{ $reason->forCompany() }}</label>
            </div>
        @endforeach

    </div>

    <div class="py-5">
        <label for="otherinfo" class="font-semibold">Additional information.</label>
        <textarea wire:model.defer='report.info'
            class="w-5/6 rounded-lg resize-none border-slate-400 focus:ring-0 focus:border-sky-500"></textarea>

        @error('report.info')
            <div class="w-5/6 text-sm text-center text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex items-center justify-end">
        <button type="submit"
            class="px-8 py-2 transition-all border-2 rounded-lg border-sky-600 text-sky-600 hover:text-white hover:bg-sky-600"><i
                class="bi bi-flag-fill"></i> Report
        </button>
    </div>

</form>
