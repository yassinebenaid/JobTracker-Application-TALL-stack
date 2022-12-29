<?php

namespace App\Http\Livewire\Company;

use App\Services\CompanyService;
use Livewire\Component;

class CompaniesList extends Component
{
    public $search;

    public function getCompaniesProperty()
    {
        return CompanyService::getCompaniesRandomList($this->search);
    }
}
