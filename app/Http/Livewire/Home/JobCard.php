<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class JobCard extends Component
{
    public $job;

    public function render()
    {
        return view('livewire.home.job-card');
    }
}
