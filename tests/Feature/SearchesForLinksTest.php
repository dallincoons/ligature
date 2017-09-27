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

        $links = Link::search('A')->get();

        $this->assertCount(1, $links);
    }
}
