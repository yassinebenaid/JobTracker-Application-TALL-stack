<?php

namespace App\Http\Livewire\Application;

use App\Helpers\Promise;
use App\Http\Livewire\BaseComponent;
use App\Services\ApplicationService;


class Form extends BaseComponent
{

    public $expected_salary;
    public $cover = '';
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

        Promise::make(fn () => ApplicationService::new($this->all()))

            ->then(fn ($application) =>  ApplicationService::notifyTheCompany($application))

            ->then(fn () =>  $this->success("your application was sent successfully, waiting the company to review it."))

            ->catch(fn () =>  $this->error());
    }
}
