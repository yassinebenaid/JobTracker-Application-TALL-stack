<div class="container m-auto ">


    @include('companies.partials.search-bar')


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
        @foreach ($this->companies as $company)
            <livewire:company.card :company="$company" :wire:key="$company->id" />
        @endforeach
    </div>

</div>
