<?php

namespace App\Http\Livewire\Company;

use App\Enums\ReportReasons;
use App\Helpers\Promise;
use App\Http\Livewire\BaseComponent;
use App\Services\CompanyService;
use App\Traits\FireStatusBrowserEvents;

class Card extends BaseComponent
{
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

        Promise::make(fn () =>  CompanyService::newReview($this->company, $this->rate, $this->feedback))
            ->then(fn () => $this->success("review created successfully"))
            ->catch(fn () =>  $this->error());

        $this->load();
    }

    public function report()
    {
        $this->validate(["report.info" => "max:300"]);

        Promise::make(fn () => CompanyService::report($this->company, auth()->id(), $this->report))
            ->then(fn () => $this->success("report sent to support to be reviewed, thanks !"))
            ->catch(fn () =>  $this->error());

        $this->company->loadAvg("reviews", "rate");
    }
}
