<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BaseComponent extends Component
{
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
