<?php


namespace Felix\RickRoll\Tests;


use Felix\RickRoll\Events\RickRolled;
use Illuminate\Http\Request;

class RickRolledTest extends TestCase
{
    /** @test */
    public function it_has_the_current_request(): void
    {
        $event = new RickRolled(
            Request::create('/some/uri', 'PUT')
        );

        $this->assertEquals('PUT', $event->request->getMethod());
        $this->assertEquals('/some/uri', $event->request->getRequestUri());
    }
}
