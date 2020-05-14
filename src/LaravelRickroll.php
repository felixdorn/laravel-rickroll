<?php

namespace Felix\RickRoll;

use Felix\RickRoll\Events\RickRolled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LaravelRickroll
{
    public $urls = [
        '.env',
        'wp-admin',
        'wp-login.php',
        'composer.lock',
        'yarn.lock',
        'xmlrpc.php'
    ];

    public $redirectsTo = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';

    public function routes(array $options = []): void
    {
        if (array_key_exists('redirects_to', $options)) {
            $this->redirectsTo = $options['redirects_to'];
        }

        if (array_key_exists('urls', $options)) {
            $useDefaults = array_key_exists('use_defaults', $options) && $options['use_defaults'];

            if (!$useDefaults) {
                $this->removeDefaults();
            }

            $this->urls = [...$this->urls, ...$options['urls']];
        }

        $this->registerRoutes();
    }

    private function registerRoutes(): void
    {
        foreach ($this->urls as $url) {
            Route::any($url, [$this, 'routeHandler']);
        }
    }

    public function push(string ...$urls): LaravelRickroll
    {
        $this->urls = array_merge($this->urls, $urls);

        return $this;
    }

    public function register(string $url, array $constraints = []) {
        Route::any($url, [$this, 'routeHandler'])->where($constraints);
    }

    public function remove(...$urls): bool
    {
        foreach ($urls as $url) {
            $this->urls = array_filter(
                $this->urls,
                is_callable($url) ? $url : fn($given) => $url !== $given
            );
        }

        return false;
    }

    public function all(): array
    {
        return $this->urls;
    }

    public function removeDefaults(): LaravelRickroll
    {
        $this->urls = [];

        return $this;
    }

    private function routeHandler(Request $request)
    {
        event(new RickRolled($request));

        return redirect($this->redirectsTo);
    }
}
