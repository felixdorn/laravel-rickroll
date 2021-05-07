<?php

namespace Felix\RickRoll\Tests;

use Felix\RickRoll\Exceptions\RenderableRickRoll;

class HelperTest extends TestCase
{
    public function test_it_throws_a_renderable_rickroll_exception()
    {
        $this->expectException(RenderableRickRoll::class);
        rickroll();
    }
}
