<?php

namespace App\Http\Livewire\User\Steps;

use App\Enums\Roles;
use Spatie\LivewireWizard\Components\StepComponent;


class Role extends StepComponent
{

    public function emploee()
    {
        $this->setRole(Roles::EMPLOEE);
        $this->nextStep();
    }

    public function entrepreneur()
    {
        $this->setRole(Roles::ENTREPRENEUR);
        $this->nextStep();
    }

    private function setRole(Roles $role): void
    {
        session()->forget("profile.role");
        session()->put("profile.role", $role->value);
    }

    public function render()
    {
        return view('livewire.user.steps.role');
    }
}
