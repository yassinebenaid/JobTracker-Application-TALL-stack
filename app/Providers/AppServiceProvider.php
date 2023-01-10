<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro("incrementKeys", function () {
            $new = [];

            /** @var \Illuminate\Support\Collection $this
             * @var int $key
             */
            foreach ($this->items as $key => $value) {
                $new[++$key] = $value;
            }

            return $new;
        });
    }
}
