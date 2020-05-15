<?php

use Felix\RickRoll\Exceptions\RenderableRickRoll;

if (!function_exists('rickroll')) {
    function rickroll(bool $dispatchEvent = true, ?string $redirectTo = null): void
    {
        throw new RenderableRickRoll($dispatchEvent, $redirectTo);
    }
}
