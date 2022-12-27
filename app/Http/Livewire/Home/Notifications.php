<?php

namespace App\Http\Livewire\Home;

use App\Enums\Roles;
use App\Services\ApplicationService;
use Livewire\Component;

class Notifications extends Component
{
    public $applications = [];

    public function refresh()
    {
    }


    public function render()
    {
        return view('livewire.home.notifications');
    }
}
