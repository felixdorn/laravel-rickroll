<?php

namespace Felix\RickRoll\Facades;

use Felix\RickRoll\LaravelRickRoll;
use Illuminate\Support\Facades\Facade;

/**
 * @method static LaravelRickRoll routes(array $options = [])
 * @method static LaravelRickRoll push(string $url, array $constraints = [])
 * @method static LaravelRickRoll remove(string ...$urls)
 * @method static LaravelRickRoll clear()
 * @method static LaravelRickRoll redirectsTo(string $url)
 * @method static array getUrls()
 * @method static array withUrls()
 * @method static string getRedirectURL()
 *
 * @see LaravelRickRoll
 */
class RickRoll extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new LaravelRickRoll();
    }
}
