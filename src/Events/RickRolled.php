<?php


namespace Felix\RickRoll\Events;


use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;

class RickRolled
{
    use Dispatchable;

    /**
     * @var Request
     */
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
