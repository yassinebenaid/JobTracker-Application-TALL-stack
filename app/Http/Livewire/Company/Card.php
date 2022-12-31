<?php

namespace App\Http\Livewire\Company;

use App\Enums\ReportReasons;
use App\Services\CompanyService;
use App\Traits\FireStatusBrowserEvents;
use Livewire\Component;

class Card extends Component
{
    use FireStatusBrowserEvents;


    public $company;
    public $opened = false;

    public $rate = 0;
    public $feedback = "";

    public $report = [
        "info" => '',
        "reason" => false
    ];

    protected $rules = [
        "rate" => "in:0,1,2,3,4,5",
        "feedback" => "required|max:300",
    ];

    public function mount()
    {
        $this->report['reason'] = ReportReasons::OTHER->value;
    }

    public function load()
    {
        CompanyService::loadAllAboutCompany($this->company);

        $this->opened = true;
    }

    public function review()
    {
        $this->validate();

        CompanyService::newReview($this->company, $this->rate, $this->feedback)
            ? $this->success("review created successfully")
            : $this->error();

        $this->load();
    }

    public function report()
    {
        $this->validate(["report.info" => "max:300"]);

        CompanyService::report($this->company, $this->report)
            ? $this->success("report sent to support to be reviewed, thanks !")
            : $this->error();

        $this->company->loadAvg("reviews", "rate");
    }
}
