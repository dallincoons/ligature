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

    /** @test */
    public function it_prefixes_url_with_no_existing_prefix()
    {
        $url = Link::prefixUrl('facebook.com');

        $this->assertEquals('http://facebook.com', $url);
    }

    /** @test */
    public function it_does_not_prefix_when_prefixed_by_http()
    {
        $url = Link::prefixUrl('http://facebook.com');

        $this->assertEquals('http://facebook.com', $url);
    }

    /** @test */
    public function it_does_not_prefix_when_prefixed_by_https()
    {
        $url = Link::prefixUrl('http://facebook.com');

        $this->assertEquals('http://facebook.com', $url);
    }
}
