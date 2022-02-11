<?php

namespace Felix\RickRoll\Tests;

use Felix\RickRoll\Exceptions\RenderableRickRoll;

class HelperTest extends TestCase
{
    public function testItThrowsARenderableRickrollException()
    {
        $this->expectException(RenderableRickRoll::class);
        rickroll();
    }
}
