<?php

namespace App\Http\Livewire\Job;

use App\Enums\ReportReasons;
use App\Services\JobService;
use App\Traits\FireStatusBrowserEvents;
use Livewire\Component;

class Report extends Component
{
    use FireStatusBrowserEvents;

    public $job;


    public $report = [
        "info" => "",
        "reason" => ''
    ];

    protected $rules = [
        "report.info" => "max:300"
    ];

    protected $validationAttributes = [
        "report.info" => "additional information field"
    ];


    public function mount()
    {
        $this->report['reason'] = ReportReasons::OTHER->value;
    }


    public function report()
    {
        $this->validate();

        JobService::report($this->job, auth()->id(), $this->report)
            ? $this->success("report sent to support to be reveiwed , thanks")
            : $this->error();
    }
}
