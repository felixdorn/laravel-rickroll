<?php

namespace Felix\RickRoll\Tests;

use Felix\RickRoll\Events\RickRolled;
use Felix\RickRoll\Exceptions\RenderableRickRoll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class RenderableRickRollTest extends TestCase
{
    /** @test */
    public function it_dispatch_the_event(): void
    {
        Event::fake();
        $exception = new RenderableRickRoll(true, 'https://custom.url');
        $response = $exception->render(new Request());
        Event::assertDispatched(RickRolled::class, static function (RickRolled $event) {
            return $event->request instanceof Request;
        });

        $this->assertEquals('https://custom.url', $response->getTargetUrl());
    }

    /** @test */
    public function it_does_not_dispatch_the_event_when_disabled()
    {
        Event::fake();

        $exception = new RenderableRickRoll(false, 'custom.url');
        $response = $exception->render(new Request());

        Event::assertNotDispatched(RickRolled::class);
    }
}
