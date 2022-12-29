<?php

namespace App\Http\Livewire\Job;

use App\Services\JobService;
use Livewire\Component;

class Details extends Component
{
    public $jobId;

    protected $listeners = ["job:changed" => "changeJob"];

    public function changeJob($id)
    {
        $this->jobId = $id;
    }

    public function getJobProperty()
    {
        return JobService::allAboutWork($this->jobId);
    }


    public function render()
    {
        return view('livewire.job.details');
    }
}
