<?php

namespace Tests\Feature;

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
        $response = $response = $this->post('/api/links', $this->validParams());

        $response->assertStatus(201);
        $this->assertDatabaseHas('links', $this->validParams());
    }

    /** @test */
    public function it_does_not_allow_saving_invalid_urls()
    {
        $this->withExceptionHandling();

        $response = $response = $this->post('/api/links', $this->validParams([
            'url' => 'NOT A VALID LINK'
        ]));

        $response->assertStatus(400);
    }

    /** @test */
    public function it_does_not_allow_saving_missing_urls()
    {
        $this->withExceptionHandling();

        $response = $response = $this->post('/api/links', $this->validParams([
            'url' => ''
        ]));

        $response->assertStatus(400);
    }

    /** @test */
    public function it_does_not_allow_saving_invalid_descriptions()
    {
        $this->withExceptionHandling();

        $response = $response = $this->post('/api/links', $this->validParams([
            'description' => 123
        ]));

        $response->assertStatus(400);
    }

    /** @test */
    public function it_does_not_allow_saving_missing_descriptions()
    {
        $this->withExceptionHandling();

        $response = $response = $this->post('/api/links', $this->validParams([
            'description' => ''
        ]));

        $response->assertStatus(400);
    }
}
