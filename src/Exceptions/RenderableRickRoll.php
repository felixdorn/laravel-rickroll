<?php

namespace Felix\RickRoll\Exceptions;

use Exception;
use Felix\RickRoll\Events\RickRolled;
use Felix\RickRoll\Facades\RickRoll;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RenderableRickRoll extends Exception
{
    private ?string $redirectTo;
    private bool $dispatchEvent;

    public function __construct(bool $dispatchEvent = true, ?string $redirectTo = null)
    {
        $this->redirectTo = $redirectTo;
        $this->dispatchEvent = $dispatchEvent;

        parent::__construct();
    }

    public function render(Request $request): RedirectResponse
    {
        if ($this->dispatchEvent) {
            event(new RickRolled($request));
        }

        return redirect($this->redirectTo ?? RickRoll::getRedirectURL());
    }
}
