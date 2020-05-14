<?php

namespace Felix\Rickroll\Facades;

use Felix\RickRoll\LaravelRickroll;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void routes(array $options = [])
 * @method static void push(string $url)
 * @method static LaravelRickroll remove(string $url)
 * @method static array all()
 * @method static string redirectsTo()
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
