<div class="sticky top-0 z-50 h-20 bg-white shadow-sm">
    <div class="container flex items-center justify-between h-full m-auto">
        <div class="flex items-center gap-20">
            <a href="{{ route('home') }}" class="flex items-center gap-1">
                <img class="w-14" src="{{ asset('images/icon.png') }}">
                <div class="text-3xl text-sky-600 f">
                    Job Tracker
                </div>
            </a>

            <ul class="flex items-center gap-5 ">
                <li class="px-3 py-2 transition-all cursor-pointer hover:text-sky-500 "><a href="{{ route('home') }}">
                        Jobs </a></li>
                <li class="px-3 py-2 transition-all cursor-pointer hover:text-sky-500"><a
                        href="{{ route('companies.index') }}"> Companies/Entrepreneurs </a></li>
            </ul>
        </div>
        <div>
            <ul class="flex items-center text-2xl gap-7">

                @entrepreneur
                    <li title="My jobs"><a href="{{ route('my-jobs.index') }}">
                            <i class="transition-all cursor-pointer bi bi-briefcase hover:text-sky-500"></i>
                        </a>
                    </li>

                    <li title="applications"><a href="{{ route('application.index') }}">
                            <i class="transition-all cursor-pointer bi bi-journal hover:text-sky-500"></i>
                        </a>
                    </li>
                @endentrepreneur


                <li x-data="{ shown: false }" x-on:new:wishlist.window="shown=true" class="relative"
                    title="bookmark list">
                    <a href="{{ route('wishlist.index') }}"> <i
                            class="transition-all cursor-pointer bi bi-heart hover:text-sky-500"></i></a>
                    <x-new x-show="shown" x-cloak />
                </li>

                <livewire:home.notifications />



                <li x-data="dropdown" class="relative">
                    <i x-on:click="toggle"
                        class="transition-all cursor-pointer hover:text-sky-500 bi bi-person-fill"></i>
                    @include('includes.profile-model')
                </li>
            </ul>
        </div>
    </div>
</div>
