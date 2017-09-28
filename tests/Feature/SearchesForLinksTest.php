<?php

namespace Tests\Feature;

use App\Link;
use Tests\Behavior\EnablesSearchDriver;
use Tests\TestCase;

class SearchesForLinksTest extends TestCase
{
    use EnablesSearchDriver;

    /**
     * @group integration
     *
     * @test
     */
    public function it_searches_by_description()
    {
        factory(Link::class)->create(['description' => 'ABCD']);
        factory(Link::class)->create(['description' => 'EFGH']);
        factory(Link::class)->create(['description' => 'BACD']);

        $response = $this->get('/api/links/search?query=A');

        $this->assertCount(1, $response->decodeResponseJson());
    }
}
