<?php

namespace Felix\RickRoll\Tests;

use Felix\RickRoll\Events\RickRolled;
use Felix\RickRoll\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class URLTest extends TestCase
{
    public function testItCanCreateAnUrl()
    {
        $url = URL::createFromURL('/being/rickrolled');

        $this->assertEquals('/being/rickrolled', $url->getUrl());
        $this->assertEquals([], $url->getConstraints());
    }

    public function testItCanCreateAnUrlWithConstraints()
    {
        $url = URL::createWithConstraints('/rickrolled', [
            'id' => '[0-9]+',
        ]);

        $this->assertEquals('/rickrolled', $url->getUrl());
        $this->assertEquals([
            'id' => '[0-9]+',
        ], $url->getConstraints());
    }

    public function testItCanSetTheRedirectUrl()
    {
        $url = URL::createFromURL('/like/that')->redirectsTo('https://this.that');

        $this->assertEquals('https://this.that', $url->getRedirectsTo());
    }

    public function testItCanHandleARequest()
    {
        $url     = URL::createFromURL('/yes');
        $request = new Request();
        Event::fake();
        $response = $url->redirectsTo('https://www.youtube.com/watch?v=dQw4w9WgXcQ')->handler($request);
        Event::assertDispatched(RickRolled::class, static function (RickRolled $event) use ($request) {
            return $event->request === $request;
        });

        $this->assertEquals('https://www.youtube.com/watch?v=dQw4w9WgXcQ', $response->headers->get('Location'));
    }
}
