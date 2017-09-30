<?php

namespace Tests\Feature;

use App\Link;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ItCreatesLinksTest extends TestCase
{
    private function validParams($overrides = [])
    {
        return array_filter(array_merge([
            'description' => 'Social media baby',
            'url'         => 'http://www.google.com'
        ], $overrides));
    }

    /** @test */
    public function it_adds_a_new_link()
    {
        factory(Link::class)->create();
        $response = $response = $this->post('/api/links', $this->validParams());

        $response->assertStatus(201);
        $this->assertCount(2, $response->decodeResponseJson());
        $this->assertDatabaseHas('links', $this->validParams());
    }

    /** @test */
    public function only_owner_of_link_can_access_it()
    {
        $user = \Auth::user();
        $user2 = factory(User::class)->create();

        factory(Link::class)->create([
            'user_id' => $user->getKey()
        ]);

        factory(Link::class)->create([
            'user_id' => $user2->getKey()
        ]);

        $response = $this->get('/api/links');

        $this->assertCount(1, $response->decodeResponseJson()['data']);
    }

    /** @test */
    public function it_does_not_allow_saving_invalid_urls()
    {
        $this->withExceptionHandling();

        $response = $response = $this->post('/api/links', $this->validParams([
            'url' => 'NOT A VALID LINK'
        ]));

        $response->assertStatus(422);
    }

    /** @test */
    public function it_does_not_allow_saving_missing_urls()
    {
        $this->withExceptionHandling();

        $response = $response = $this->post('/api/links', $this->validParams([
            'url' => ''
        ]));

        $response->assertStatus(422);
    }

    /** @test */
    public function it_does_not_allow_saving_invalid_descriptions()
    {
        $this->withExceptionHandling();

        $response = $response = $this->post('/api/links', $this->validParams([
            'description' => 123
        ]));

        $response->assertStatus(422);
    }

    /** @test */
    public function it_does_not_allow_saving_missing_descriptions()
    {
        $this->withExceptionHandling();

        $response = $response = $this->post('/api/links', $this->validParams([
            'description' => ''
        ]));

        $response->assertStatus(422);
    }

    /** @test */
    public function it_warns_user_of_duplicate_link()
    {
        $link = factory(Link::class)->create();
        $response = $response = $this->post('/api/links', $this->validParams([
            'url' => $link->url
        ]));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertEquals(1, Link::where('url', $link->url)->count());
    }
}
