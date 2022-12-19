<div class="flex justify-between w-full">
    <div class="w-52">
        <img class="w-full rounded-full ring-4 ring-sky-500" src="{{ asset('storage/' . auth()->user()->photo) }}"
            alt="">
    </div>
    <div class="flex flex-col gap-2">
        <a href="{{ route('resume.preview') }}"
            class="px-4 py-2 text-green-500 transition-all border-2 border-green-500 rounded-lg cursor-pointer hover:text-white hover:bg-green-500">
            View Resume
        </a>
        <a href="{{ route('resume.download') }}"
            class="px-4 py-2 transition-all border-2 rounded-lg cursor-pointer text-sky-500 border-sky-500 hover:text-white hover:bg-sky-500">
            Download Resume
        </a>
    </div>
</div>
