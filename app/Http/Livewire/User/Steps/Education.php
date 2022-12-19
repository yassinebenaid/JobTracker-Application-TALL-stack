<?php

namespace App\Http\Livewire\User\Steps;

use App\Traits\dealWithRoles;
use Spatie\LivewireWizard\Components\StepComponent;

class Education extends StepComponent
{
    public $degree = '';
    public $school = '';
    public $date = '';

    protected $rules = [
        "degree" => "required|max:255",
        "school" => "required|max:255",
        "date" => "required|date",
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
            "degree" => $this->degree,
            "school" => $this->school,
            "degree_year" => $this->date
        ];

        session()->put("profile.education", $data);
    }


    public function render()
    {

        return view('livewire.user.steps.education');
    }
}
