<?php

namespace Felix\RickRoll\Tests;

use Felix\RickRoll\LaravelRickRoll;
use Felix\RickRoll\URL;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class LaravelRickRollTest extends TestCase
{
    public function testItCanClearUrls(): void
    {
        $rr = new LaravelRickRoll();
        $this->assertNotEmpty($rr->getUrls());
        $rr->clear();
        $this->assertEmpty($rr->getUrls());
    }

    public function testItCanSetUrlsThroughTheRoutesMethod()
    {
        $rr = new LaravelRickRoll();

        $rr->routes([
            'redirects_to' => 'https://youtube.com',
            'use_defaults' => false,
            'urls'         => ['/some/thing'],
        ]);

        $this->assertEquals(['/some/thing'], $rr->getUrls());
        $this->assertEquals('https://youtube.com', $rr->getRedirectURL());
    }

    public function testItRegisterAnUrlToTheRouter(): void
    {
        $rr = new LaravelRickRoll();
        $rr
            ->clear()
            ->push('/some/url')
            ->push('/some/{id}', ['id' => '[0-9]+']);

        $this->assertEquals([
            URL::createFromURL('/some/url'),
            URL::createWithConstraints('/some/{id}', ['id' => '[0-9]+']),
        ], $rr->getUrls());

        $rr->withUrls(['/some/thing']);

        unset($rr); // triggers the __destruct method

        /** @var RouteCollection $routes */
        $routes = array_map(static function ($route) {
            return ['uri' => $route->uri, 'methods' => $route->methods()];
        }, Route::getRoutes()->getRoutes());

        $this->assertEquals([
            [
                'uri'     => 'some/url',
                'methods' => Router::$verbs,
            ],
            [
                'uri'     => 'some/{id}',
                'methods' => Router::$verbs,
            ],
            [
                'uri'     => 'some/thing',
                'methods' => Router::$verbs,
            ],
        ], $routes);
    }

    public function testItRedirectsToNeverGonnaGiveYouUp(): void
    {
        $this->assertEquals('https://www.youtube.com/watch?v=dQw4w9WgXcQ', (new LaravelRickRoll())->getRedirectURL());
    }

    public function testItCanSetTheRedirectUrl(): void
    {
        $rr = new LaravelRickRoll();
        $this->testItRedirectsToNeverGonnaGiveYouUp();
        $rr->redirectsTo('https://this.that');
        $this->assertEquals('https://this.that', $rr->getRedirectURL());
    }

    public function testItCanRemoveAnUrl()
    {
        $rr = new LaravelRickRoll();
        $this->assertContains('.env', $rr->getUrls());
        $rr->remove('.env');
        $this->assertNotContains('.env', $rr->getUrls());
    }

    public function testItCanRemoveAnUrlUsingACallable()
    {
        $rr = new LaravelRickRoll();
        $this->assertNotEmpty($rr->getUrls());
        $rr->remove(static function ($url) {
            return false;
        });
        $this->assertEmpty($rr->getUrls());
    }
}
