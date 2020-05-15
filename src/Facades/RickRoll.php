<?php

namespace Felix\Rickroll\Facades;

use Felix\RickRoll\LaravelRickRoll;
use Illuminate\Support\Facades\Facade;

/**
 * @method static LaravelRickRoll routes(array $options = [])
 * @method static LaravelRickRoll push(string ...$urls)
 * @method static LaravelRickRoll remove(string ...$urls)
 * @method static LaravelRickRoll clear()
 * @method static LaravelRickRoll redirectsTo(string $url)
 * @see LaravelRickRoll
 */
class RickRoll extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-rickroll';
    }
}
