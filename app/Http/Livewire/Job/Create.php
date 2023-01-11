<?php

namespace App\Http\Livewire\Job;

use App\Enums\JobTypes;
use App\Enums\Roles;
use App\Helpers\Promise;
use App\Http\Livewire\BaseComponent;
use App\Services\JobService;
use App\Services\SkillService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Create extends BaseComponent
{
    use AuthorizesRequests;


    public $title;
    public $country;
    public $city;
    public $salary;
    public $type;
    public $description;
    public $criteria;
    public $required_skills = [];

    protected function rules()
    {
        return [
            "title" => "required|max:255",
            "country" => "required|max:255",
            "city" => "required|max:255",
            "salary" => "required|integer",
            "type" => "required",
            "criteria" => "max:1000",
            "description" => "required",
        ];
    }


    public function getSkillsProperty()
    {
        return SkillService::applyListOfSkills();
    }


    public function save()
    {
        abort_if(!auth()->user()->hasRole(Roles::ENTREPRENEUR->value), 403);

        $this->validate();



        Promise::make(fn () => JobService::new($this->all()))

            ->then(fn () =>   $this->emitUp("job:list-updated"))

            ->then(fn () =>   $this->success("job created successfully."))

            ->catch(fn () => $this->error("failed to create the job, checkout the data and try again"));
    }
}
