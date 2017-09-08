<?php

namespace Tests\Unit;

use App\Link;
use Tests\TestCase;

class LinkTest extends TestCase
{
    /** @test */
    public function it_follow_the_url_and_retrieves_header()
    {
        $header = Link::getHeader('http://facebook.com');

        $this->assertEquals($header, 'Facebook');
    }
}
