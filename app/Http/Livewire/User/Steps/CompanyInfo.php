<?php

namespace App\Http\Livewire\User\Steps;


use Spatie\LivewireWizard\Components\StepComponent;

class CompanyInfo extends StepComponent
{
    /**
     * company name
     *
     * @var string
     */
    public $name;

    /**
     *  country
     *
     * @var
     */
    public $country;

    /**
     * user birthday
     *
     * @var [type]
     */
    public $specification;

    /**
     * about the company
     *
     * @var [type]
     */
    public $about;

    /**
     * rules for validation ( comes with livewire)
     *
     * @var array
     */
    protected $rules = [
        "name" => "required|max:255",
        "country" => "required|max:255",
        "specification" => "required|max:255",
        "about" => "required|min:255"
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

        $this->showStep("image");
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
            "specification" => $this->specification,
            "about" => $this->about
        ];

        session()->put("profile.company-info", $data);
    }
}
