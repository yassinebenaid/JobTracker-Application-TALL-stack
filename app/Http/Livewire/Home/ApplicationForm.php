<?php

namespace App\Http\Livewire\Home;

use App\Jobs\sendNewApplicationEmail;
use App\Services\ApplicationService;
use App\Traits\FireStatusBrowserEvents;
use Faker\Provider\Lorem;
use Livewire\Component;

class ApplicationForm extends Component
{
    use FireStatusBrowserEvents;

    public $expected_salary;
    public $cover;
    public $company_id;
    public $job_id;


    protected function rules()
    {
        return [
            "expected_salary" => "required|integer",
            "cover" => "required|min:100"
        ];
    }

    protected function getValidationAttributes()
    {
        return [
            "cover" => "cover letter",
            "expected_salary" => "expected salary"
        ];
    }


    public function save()
    {
        $this->validate();

        if ($application = ApplicationService::new($this->all())) :

            // dispatch(new sendNewApplicationEmail(auth()->id(), $this->company_id, $this->cover,  $application->id));
            ApplicationService::notifyTheCompany($application);

            $this->success("your application was sent successfully, waiting the company to review it and reply.");

        else :

            $this->error();

        endif;
    }
}
