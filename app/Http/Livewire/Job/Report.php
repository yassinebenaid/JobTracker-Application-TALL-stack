<?php

namespace App\Http\Livewire\Job;

use App\Enums\ReportReasons;
use App\Helpers\Promise;
use App\Http\Livewire\BaseComponent;
use App\Services\JobService;

class Report extends BaseComponent
{
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

        Promise::make(fn () =>  JobService::report($this->job, auth()->id(), $this->report))
            ->then(fn () => $this->success("report sent to support to be reveiwed , thanks"))
            ->catch(fn () => $this->error());
    }
}
