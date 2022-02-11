<?php

namespace Felix\RickRoll;

class LaravelRickRoll
{
    /**
     * The URL where the request is redirected.
     */
    protected string $redirectsTo = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';

    /**
     * List of urls that redirects to Never Gonna Give You Up.
     *
     * @var array<int, URL|string>
     */
    public array $urls = [
        '.env',
        '.git',
        'wp-admin',
        'wp-login.php',
        'composer.lock',
        'yarn.lock',
        'package-lock.json',
        'xmlrpc.php',
        'typo3',
    ];

    /**
     *  The front-end of the library. There is a few options you can specify here
     * redirects_to, changes the url where request are rick-rolled
     * urls, a list of url to append
     * If used in combination of `use_defaults => false`, only these urls will be registered.
     */
    public function routes(array $options = []): self
    {
        if (array_key_exists('redirects_to', $options)) {
            $this->redirectsTo = $options['redirects_to'];
        }

        $useDefaults = array_key_exists('use_defaults', $options) && $options['use_defaults'];
        if (!$useDefaults) {
            $this->clear();
        }

        if (array_key_exists('urls', $options)) {
            $this->withUrls($options['urls']);
        }

        return $this;
    }

    /**
     * Clears all urls.
     *
     * @return $this
     */
    public function clear(): self
    {
        $this->urls = [];

        return $this;
    }

    /**
     * Register an url.
     *
     * @return $this
     */
    public function push(string $url, array $constraints = []): self
    {
        $this->urls[] = new URL($url, $constraints);

        return $this;
    }

    /**
     * Remove one or more urls from the list
     * If a callable is the provided then we filter the array using this callable.
     *
     * @param string|URL|callable ...$urls
     */
    public function remove(...$urls): bool
    {
        foreach ($urls as $url) {
            $this->urls = array_filter(
                $this->urls,
                is_callable($url) ? $url : fn ($given) => $url !== $given
            );
        }

        return false;
    }

    /**
     * Sets the redirection url.
     *
     * @return $this
     */
    public function redirectsTo(string $url): self
    {
        $this->redirectsTo = $url;

        return $this;
    }

    /**
     * Once everything is setup and the object is not used anymore,
     * we can register our routes.
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

    /**
     * Returns the redirect url.
     */
    public function getRedirectURL(): string
    {
        return $this->redirectsTo;
    }

    public function getUrls(): array
    {
        return $this->urls;
    }

    public function withUrls(array $urls): self
    {
        $this->urls = [...$this->urls, ...$urls];

        return $this;
    }
}
