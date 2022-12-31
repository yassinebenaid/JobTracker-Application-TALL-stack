<?php

namespace App\Http\Livewire\Job;

use App\Models\Job;
use App\Services\JobService;
use Livewire\Component;

class Details extends Component
{
    public $jobId;
    public $inWishlist;

    protected $listeners = ["job:changed" => "changeJob"];


    public function changeJob($id)
    {
        $this->jobId = $id;
    }

    public function getJobProperty()
    {
        return JobService::allAboutJob($this->jobId);
    }

    public function wishlist()
    {
        $this->inWishlist = JobService::toggleToWishlist($this->job);
    }


    public function render()
    {
        $this->inWishlist = JobService::inWishlist($this->job);

        return view('livewire.job.details');
    }
}
