<?php


namespace Felix\RickRoll\Providers;


use Felix\RickRoll\LaravelRickroll;
use Illuminate\Support\ServiceProvider;

class RickRollProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton('laravel-rickroll', static function () {
            return new LaravelRickroll();
        });
    }
}
