<?php


namespace Felix\RickRoll\Tests;


use Felix\RickRoll\LaravelRickRoll;
use PHPUnit\Framework\TestCase;

class RickRollTest extends TestCase
{
    /** @test */
    public function it_can_list_all_urls()
    {
        $rr = new LaravelRickRoll();

        $this->assertEquals([
            '.env',
            'wp-admin',
            'wp-login.php',
            'composer.lock',
            'yarn.lock',
            'xmlrpc.php'
        ], $rr->all());
    }

    /** @test */
    public function it_can_remove_defaults(): void
    {
        $rr = new LaravelRickRoll();
        $rr->clear();
        $this->assertEquals([], $rr->all());
    }

    /** @test */
    public function it_can_push_an_url(): void
    {
        $rr = new LaravelRickRoll();
        $rr->clear()->push('/some/url');

        $this->assertEquals(['/some/url'], $rr->all());
    }

    /** @test */
    public function it_can_remove_an_url(): void
    {
        $rr = new LaravelRickRoll();
        $rr->clear()->push('.env', '.env.testing')->remove('.env');

        $this->assertEquals([
            1 => '.env.testing'
        ], $rr->all());
    }

}
