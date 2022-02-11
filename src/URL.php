<?php

namespace Felix\RickRoll;

use Felix\RickRoll\Events\RickRolled;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class URL
{
    protected ?string $redirectsTo = null;

    public function __construct(protected string $url, protected array $constraints = [])
    {
    }

    public static function createFromURL(string $url): self
    {
        return new self($url);
    }

    public static function createWithConstraints(string $url, array $constraints): self
    {
        return new self($url, $constraints);
    }

    /**
     * Changes the redirection only for this url.
     *
     * @return $this
     */
    public function redirectsTo(string $url): self
    {
        $this->redirectsTo = $url;

        return $this;
    }

    /**
     * @internal
     */
    public function register(string $redirectsTo): void
    {
        if (!$this->redirectsTo) {
            $this->redirectsTo = $redirectsTo;
        }

        Route::any($this->url, fn (Request $request) => $this->handler($request));
    }

    public function handler(Request $request): RedirectResponse
    {
        event(new RickRolled($request));

        /* @phpstan-ignore-next-line */
        return redirect()->away($this->redirectsTo);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getConstraints(): array
    {
        return $this->constraints;
    }

    public function getRedirectsTo(): ?string
    {
        return $this->redirectsTo;
    }
}
