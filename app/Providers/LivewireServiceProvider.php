<?php

namespace App\Providers;

use App\Http\Livewire\User\CompleteRegistration;
use App\Http\Livewire\User\Steps\CompanyInfo;
use App\Http\Livewire\User\Steps\Education;
use App\Http\Livewire\User\Steps\Image;
use App\Http\Livewire\User\Steps\Job;
use App\Http\Livewire\User\Steps\PersonalInfo;
use App\Http\Livewire\User\Steps\RegisterInformation;
use App\Http\Livewire\User\Steps\Role;
use App\Http\Livewire\User\Steps\Skills;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component("role", Role::class);
        Livewire::component("personal-info", PersonalInfo::class);
        Livewire::component("company-info", CompanyInfo::class);
        Livewire::component("education", Education::class);
        Livewire::component("job", Job::class);
        Livewire::component("skills", Skills::class);
        Livewire::component("image", Image::class);
        Livewire::component("register-information", RegisterInformation::class);
        Livewire::component("complete-registration", CompleteRegistration::class);
    }
}
