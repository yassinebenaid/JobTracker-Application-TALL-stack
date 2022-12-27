<?php

namespace App\Traits;

use Livewire\ComponentConcerns\ReceivesEvents;

trait FireStatusBrowserEvents
{
    use ReceivesEvents;

    public function success(string $message)
    {
        return $this->dispatchBrowserEvent("status:success", [
            "message" => $message
        ]);
    }

    public function error(string $message = "somthing went wrong")
    {
        return $this->dispatchBrowserEvent("status:error", [
            "message" => $message
        ]);
    }

    public function info(string $message)
    {
        return $this->dispatchBrowserEvent("status:info", [
            "message" => $message
        ]);
    }
}
