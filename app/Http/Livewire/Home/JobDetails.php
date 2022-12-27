<?php

namespace App\Http\Livewire\Home;

use App\Services\WorkService;
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
        return WorkService::allAboutWork($this->jobId);
    }


    public function render()
    {
        return view('livewire.home.job-details');
    }
}
