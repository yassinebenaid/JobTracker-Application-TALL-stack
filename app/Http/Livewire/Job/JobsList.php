<?php

namespace App\Http\Livewire\Job;

use App\Models\Job;
use App\Services\JobService;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class JobsList extends Component
{
    use WithPagination;

    protected $filters = [];

    protected $listeners = ["filter-mode:on" => "filter"];

    public function updatedPage()
    {
        $this->dispatchBrowserEvent("should:scroll");
        $this->emit('job:changed', $this->jobs->first()->id);
    }

    public function filter($filters)
    {
        $this->filters = $filters;
        $this->dispatchBrowserEvent("should:scroll");
    }

    public function getJobsProperty()
    {
        return JobService::applyWorksList($this->filters);
    }

    protected function paginationView()
    {
        return 'components.pagination';
    }

    public function render()
    {
        return view('livewire.job.jobs-list');
    }
}
