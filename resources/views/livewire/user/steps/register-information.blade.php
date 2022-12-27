<div class="grid justify-center w-screen h-screen p-20 bg-white">

    <div class="absolute text-4xl font-bold top-5 left-5 text-primary">
        Job Traker
    </div>

    <div class="w-[50rem] relative">

        <div class="m-5 text-4xl  w-[40rem]">
            Finished
        </div>

        <div class="p-20 ">
            <div class="py-5">
                now that everything is ok, here is the golden rules of how to use our services:
            </div>


            @if ($role === \App\Enums\Roles::ENTREPRENEUR->value)
                <ul class="p-5">
                    <li class="py-2 tracking-wider"> • you register a new job </li>
                    <li class="py-2 tracking-wider"> • you have the choice to include a test with the job post, and the
                        emploees won't be able to send there applications unless the submit the test </li>
                    <li class="py-2 tracking-wider"> • the freelancers/emploees send there applications to you, and you
                        are able to accept or decline them.
                    </li>
                    <li class="py-2 tracking-wider"> • wethere you accept or decline the application, the will be told.
                    </li>
                    <li class="py-2 tracking-wider"> • in case you accept the application, you can gi
                    </li>
                </ul>
            @else
                <ul class="p-5">
                    <li class="py-2 tracking-wider"> • A company register a new job</li>
                    <li class="py-2 tracking-wider"> • You are in face of two choices , the company registered a test,
                        in
                        this case you
                        should pass the
                        test to be able to send you application, and the normal case is no test is registered , then you
                        easly send your application
                    </li>
                    <li class="py-2 tracking-wider"> • Once the company recieves you application , they may contact you
                        , or
                        thay may
                        reject your
                        application, in the two cases you will be notified
                    </li>
                </ul>
            @endif
        </div>

        <div class="flex justify-end">
            <button wire:click='save' class="self-end px-6 py-2 text-white rounded-lg x-5 bg-sky-500 w-max">
                Finished
            </button>
        </div>

        <x-loading.loading-spinner-2 />

    </div>
</div>
