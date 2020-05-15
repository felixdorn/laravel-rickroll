<?php

namespace Felix\RickRoll;

class LaravelRickRoll
{
    /**
     * The URL where the request is redirected
     * @var string
     */
    public string $redirectsTo = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';

    /**
     * List of urls that redirects to the $redirectsTo url
     * @var array<int, URL|string>
     */
    public array $urls = [
        '.env',
        'wp-admin',
        'wp-login.php',
        'composer.lock',
        'yarn.lock',
        'xmlrpc.php'
    ];

    /**
     *  The front-end of the library. There is a few options you can specify here
     * redirects_to, changes the url where request are rick-rolled
     * urls, a list of url to append
     * If used in combination of `use_defaults => false`, only these urls will be registered.
     * @param array $options
     */
    public function routes(array $options = []): LaravelRickRoll
    {
        if (array_key_exists('redirects_to', $options)) {
            $this->redirectsTo = $options['redirects_to'];
        }

        if (array_key_exists('urls', $options)) {
            $useDefaults = array_key_exists('use_defaults', $options) && $options['use_defaults'];

            if (!$useDefaults) {
                $this->clear();
            }

            $this->urls = [...$this->urls, ...$options['urls']];
        }

        return $this;
    }

    public function clear(): LaravelRickRoll
    {
        $this->urls = [];

        return $this;
    }

    /**
     * @param string|URL ...$urls
     * @return $this
     */
    public function push(...$urls): LaravelRickRoll
    {
        $this->urls = array_merge($this->urls, $urls);

        return $this;
    }

    /**
     * @param string $url
     * @param array $constraints
     * @return $this
     */
    public function register(string $url, array $constraints = []): LaravelRickRoll
    {
        $this->urls[] = new URL($url, $constraints);

        return $this;
    }

    /**
     * @param string|URL ...$urls
     * @return bool
     */
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

    public function redirectsTo(string $url): LaravelRickRoll
    {
        $this->redirectsTo = $url;

        return $this;
    }

    /**
     * Once everything is setup and the object is not used anymore
     * We register the redirections on the router.
     */
    public function __destruct()
    {
        foreach ($this->urls as $url) {
            if (is_string($url)) {
                $url = URL::createFromURL($url);
            }

            $url->register($this->redirectsTo);
        }
    }
}
