<?php


namespace Felix\RickRoll\Tests;


use Felix\RickRoll\Exceptions\RenderableRickRoll;

class HelperTest extends TestCase
{
    /** @test */
    public function it_throws_a_renderable_rickroll_exception() {
        $this->expectException(RenderableRickRoll::class);
        rickroll();
    }
}
