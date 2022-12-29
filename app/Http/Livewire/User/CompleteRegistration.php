<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\User\Steps\CompanyInfo;
use App\Http\Livewire\User\Steps\Education;
use App\Http\Livewire\User\Steps\Image;
use App\Http\Livewire\User\Steps\Job;
use App\Http\Livewire\User\Steps\PersonalInfo;
use App\Http\Livewire\User\Steps\RegisterInformation;
use App\Http\Livewire\User\Steps\Role;
use App\Http\Livewire\User\Steps\Skills;
use Spatie\LivewireWizard\Components\WizardComponent;

class CompleteRegistration extends WizardComponent
{


    public function steps(): array
    {
        return [
            Role::class,
            PersonalInfo::class,
            CompanyInfo::class,
            Education::class,
            Job::class,
            Skills::class,
            Image::class,
            RegisterInformation::class
        ];
    }


    public function mount()
    {
        session()->forget("profile");
    }
}
