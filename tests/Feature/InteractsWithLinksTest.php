<?php

namespace Tests\Feature;

use App\Link;
use Tests\TestCase;

class InteractsWithLinksTest extends TestCase
{
    /** @test */
    public function it_gets_all_links()
    {
        factory(Link::class, 2)->create();

        $response = $this->get('/api/links');

        $this->assertCount(2, $response->decodeResponseJson());
    }

    /** @test */
    public function it_deletes_link_test()
    {
        factory(Link::class)->create();
        $link = factory(Link::class)->create();

        $response = $this->delete('/api/links/' . $link->getKey());

        $this->assertEquals(1, Link::count());
        $this->assertEquals(1, count($response->decodeResponseJson()));
    }
}
