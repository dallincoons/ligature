<?php

namespace Tests\Feature;

use Tests\TestCase;

class ItCreatesLinksTest extends TestCase
{
    /** @test */
    public function it_adds_a_new_link()
    {
        $response = $this->post('/api/links', [
            'description' => 'Social media baby',
            'url' => 'facebook.com'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('links', [
            'description' => 'Social media baby',
            'url' => 'facebook.com'
        ]);
    }
}
