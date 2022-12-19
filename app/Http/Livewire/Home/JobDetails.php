<?php

namespace App\Http\Livewire\Home;

use App\Services\JobService;
use Livewire\Component;

class JobDetails extends Component
{
    public $jobId;

    protected $listeners = ["job:changed" => "changeJob"];

    public function changeJob($id)
    {
        $this->jobId = $id;
    }

    public function getJobProperty()
    {
        return JobService::allAboutJob($this->jobId);
    }


    public function render()
    {
        return view('livewire.home.job-details');
    }
}
