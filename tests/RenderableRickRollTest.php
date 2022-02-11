<?php

namespace Felix\RickRoll\Tests;

use Felix\RickRoll\Events\RickRolled;
use Felix\RickRoll\Exceptions\RenderableRickRoll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class RenderableRickRollTest extends TestCase
{
    public function testItDispatchesTheEvent(): void
    {
        Event::fake();
        $exception = new RenderableRickRoll('https://custom.url');
        $response  = $exception->render(new Request());
        Event::assertDispatched(RickRolled::class, static function (RickRolled $event) {
            return $event->request instanceof Request;
        });

        $this->assertEquals('https://custom.url', $response->getTargetUrl());
    }
}
