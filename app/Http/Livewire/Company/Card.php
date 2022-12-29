<?php

namespace App\Http\Livewire\Company;

use App\Services\CompanyService;
use Livewire\Component;

class Card extends Component
{
    public $company;
    public $opened = false;

    public $rate = 0;
    public $feedback = "";


    protected $rules = [
        "review.rate" => "in:0,1,2,3,4,5",
        "review.feedback" => "required|max:300"
    ];

    public function load()
    {
        $this->company = CompanyService::loadAllAboutCompany($this->company->id);
        $this->opened = true;
    }

    public function save()
    {
        $this->validate();
    }
}
