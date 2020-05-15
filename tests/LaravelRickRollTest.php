<?php


namespace Felix\RickRoll\Tests;


use Felix\RickRoll\LaravelRickRoll;
use Felix\RickRoll\URL;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class LaravelRickRollTest extends TestCase
{
    /** @test */
    public function it_can_clear_urls(): void
    {
        $rr = new LaravelRickRoll();
        $this->assertNotEmpty($rr->getUrls());
        $rr->clear();
        $this->assertEmpty($rr->getUrls());
    }

    /** @test */
    public function it_can_set_urls_through_the_routes_method() {
        $rr = new LaravelRickRoll();

        $rr->routes([
            'redirects_to' => 'https://youtube.com',
            'use_defaults' => false,
            'urls' => ['/some/thing']
        ]);

        $this->assertEquals(['/some/thing'], $rr->getUrls());
        $this->assertEquals('https://youtube.com', $rr->getRedirectURL());
    }

    /** @test */
    public function it_register_an_url_to_the_router(): void
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
                'uri' => 'some/url',
                'methods' => Router::$verbs
            ],
            [
                'uri' => 'some/{id}',
                'methods' => Router::$verbs
            ],
            [
                'uri' => 'some/thing',
                'methods' => Router::$verbs
            ],
        ], $routes);
    }

    /** @test */
    public function it_redirects_to_never_gonna_give_you_up(): void
    {
        $this->assertEquals('https://www.youtube.com/watch?v=dQw4w9WgXcQ', (new LaravelRickRoll())->getRedirectURL());
    }

    /** @test */
    public function it_can_set_the_redirect_url(): void
    {
        $rr = new LaravelRickRoll();
        $this->it_redirects_to_never_gonna_give_you_up();
        $rr->redirectsTo('https://this.that');
        $this->assertEquals('https://this.that', $rr->getRedirectURL());
    }

    /** @test */
    public function it_can_remove_an_url() {
        $rr = new LaravelRickRoll();
        $this->assertContains('.env', $rr->getUrls());
        $rr->remove('.env');
       $this->assertNotContains('.env', $rr->getUrls());
    }

    /** @test */
    public function it_can_remove_an_url_using_a_callable() {
        $rr = new LaravelRickRoll();
        $this->assertNotEmpty($rr->getUrls());
        $rr->remove(static function ($url) {
            return false;
        });
        $this->assertEmpty($rr->getUrls());
    }
}
