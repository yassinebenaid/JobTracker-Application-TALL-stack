<?php

namespace App\Http\Livewire\Job;

use App\Http\Livewire\BaseComponent;
use App\Services\JobService;

class MyList extends BaseComponent
{
    protected $listeners = ["job:list-updated" => "load"];

    public $jobs;

    public function mount()
    {
        $this->load();
    }


    public function load()
    {
        $this->jobs =  JobService::getCompanyJobsList(auth()->user());
    }
}
