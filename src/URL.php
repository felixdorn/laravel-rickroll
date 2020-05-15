<?php

namespace Felix\RickRoll;

use Felix\RickRoll\Events\RickRolled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * @internal
 */
class URL
{
    private string $url;
    private array $constraints = [];
    private ?string $redirectsTo = null;

    public function __construct(string $url, array $constraints = [])
    {
        $this->url = $url;
        $this->constraints = $constraints;
    }

    public static function createFromURL(string $url): self
    {
        return new self($url);
    }

    public static function createWithConstraints(string $url, array $constraints): self
    {
        return new self($url, $constraints);
    }

    public function redirectsTo(string $url): self
    {
        $this->redirectsTo = $url;

        return $this;
    }

    public function register(string $redirectsTo): void
    {
        if (! $this->redirectsTo) {
            $this->redirectsTo = $redirectsTo;
        }

        Route::any($this->url, [$this, 'handler'])->where($this->constraints);
    }

    public function handler(Request $request)
    {
        event(new RickRolled($request));

        // there is a room for improvements there
        return redirect(LaravelRickRoll::$redirectsTo);
    }
}
