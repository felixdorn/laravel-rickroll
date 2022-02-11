<?php

use Felix\RickRoll\Exceptions\RenderableRickRoll;

if (!function_exists('rickroll')) {
    function rickroll(?string $redirectTo = null): void
    {
        throw new RenderableRickRoll($redirectTo);
    }
}
