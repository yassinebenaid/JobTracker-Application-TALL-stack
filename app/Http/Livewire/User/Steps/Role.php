<?php

namespace App\Http\Livewire\User\Steps;

use App\Enums\Roles;
use Spatie\LivewireWizard\Components\StepComponent;


class Role extends StepComponent
{

    public function emploee()
    {
        $this->setRole(Roles::EMPLOEE);
        $this->jumpToNextStep(Roles::EMPLOEE);
    }

    public function entrepreneur()
    {
        $this->setRole(Roles::ENTREPRENEUR);
        $this->jumpToNextStep(Roles::ENTREPRENEUR);
    }

    private function setRole(Roles $role): void
    {
        session()->forget("profile.role");
        session()->put("profile.role", $role->value);
    }

    private function jumpToNextStep(Roles $role)
    {
        if ($role === Roles::EMPLOEE) return $this->showStep("personal-info");
        elseif ($role === Roles::ENTREPRENEUR) return $this->showStep("company-info");
    }
}
