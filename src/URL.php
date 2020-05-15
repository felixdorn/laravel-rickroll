<?php

namespace Felix\RickRoll;

use Felix\RickRoll\Events\RickRolled;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class URL
{
    private string $url;
    private array $constraints;
    private ?string $redirectsTo = null;

    /**
     * URL constructor.
     * @param string $url
     * @param array $constraints
     */
    public function __construct(string $url, array $constraints = [])
    {
        $this->url = $url;
        $this->constraints = $constraints;
    }

    /**
     * @param string $url
     * @return URL
     */
    public static function createFromURL(string $url): self
    {
        return new self($url);
    }

    /**
     * @param string $url
     * @param array $constraints
     * @return URL
     */
    public static function createWithConstraints(string $url, array $constraints): self
    {
        return new self($url, $constraints);
    }

    /**
     * Changes the redirection only for this url.
     * @param string $url
     * @return $this
     */
    public function redirectsTo(string $url): self
    {
        $this->redirectsTo = $url;

        return $this;
    }

    /**
     * @param string $redirectsTo
     * @internal
     */
    public function register(string $redirectsTo): void
    {
        if (! $this->redirectsTo) {
            $this->redirectsTo = $redirectsTo;
        }

        Route::any($this->url, [__CLASS__, 'handler']);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handler(Request $request): Response
    {
        event(new RickRolled($request));

        // not using the `redirect` helper for testing purposes
        return response(null, 301, [
            'location' => $this->redirectsTo,
        ]);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }

    /**
     * @return string|null
     */
    public function getRedirectsTo(): ?string
    {
        return $this->redirectsTo;
    }
}
