<?php

namespace App\Http\Livewire\User\Steps;

use App\Models\Skill;
use App\Traits\dealWithRoles;
use Illuminate\Support\Facades\DB;
use Spatie\LivewireWizard\Components\StepComponent;

class Skills extends StepComponent
{

    public function save($skills)
    {
        $this->setSessionData($skills);
        $this->nextStep();
    }

    protected function setSessionData($skills)
    {
        $skills_ids = collect($skills)->map(fn ($el) => $el['id']);

        session()->put("profile.skills", $skills_ids->toArray());
    }


    public function render()
    {
        return view('livewire.user.steps.skills')
            ->with("skills", DB::table("skills")->select("name", "id")->get());
    }
}
