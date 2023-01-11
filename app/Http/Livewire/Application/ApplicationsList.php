<?php

namespace App\Http\Livewire\Application;

use App\Helpers\Promise;
use App\Http\Livewire\BaseComponent;
use App\Notifications\ApplicationAccepted;
use App\Notifications\JobApplicationRefused;
use App\Services\ApplicationService;

class ApplicationsList extends BaseComponent
{
    public $selected;


    public function mount()
    {
        $this->updateSelectedApplication();
    }


    public function getApplicationsProperty()
    {
        return ApplicationService::applyApplicationsList();
    }

    /**
     * update the selected application , typycally this function will be called from the views
     *
     * @param [type] $application
     * @return void
     */
    public function select($application)
    {
        $this->selected = $this->applications->where("id", $application)->first();
    }

    /**
     * choose which application whose details will be rendered
     *
     * @return void
     */
    public function updateSelectedApplication()
    {
        $this->selected = $this->applications->first();
    }

    /**
     * accept the application
     *
     * @return void
     */
    public function accept()
    {
        Promise::make(fn () => $this->selected->delete())

            ->if(true, function () {
                $this->selected->emploee->notify(new ApplicationAccepted($this->selected->job->title));
                $this->updateSelectedApplication();
                $this->info("application accepted , the emploee will be alerted !");
            })

            ->onFalsy(fn () => $this->error());
    }

    /**
     * refuse the application
     *
     * @return void
     */
    public function deny()
    {
        Promise::make(fn () => $this->selected->delete())

            ->if(true, function () {
                $this->selected->emploee->notify(new JobApplicationRefused($this->selected->job->title));
                $this->updateSelectedApplication();
                $this->info("application refused, the emploee will be alerted !");
            })

            ->onFalsy(fn () => $this->error());
    }
}
