<?php

namespace Felix\RickRoll\Exceptions;

use Exception;
use Felix\RickRoll\Events\RickRolled;
use Felix\RickRoll\Facades\RickRoll;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RenderableRickRoll extends Exception
{
    public function __construct(protected ?string $redirectTo = null)
    {
        parent::__construct();
    }

    public function render(Request $request): RedirectResponse
    {
        event(new RickRolled($request));

        return redirect($this->redirectTo ?? RickRoll::getRedirectURL());
    }
}
