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

    /** @test */
    public function it_toggles_read_field()
    {
        $link = factory(Link::class)->create();

        $this->assertEquals(0, $link->read);

        $link->toggleRead();

        $this->assertEquals(1, $link->fresh()->read);
    }

    /** @test */
    public function it_detects_duplicate_url()
    {
        $link = factory(Link::class)->create();

        $this->assertTrue(Link::duplicateExists($link->url));
    }

    /** @test */
    public function it_doesnt_detect_duplicate_url()
    {
        $this->assertFalse(Link::duplicateExists('sdfsfsdfsd.com'));
    }
}
