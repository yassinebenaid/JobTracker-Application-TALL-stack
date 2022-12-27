<?php

namespace App\Http\Livewire\User\Steps;

use App\Enums\Roles;
use App\Traits\dealWithRoles;
use Spatie\LivewireWizard\Components\StepComponent;

class PersonalInfo extends StepComponent
{
    /**
     * user full name
     *
     * @var [type]
     */
    public $name;

    /**
     * user country
     *
     * @var [type]
     */
    public $country;

    /**
     * user birthday
     *
     * @var [type]
     */
    public $birthday;

    /**
     * rules for validation ( comes with livewire)
     *
     * @var array
     */
    protected $rules = [
        "name" => "required|max:255",
        "country" => "required|max:255",
        "birthday" => "required|date",
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

        $this->jumpToNextStep();
    }

    /**
     * set the data in the sessoin
     *
     * @return void
     */
    private function setDataToSession()
    {
        $data = [
            "name" => $this->name,
            "country" => $this->country,
            "birthday" => $this->birthday
        ];

        session()->put("profile.personal-info", $data);
    }

    /**
     * jump to the image step if the user is entrepreneur
     *
     * @return void
     */
    private function jumpToNextStep()
    {
        if ($this->isEmploee()) return $this->nextStep();

        if ($this->isEntrepreneur()) return $this->showStep("image");
    }

    private function isEmploee(): bool
    {
        return Roles::isEmploee(session("profile.role"));
    }

    private function isEntrepreneur(): bool
    {
        return Roles::isEntrepreneur(session("profile.role"));
    }

    /**
     * (comes with livewire)
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.user.steps.personal-info');
    }
}
