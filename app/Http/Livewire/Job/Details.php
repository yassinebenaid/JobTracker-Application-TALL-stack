<?php

namespace App\Http\Livewire\Job;

use App\Enums\JobTypes;
use App\Enums\Roles;
use App\Helpers\Promise;
use App\Http\Livewire\BaseComponent;
use App\Models\Job;
use App\Rules\ValidJobType;
use App\Services\JobService;
use App\Services\SkillService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Details extends BaseComponent
{
    public Job $job;
    public $inWishlist;
    public $withControle;

    public $required_skills = [];

    protected $listeners = ["job:changed" => "changeJob"];

    protected function rules()
    {
        return [
            "job.title" => "required|max:255",
            "job.country" => "required|max:255",
            "job.city" => "required|max:255",
            "job.salary" => "required|integer",
            "job.criteria" => "max:1000",
            "job.type" => new ValidJobType,
            "job.description" => "required",
        ];
    }

    public function mount($controle)
    {
        $this->withControle = $controle;
    }

    public function changeJob($id)
    {
        $this->job  = JobService::allAboutJob($id);
        $this->withControle = true;
    }

    public function getSkillsProperty()
    {
        return SkillService::applyListOfSkills();
    }


    public function wishlist()
    {
        $this->inWishlist = JobService::toggleToWishlist($this->job);
    }

    public function save()
    {
        abort_if(!auth()->user()->hasRole(Roles::ENTREPRENEUR->value), 403);

        $this->validate();

        Promise::make(function () {

            DB::transaction(function () {
                $this->job->save();
                $this->job->skills()->sync($this->required_skills);
            });
        })
            ->then(fn () => $this->success("job created successfully."))

            ->catch(fn () => $this->error("failed to create the job, check fo your internet and try again"));
    }


    public function remove()
    {
        Promise::make(fn () => $this->job->delete())

            ->if(true, function () {
                $this->withControle = false;
                $this->emitUp("job:list-updated");
            })

            ->onFalsy(fn () => $this->error("somthing went wrong !"));
    }


    public function render()
    {
        $this->inWishlist = JobService::inWishlist($this->job);

        return view('livewire.job.details');
    }
}
