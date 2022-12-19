<div class="h-20 bg-white shadow-sm">
    <div class="container flex items-center justify-between h-full m-auto">
        <div class="flex items-center gap-20">
            <a href="{{ route('home') }}" class="flex items-center gap-1">
                <img class="w-14" src="{{ asset('images/icon.png') }}">
                <div class="text-3xl text-sky-600 f">
                    Job Tracker
                </div>
            </a>

            <ul class="flex items-center gap-5 ">
                <li class="px-3 py-2 transition-all cursor-pointer hover:text-sky-500 ">Jobs</li>
                <li class="px-3 py-2 transition-all cursor-pointer hover:text-sky-500">Companies/Entrepreneurs</li>
            </ul>
        </div>
        <div>
            <ul class="flex items-center text-2xl gap-7">
                <li><i class="bi bi-bell"></i></li>
                <li><i class="bi bi-chat-left-dots-fill"></i></li>

                <li x-data="dropdown" class="relative">
                    <i x-on:click="toggle"
                        class="transition-all cursor-pointer hover:text-sky-500 bi bi-person-fill"></i>
                    <x-main.profile-model x-show="open" x-cloak x-collapse x-on:click.outside="hide" />
                </li>
            </ul>
        </div>
    </div>
</div>
