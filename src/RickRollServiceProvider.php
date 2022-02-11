<?php

namespace Felix\RickRoll;

use Illuminate\Support\ServiceProvider;

class RickRollServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LaravelRickRoll::class, function () {
            return new LaravelRickRoll();
        });
    }
}
