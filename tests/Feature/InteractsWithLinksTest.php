<?php

namespace Tests\Feature;

use App\Http\Controllers\LinkController;
use App\Link;
use Carbon\Carbon;
use Tests\TestCase;

class InteractsWithLinksTest extends TestCase
{
    /** @test */
    public function it_updates_link()
    {
        $link = factory(Link::class)->create([
            'description' => 'a guide to sticking it to the man'
        ]);

        $this->assertEquals('a guide to sticking it to the man', $link->first()->description);

        $link->description = 'a guide to conforming';

        $this->patch('/api/links/' . $link->getKey(), $link->toArray())
            ->assertSuccessful();

        $this->assertEquals('a guide to conforming', $link->refresh()->description);
    }

    /** @test */
    public function it_gets_links_ordered_by_created_at()
    {
        factory(Link::class)->create();
        $link2 = factory(Link::class)->create([
            'created_at' => Carbon::now()->addMinute(1)
        ]);

        $response = $this->get('/api/links');

        $this->assertEquals(array_get($response->decodeResponseJson(), 'data.0.id'), $link2->getKey());
    }

    /** @test */
    public function it_gets_all_links_for_first_page()
    {
        factory(Link::class, LinkController::PAGINATE_LIMIT + 1)->create();

        $response = $this->get('/api/links');

        $this->assertCount(LinkController::PAGINATE_LIMIT, $response->decodeResponseJson()['data']);
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

    /** @test */
    public function it_marks_link_as_read()
    {
        $link = factory(Link::class)->create()->refresh();

        $this->assertSame(0, $link->read);

        $response = $this->post('/api/link/' . $link->getKey() . '/toggle-read');

        $this->assertSame(1, $link->fresh()->read);
        $response->assertStatus(200);
        $this->assertEquals(1, $response->decodeResponseJson());
    }
}
