<?php

namespace Felix\RickRoll\Providers;

use Felix\RickRoll\LaravelRickRoll;
use Illuminate\Support\ServiceProvider;

class RickRollProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton('laravel-rickroll', static function () {
            return new LaravelRickRoll();
        });
    }
}
