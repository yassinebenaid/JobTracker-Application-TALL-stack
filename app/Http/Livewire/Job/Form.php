<?php

namespace App\Http\Livewire\Job;

use App\Enums\Roles;
use App\Services\JobService;
use App\Services\SkillService;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Form extends Component
{
    use AuthorizesRequests;


    public $title;
    public $country;
    public $city;
    public $salary;
    public $type;
    public $description;
    public $criteria = [];
    public $required_skills = [];

    protected function rules()
    {
        return [
            "title" => "required|max:255",
            "country" => "required|max:255",
            "city" => "required|max:255",
            "salary" => "required|integer",
            "type" => "required|in:1,2,3,4",
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


        if (JobService::new($this->all()))

            return $this->dispatchBrowserEvent("status:success", [
                "message" => "job created successfully."
            ]);

        else
            $this->dispatchBrowserEvent("status:error", [
                "message" => "failed to create the job, check fo your internet and try again"
            ]);
    }
}
