<?php

namespace App\Http\Livewire\Job;

use Livewire\Component;

class Card extends Component
{
    public $job;

    public function render()
    {
        return view('livewire.job.card');
    }
}
