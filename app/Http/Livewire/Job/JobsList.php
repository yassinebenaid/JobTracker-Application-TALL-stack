<?php

namespace App\Http\Livewire\Job;

use App\Http\Livewire\BaseComponent;
use App\Services\JobService;
use App\Services\SkillService;
use Livewire\WithPagination;

class JobsList extends BaseComponent
{
    use WithPagination;

    public $filters = [
        'keywords' => '',
        "date" => '',
        "types" => [],
        "location" => [
            "country" => '',
            "city" => ''
        ],
        "skills" => [],
        "salary" => [
            "min" => '',
            "max" => '',
        ],
    ];


    public function updatedPage()
    {
        $this->dispatchBrowserEvent("should:scroll");
        $this->emit('job:changed', $this->jobs->first()->id);
    }

    public function filter()
    {
        $this->dispatchBrowserEvent("should:scroll");
    }

    public function getJobsProperty()
    {
        return JobService::applyJobsList($this->filters);
    }

    public function getSkillsProperty()
    {
        return SkillService::applyListOfSkills();
    }

    protected function paginationView()
    {
        return 'components.pagination';
    }
}
