<?php

namespace Felix\Rickroll\Facades;

use Felix\RickRoll\LaravelRickroll;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void routes(array $options = [])
 * @method static LaravelRickroll push(string ...$urls)
 * @method static LaravelRickroll remove(string ...$urls)
 * @method static array all()
 * @method static LaravelRickroll  removeDefaults()
 * @see LaravelRickroll
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
