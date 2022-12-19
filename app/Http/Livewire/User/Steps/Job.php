<?php

namespace App\Http\Livewire\User\Steps;

use App\Traits\dealWithRoles;
use Spatie\LivewireWizard\Components\StepComponent;


class Job extends StepComponent
{
    public $job = '';
    public $years_of_expe = '';


    protected $rules = [
        "job" => "required|max:255",
        "years_of_expe" => "required|lt:50",
    ];

    /**
     * submit the form , validate and set the data in the session to save it later
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $this->setDataToSession();

        $this->nextStep();
    }

    /**
     * set the data in the sessoin
     *
     * @return void
     */
    private function setDataToSession()
    {
        $data = [
            "job" => $this->job,
            "years_of_expe" => $this->years_of_expe,
        ];

        session()->put("profile.job", $data);
    }


    public function render()
    {
        return view('livewire.user.steps.job');
    }
}
