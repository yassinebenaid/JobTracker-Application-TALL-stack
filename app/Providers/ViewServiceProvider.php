<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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

        Blade::directive('emploee', function () {
            return "<?php if(auth()->user()->hasRole(\App\Enums\Roles::EMPLOEE->value)): ?>";
        });
        Blade::directive('endemploee', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('entrepreneur', function () {
            return "<?php if(auth()->user()->hasRole(\App\Enums\Roles::ENTREPRENEUR->value)): ?>";
        });
        Blade::directive('endentrepreneur', function () {
            return "<?php endif; ?>";
        });
    }
}
